<?php

namespace App\Http\Controllers\Web;

use Adrianorosa\GeoLocation\GeoLocation;
use App\Http\Controllers\Controller;
use App\Models\AffiliateProduct;
use App\Models\BasicInfo;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Page;
use App\Models\Product;
use App\Models\Productcolor;
use App\Models\Productvariant;
use App\Models\ShippingCharge;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend.content.maincontent');
    }

    public function trackorder(Request $request)
    {
        if (isset($request->invoice_id)) {
            $order = Order::where('invoiceID', $request->invoice_id)->first();
        } else {
            $order = [];
        }
        return view('frontend.content.cart.trackorder', ['order' => $order]);
    }

    public function categoryproduct(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $categories = Category::with('subcategories')->where('status', 1)->get();
        $products = Product::where('category_id', $category->id)->with('productvariants', 'productcolors')->latest()->paginate(20);
        return view('frontend.content.product.categoryproduct', ['category' => $category, 'categories' => $categories, 'products' => $products]);
    }

    public function recommendation(Request $request)
    {
        $categories = Category::with('subcategories')->where('status', 1)->get();
        $settings = BasicInfo::first();
        $recomands = Product::where('product_type_id', 3)->where('status', 1)->with('category', 'productvariants')->paginate(20);

        // get the full query string (since your code is not using key=value)
        $affiliateCode = $request->query('ref');

        if ($affiliateCode) {
            // Save in session
            session(['ref_code' => $affiliateCode]);
        }

        return view(
            'frontend.content.product.recomand',
            [
                'categories' => $categories,
                'settings' => $settings,
                'recomands' => $recomands
            ]
        );
    }

    public function subcategoryproduct(string $slug)
    {
        $subcategory = Subcategory::where('slug', $slug)->first();
        $category = Category::where('id', $subcategory->id)->first();
        $categories = Category::with('subcategories')->where('status', 1)->get();
        $products = Product::where('subcategory_id', $subcategory->id)->with('productvariants', 'productcolors')->latest()->paginate(20);
        return view('frontend.content.product.subcategoryproduct', ['category' => $category, 'subcategory' => $subcategory, 'categories' => $categories, 'products' => $products]);
    }

    public function childCategoryProduct (string $slug)
    {
        $childCat = ChildCategory::where('slug',$slug)->first();

        $subcategory = Subcategory::where('id', $childCat->subcategory_id)->first();
        $category = Category::where('id', $subcategory->id)->first();
        $categories = Category::with('subcategories','subcategories.childCategories' )->where('status', 1)->get();

        $products = Product::where('childcategory_id', $childCat->id)->with('productvariants', 'productcolors')->latest()->paginate(20);


        return view('frontend.content.product.childcategoryproduct', ['category' => $category, 'subcategory' => $subcategory, 'categories' => $categories, 'products' => $products]);


    }

    public function productDetails(string $slug, Request $request)
    {
        $product = Product::where('slug', $slug)->with('category', 'productcolors', 'productvariants')->first();
        $recomands = Product::where('product_type_id', 3)->where('status', 1)->with('category', 'productvariants')->get();
        $firstcolor = Productcolor::where('product_id', $product->id)->first();
        $firstvarient = Productvariant::where('productcolor_id', $firstcolor->id)->first();
        $varients = Productvariant::where('productcolor_id', $firstcolor->id)->get();
        $shareLinks = \Share::page(
            env('APP_URL') . 'product-details/' . $slug,
            $product->name,
        )
            ->facebook()
            ->twitter()
            ->pinterest()
            ->whatsapp()
            ->getRawLinks();

        $authAff = false;

        if (auth()->check()) {
            $authAff = auth()->user()->status == 1;
        }

        // get the full query string (since your code is not using key=value)
        $affiliateCode = $request->query('ref');

        if ($affiliateCode) {
            // Save in session
            session(['ref_code' => $affiliateCode]);
        }


        return view('frontend.content.product.product-details',
            [
                'varients' => $varients,
                'firstcolor' => $firstcolor,
                'firstvarient' => $firstvarient,
                'shareLinks' => $shareLinks,
                'recomands' => $recomands,
                'product' => $product,
                'authAff' => $authAff
            ]);
    }

    public function changecolor(Request $request)
    {
        $loadcolor = Productcolor::where('id', $request->color_id)->first();
        $product = Product::where('id', $loadcolor->product_id)->with('category', 'productcolors', 'productvariants')->first();
        $loadvarient = Productvariant::where('productcolor_id', $loadcolor->id)->first();
        $loadvarients = Productvariant::where('productcolor_id', $loadcolor->id)->get();
        $shareLinks = \Share::page(
            env('APP_URL') . 'product-details/' . $product->slug,
            $product->name,
        )
            ->facebook()
            ->twitter()
            ->pinterest()
            ->whatsapp()
            ->getRawLinks();

        return view('frontend.content.product.loadview', ['loadvarient' => $loadvarient, 'loadvarients' => $loadvarients, 'loadcolor' => $loadcolor, 'shareLinks' => $shareLinks, 'product' => $product]);
    }

    public function changevarient(Request $request)
    {
        $loadvarient = Productvariant::where('id', $request->variant_id)->first();
        return response()->json($loadvarient, 200);
    }

    public function addtocart(Request $request)
    {
//        dd($request->all());
        $varient = Productvariant::where('id', $request->variant_id)->first();
        if (Auth::id()) {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user && $user->hasRole('user')) {
                $ex = Cart::where('variant_id', $varient->id)->where('user_id', $user->id)->first();
                if (isset($ex)) {
                    $ex->quantity = $request->quantity;
                    $ex->update();
                } else {
                    $cart = new Cart();
                    $cart->ip = $request->ip();
                    $cart->user_id = $user->id;
                    $cart->product_id = $varient->product_id;
                    $cart->color_id = $varient->productcolor_id;
                    $cart->variant_id = $varient->id;
                    $cart->price = $varient->sale_price;
                    $cart->quantity = $request->quantity;
                    $cart->save();
                }
                $count = Cart::where('user_id', $user->id)->count();
            } else {
                $ex = Cart::where('variant_id', $varient->id)->where('ip', $request->ip())->first();
                if (isset($ex)) {
                    $ex->quantity = $request->quantity;
                    $ex->update();
                } else {
                    $cart = new Cart();
                    $cart->ip = $request->ip();
                    $cart->product_id = $varient->product_id;
                    $cart->color_id = $varient->productcolor_id;
                    $cart->variant_id = $varient->id;
                    $cart->price = $varient->sale_price;
                    $cart->quantity = $request->quantity;
                    $cart->save();
                }
                $count = Cart::where('ip', $request->ip())->count();
            }
        } else {
            $ex = Cart::where('variant_id', $varient->id)->where('ip', $request->ip())->first();
            if (isset($ex)) {
                $ex->quantity = $request->quantity;
                $ex->update();
            } else {
                $cart = new Cart();
                $cart->ip = $request->ip();
                $cart->product_id = $varient->product_id;
                $cart->color_id = $varient->productcolor_id;
                $cart->variant_id = $varient->id;
                $cart->quantity = $request->quantity;
                $cart->price = $varient->sale_price;
                $cart->save();
            }

            $count = Cart::where('ip', $request->ip())->count();
        }
        $response = [
            'status' => 'Success',
            'item' => $count
        ];

        return response()->json($response, 200);
    }

    public function orderNow(Request $request)
    {
//        dd($request->all());
        $varient = Productvariant::where('id', $request->variant_id)->first();
        if (Auth::id()) {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user && $user->hasRole('user')) {
                $ex = Cart::where('variant_id', $varient->id)->where('user_id', $user->id)->first();
                if (isset($ex)) {
                    $ex->quantity = $request->quantity;
                    $ex->update();
                } else {
                    $cart = new Cart();
                    $cart->ip = $request->ip();
                    $cart->user_id = $user->id;
                    $cart->product_id = $varient->product_id;
                    $cart->color_id = $varient->productcolor_id;
                    $cart->variant_id = $varient->id;
                    $cart->price = $varient->sale_price;
                    $cart->quantity = $request->quantity;
                    $cart->save();
                }
                $count = Cart::where('user_id', $user->id)->count();
            } else {
                $ex = Cart::where('variant_id', $varient->id)->where('ip', $request->ip())->first();
                if (isset($ex)) {
                    $ex->quantity = $request->quantity;
                    $ex->update();
                } else {
                    $cart = new Cart();
                    $cart->ip = $request->ip();
                    $cart->product_id = $varient->product_id;
                    $cart->color_id = $varient->productcolor_id;
                    $cart->variant_id = $varient->id;
                    $cart->price = $varient->sale_price;
                    $cart->quantity = $request->quantity;
                    $cart->save();
                }
                $count = Cart::where('ip', $request->ip())->count();
            }
        } else {
            $ex = Cart::where('variant_id', $varient->id)->where('ip', $request->ip())->first();
            if (isset($ex)) {
                $ex->quantity = $request->quantity;
                $ex->update();
            } else {
                $cart = new Cart();
                $cart->ip = $request->ip();
                $cart->product_id = $varient->product_id;
                $cart->color_id = $varient->productcolor_id;
                $cart->variant_id = $varient->id;
                $cart->quantity = $request->quantity;
                $cart->price = $varient->sale_price;
                $cart->save();
            }

            $count = Cart::where('ip', $request->ip())->count();
        }
        $response = [
            'status' => 'Success',
            'item' => $count
        ];

