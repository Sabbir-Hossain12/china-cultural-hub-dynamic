<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Productcolor;
use App\Models\Productvariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create a product
        $product = Product::create([
            'category_id' => 1, // must exist in categories table
            'brand_id' => 1, // must exist in brands table
            'subcategory_id' => null,
            'childcategory_id' => null,
            'product_type_id' => 1, // must exist in product_types table

            'name' => 'Dark yellow lace cut out swing dress with 50% Discount and lifetime support, and many more',
            'slug' => 'dark-yellow-lace-cut-out-swing',
            'short_description' => 'This is a short description of the sample product.',
            'long_description' => 'This is a long description of the sample product with more details.',
            'thumbnail_img' => 'public/1.jpg',

            'SKU' => 'SKU12345',
            'shipping_return_text' => 'Free shipping & easy returns within 7 days.',
            'additional_info_text' => 'Additional info about the product.',
            'youtube_link' => 'https://www.youtube.com/watch?v=abcd1234',

            'meta_title' => 'Sample Product Meta Title',
            'meta_description' => 'Meta description for SEO.',
            'meta_keywords' => 'sample, product, ecommerce',
            'meta_image' => 'products/sample-meta.jpg',
            'google_schema' => null,

            'status' => 1,
        ]);

        // Create a product color for the product
        $productColor = Productcolor::create([
            'color_id' => 2, // must exist in colors table
            'product_id' => $product->id,
            'color_name' => 'Red',
            'image' => 'public/1.jpg',
            'images' => json_encode([
                'public/2-small.jpg',
                'public/3-small.jpg'
            ]),
        ]);

        // Create a product variant under that color
        Productvariant::insert(
            [
                [
                    'variant_id' => 2, // must exist in variants table
                    'product_id' => $product->id,
                    'productcolor_id' => $productColor->id,
                    'variant_name' => 'XL',
                    'regular_price' => 600.00,
                    'sale_price' => 500.00,

                ],

                [
                    'variant_id' => 3, // must exist in variants table
                    'product_id' => $product->id,
                    'productcolor_id' => $productColor->id,
                    'variant_name' => 'L',
                    'regular_price' => 700.00,
                    'sale_price' => 600.00,

                ]
            ]);

    }
}