//        return response()->json($response, 200);

        return redirect()->route('checkout')->with($response);
    }

    public function addtowishlist(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        $varient = Productvariant::where('product_id', $product->id)->first();
        if (Auth::id()) {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user && $user->hasRole('user')) {
                $ex = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if (isset($ex)) {
                    $ex->delete();
                } else {
                    $wishlist = new Wishlist();
                    $wishlist->ip = $request->ip();
                    $wishlist->user_id = $user->id;
                    $wishlist->product_id = $product->id;
                    $wishlist->product_name = $product->name;
                    $wishlist->price = $varient->sale_price;
                    $wishlist->save();
                }
                $count = Wishlist::where('user_id', $user->id)->count();
            } else {
                $ex = Wishlist::where('product_id', $product->id)->where('ip', $request->ip())->first();
                if (isset($ex)) {
                    $ex->delete();
                } else {
                    $wishlist = new Wishlist();
                    $wishlist->ip = $request->ip();
                    $wishlist->product_id = $product->id;
                    $wishlist->product_name = $product->name;
                    $wishlist->price = $varient->sale_price;
                    $wishlist->save();
                }
                $count = Wishlist::where('ip', $request->ip())->count();
            }
        } else {
            $ex = Wishlist::where('product_id', $product->id)->where('ip', $request->ip())->first();
            if (isset($ex)) {
                $ex->delete();
            } else {
                $wishlist = new Wishlist();
                $wishlist->ip = $request->ip();
                $wishlist->product_id = $product->id;
                $wishlist->product_name = $product->name;
                $wishlist->price = $varient->sale_price;
                $wishlist->save();
            }
            $count = Wishlist::where('ip', $request->ip())->count();
        }

        $response = [
            'status' => 'Success',
            'item' => $count
        ];

        return response()->json($response, 200);
    }

    public function wishlist()
    {
        if (Auth::id()) {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user && $user->hasRole('user')) {
                $wishlists = Wishlist::where('user_id', $user->id)->get();
            } else {
                $wishlists = Wishlist::where('ip', \Request::ip())->get();
            }
        } else {
            $wishlists = Wishlist::where('ip', \Request::ip())->get();
        }

        return view('frontend.content.cart.wishlist', ['wishlists' => $wishlists]);
    }

    public function removeWish(Request $request)
    {
//        dd($request->all());

        if (Auth::id()) {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user && $user->hasRole('user')) {
                $wishlists = Wishlist::where('user_id', $user->id)->where('id', $request->id)->delete();
            } else {
                $wishlists = Wishlist::where('ip', \Request::ip())->where('id', $request->id)->delete();
            }
        } else {
            $wishlists = Wishlist::where('ip', \Request::ip())->where('id', $request->id)->delete();
        }

        return redirect()->back()->with('success', 'Wishlist Deleted Successfully');
    }

    public function loadcart()
    {
        if (Auth::id()) {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user && $user->hasRole('user')) {
                $carts = Cart::where('user_id', $user->id)->get();
            } else {
                $carts = Cart::where('ip', \Request::ip())->get();
            }
        } else {
            $carts = Cart::where('ip', \Request::ip())->get();
        }

        return view('frontend.content.cart.loadcart', ['carts', $carts]);
    }

    public function removecart(Request $request)
    {
        $carts = Cart::where('id', $request->cart_id)->delete();
        return response()->json('success');
    }

    public function viewcart()
    {
        if (Auth::id()) {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user && $user->hasRole('user')) {
                $carts = Cart::where('user_id', $user->id)->get();
            } else {
                $carts = Cart::where('ip', \Request::ip())->get();
            }
        } else {
            $carts = Cart::where('ip', \Request::ip())->get();
        }

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->price;
        });

        return view('frontend.content.cart.viewcart', ['carts' => $carts, 'totalPrice' => $totalPrice]);
    }

    public function checkout()
    {
        if (Auth::id()) {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user && $user->hasRole('user')) {
                $carts = Cart::where('user_id', $user->id)->get();
            } else {
                $carts = Cart::where('ip', \Request::ip())->get();
            }
        } else {
            $carts = Cart::where('ip', \Request::ip())->get();
        }

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->price;
        });

        $shippingCharges = ShippingCharge::where('status', 1)->get();
        return view('frontend.content.cart.checkout', ['shippingCharges' => $shippingCharges, 'carts' => $carts, 'totalPrice' => $totalPrice]);
    }


    public function setcoupon(Request $request)
    {

        $today = Carbon::today();
        $couponCode = $request->coupon_code;
        $coupon = Coupon::where('status', 1)
            ->where('expire_date', '>', $today)
            ->where('active_date', '<=', $today)   // coupon is active
            ->where('code', $couponCode) // note: removed extra space
            ->first();

        if ($coupon) {
            Session::put('coupon', $couponCode);
        } else {
            Session::forget('coupon');
        }

        return response()->json('success', 200);
    }

    public function loadlist()
    {
        if (Auth::id()) {
            $user = User::where('id', Auth::user()->id)->first();
            if ($user && $user->hasRole('user')) {
                $carts = Cart::where('user_id', $user->id)->get();
            } else {
                $carts = Cart::where('ip', \Request::ip())->get();
            }
        } else {
            $carts = Cart::where('ip', \Request::ip())->get();
        }

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->price;
        });

        return view('frontend.content.cart.loadlist', ['carts' => $carts, 'totalPrice' => $totalPrice]);
    }

    public function shopbycategory(Request $request)
    {
        // get the full query string (since your code is not using key=value)
        $affiliateCode = $request->query('ref');

        if ($affiliateCode) {
            // Save in session
            session(['ref_code' => $affiliateCode]);
        }

        $categories = Category::where('status', 1)->get();
        return view('frontend.content.page.shopbycategory', ['categories' => $categories]);
    }


    public function pagedata($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('frontend.content.page.index', ['page' => $page]);
    }

    public function blogdata()
    {
        $blogs = Blog::where('status', 1)->latest()->get();
        $randoms = Blog::where('status', 1)->inRandomOrder()->take(6)->get();
        return view('frontend.content.blogs.index', ['blogs' => $blogs, 'randoms' => $randoms]);
    }

    public function blogdetails($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $randoms = Blog::where('status', 1)->inRandomOrder()->take(6)->get();
        return view('frontend.content.blogs.details', ['blog' => $blog, 'randoms' => $randoms]);
    }


    public function orderPlace(Request $request)
    {
//        dd(session()->get('coupon'));
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|digits:11',
            'address' => 'required|string|min:10',
            'customer_note' => 'nullable|string',

        ]);

        $cart = Cart::where('ip', \Request::ip())->first();


        $ip = $request->ip();

        if ($ip === '127.0.0.1' || $ip === '::1') {
            $ip = '8.8.8.8'; // fallback for local testing
        }


        $geoLocation = GeoLocation::lookup('103.87.215.67') ?? null;

//        dd($geoLocation);
        if ($geoLocation) {
            $country = $geoLocation->getCountry();
            $city = $geoLocation->getCity();
            $latitude = $geoLocation->getLatitude();
            $longitude = $geoLocation->getLongitude();
        }

        if (!$cart) {
            return redirect()->back()->with(
                'error',
                'Your cart is empty. Please add items to your cart before placing an order.'
            );
        }

        $carts = Cart::where('ip', \Request::ip())->get();
        $subtotal = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->price;
        });
        if (session()->has('coupon')) {
            $discount = Coupon::where('code', session()->get('coupon'))->first();

            if ($discount->type == 'flat') {

                $discountCharge = $discount->discount;

                $subtotal = $subtotal - $discountCharge;
            } else {
                $discountCharge = ($subtotal * $discount->discount / 100);
                $subtotal = $subtotal - $discountCharge;
            }
        }

        $shippingCharge = ShippingCharge::where('id', $request->shipping_charge_id)->first();

        //check affiliate code
        if (session()->has('ref_code')) {
            $ref_code = session()->get('ref_code');
            $user = User::where('ref_code', $ref_code)->first();
            $affiliate_id = $user->id;
        }

        DB::beginTransaction();

        try {

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();

            $order = new Order();
            $order->customer_id = $customer->id;
            $order->user_id = auth()->user()->id ?? null;
            $order->affiliate_id = $affiliate_id ?? null;
            $order->invoiceID = $order->invoiceGenerator();
            $order->payment_method = $request->payment_method;
            $order->customer_note = $request->customer_note;
            $order->subtotal = $subtotal;
            $order->total = $subtotal + $shippingCharge->delivery_charge;
            $order->shipping_charge_id = $request->shipping_charge_id;
            $order->delivery_charge = $shippingCharge->delivery_charge;
            $order->discount_charge = $discountCharge ?? null;
            $order->order_date = today();
            $order->area_name = $city ?? null;
            $order->order_status_id = 1;
            $order->payment_method = $request->payment_method;
            $order->save();

            foreach ($carts as $cartItem) {
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $cartItem->product_id;
                $orderProduct->productvariant_id = $cartItem->variant_id;
                $orderProduct->product_name = $cartItem->product->name;
                $orderProduct->product_SKU = $cartItem->product->SKU;
                $orderProduct->product_price = $cartItem->price;
                $orderProduct->quantity = $cartItem->quantity;
                $orderProduct->color = $cartItem->productcolor->color_name;
                $orderProduct->variant = $cartItem->productvariant->variant_name;
                $orderProduct->save();
            }

            //delete ref_code Session
            session()->forget('ref_code');
            session()->forget('coupon');

            DB::commit();

            Cart::where('ip', \Request::ip())->delete();

            return view('frontend.content.order.success-page', compact('order'));
        } catch (Exception $exception) {
            DB::rollBack();

//            dd($exception->getMessage());
            return redirect()->back()->with(
                'error', 'Please try again'
            );
        }
    }

    public function getShippingCharge(Request $request)
    {
        $shipping = ShippingCharge::findOrFail($request->id);

        return response()->json([
            'delivery_charge' => $shipping->delivery_charge
        ]);
    }


    public function userDashboard()
    {
        return view('frontend.content.dashboard.index');
    }

    public function addProductAffiliate(Request $request)
    {
        AffiliateProduct::updateOrCreate(
            [
                'affiliate_id' => Auth::id(),
                'product_id' => $request->product_id,
            ],

            [] // no extra fields to update
        );

        return redirect()->back()->with('success', 'Product Added Successfully');
    }
}
