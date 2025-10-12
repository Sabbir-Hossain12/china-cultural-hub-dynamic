@extends('admin.layout.app')

@push('css')

    <style>
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            color: #fff;
            background-color: #1b1b29 !important;
        }
    </style>
@endpush


@section('content')
    <div class="container-fluid">
        {{--        <div class="row">--}}
        {{--            <div class="col-12">--}}
        {{--                <div class="page-title-box">--}}
        {{--                    <h3 class="page-title mb-4 text-center">Product Basic Information</h3>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        @include('admin.include.edit-topbar')


        <!-- end page title -->
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" class="row" action="{{ route('admin.product.update', $product->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Product Name *</label>
                                    <input type="text" class="form-control"
                                           name="name" value="{{ old('name', $product->name ?? '') }}" id="name"
                                           required>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- col-end -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="SKU" class="form-label">SKU *</label>
                                    <input type="text" class="form-control"
                                           name="SKU" value="{{ old('SKU', $product->SKU ?? '') }}" id="SKU"/>
                                    @error('SKU')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->

                            <!-- col-end -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="category_id" class="form-label">Categories *</label>
                                    <select class="form-control select2"
                                            name="category_id" id="category_id"
                                            required>
                                        <option value="">Select..</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="subcategory_id" class="form-label">SubCategories (Optional)</label>
                                    <select class="form-control select2" id="subcategory_id" name="subcategory_id"
                                            data-placeholder="Choose ...">
                                        <option value="">Select Subcategory</option>
                                    </select>
                                    @error('subcategory_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" id="current_subcategory_id" value="{{ $product->subcategory_id }}">
                            <!-- col end -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="childcategory_id" class="form-label">Child Categories
                                        (Optional)</label>
                                    <select class="form-control select2" id="childcategory_id" name="childcategory_id"
                                            data-placeholder="Choose ...">
                                        <option value=""> Select Child Category</option>
                                    </select>
                                    @error('childcategory_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" id="current_childcategory_id" value="{{ $product->childcategory_id }}">
                            <!-- col end -->

                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="category_id" class="form-label">Brands</label>
                                    <select id="brand_id"
                                            class="form-control select2"
                                            value="{{ old('brand_id') }}" name="brand_id">
                                        <option value="">Select..</option>
                                        @foreach($brands as $value)
                                            <option value="{{$value->id}}"
                                                    @if($product->brand_id == $value->id) selected @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('brand_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- col-end -->

                            <div class="col-sm-6 mb-3">
                                <label for="thumbnail_img">Thumbnail Image *</label>

                                <div class="input-group control-group increment">
                                    <input type="file" name="thumbnail_img" id="thumbnail_img"
                                           class="form-control"/>

                                    <div id="imgPreview">
                                        @if(isset($product->thumbnail_img))
                                            <img src="{{ asset($product->thumbnail_img) }}" width="50px" height="50px"
                                                 alt="Thumbnail image">
                                        @endif
                                    </div>

                                    @error('thumbnail_img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="youtube_link" class="form-label">Youtube Video (Optional)</label>
                                    <input type="text" class="form-control"
                                           name="youtube_link"
                                           value="{{ old('youtube_link', $product->youtube_link ?? '') }}"
                                           id="youtube_link"/>
                                    @error('youtube_link')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_type_id" class="form-label">Product Type</label>
                                    <select class="form-control" id="product_type_id" name="product_type_id">
                                        @forelse($productTypes as $type)
                                            <option value="{{$type->id}}"
                                                    @if($product->product_type_id == $type->id) selected @endif>{{$type->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="product_type_id" class="form-label">Affiliate Commission </label>
                                    <input type="number" class="form-control" name="affiliate_commission" value="{{ old('affiliate_commission',$product->affiliate_commission ?? 0)   }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short_description" rows="3"
                                              class="form-control">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="shipping_return_text">Shipping & Returns</label>
                                    <textarea name="shipping_return_text" id="shipping_return_text" rows="3"
                                              class="form-control">{{ old('shipping_return_text', $product->shipping_return_text ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="long_description">Long Description</label>
                                    <textarea name="long_description" id="long_description" rows="3"
                                              class="form-control">{{ old('long_description', $product->long_description ?? '') }}</textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="additional_info_text">Additional Information</label>
                                    <textarea name="additional_info_text" id="additional_info_text" rows="3"
                                              class="form-control">{{ old('additional_info_text', $product->additional_info_text ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control"
                                           name="meta_title" value="{{ old('meta_title', $product->meta_title ?? '') }}"
                                           id="meta_title"/>
                                    @error('SKU')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <input type="text" class="form-control"
                                           name="meta_description"
                                           value="{{ old('meta_description', $product->meta_description ?? '') }}"
                                           id="meta_description"/>
                                    @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="meta_image" class="form-label">Meta Image</label>
                                    <input type="file" class="form-control"
                                           name="meta_image" id="meta_image"/>

                                    <div id="metaImgPreview">
                                        @if(isset($product->meta_image))
                                            <img src="{{ asset($product->meta_image) }}" width="50px" height="50px"
                                                 alt="Meta image">
                                        @endif

                                        @error('meta_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="google_schema" class="form-label">Google Schema</label>

                                        <textarea class="form-control" name="google_schema"
                                                  id="google_schema">{{ old('google_schema', $product->google_schema ?? '') }}</textarea>

                                        @error('google_schema')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12 justify-content-center d-flex mt-4 w-100">
                                    <button type="submit" class="btn btn-primary me-2 w-100">Continue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')
    <script
        src="{{asset('https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js')}}"></script>

    <script>
        //Fetch Subcategories
        function fetchSubcategories(categoryId, selectedSubcategoryId = null) {
            if (categoryId) {
                $.ajax({
                    url: "{{ route('admin.subcategory-by-category', ':id') }}".replace(':id', categoryId),
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        let subcategorySelect = $('#subcategory_id');
                        subcategorySelect.empty().append('<option value="">Select Subcategory</option>');

                        if (response.status === 'success' && response.data.length > 0) {
                            $.each(response.data, function (index, subcategory) {
                                let selected = selectedSubcategoryId == subcategory.id ? 'selected' : '';
                                subcategorySelect.append('<option value="' + subcategory.id + '" ' + selected + '>' + subcategory.name + '</option>');
                            });
                        }
                    },
                    error: function () {
                        alert('Error fetching subcategories.');
                    }
                });
            } else {
                $('#subcategory_id').empty().append('<option value="">Select Subcategory</option>');
            }
        }

        //Fetch Childcategories
        function fetchChildCategories(subcategoryId, selectedId = null) {
            if (!subcategoryId) return;

            $.ajax({
                url: "{{ route('admin.child-category-by-subcategory', ':id') }}".replace(':id', subcategoryId),
                type: "GET",
                dataType: "json",
                success: function (response) {
                    let select = $('#childcategory_id');
                    select.empty().append('<option value="">Select Child Category</option>');

                    if (response.status === 'success' && response.data.length > 0) {
                        $.each(response.data, function (index, item) {
                            let selected = selectedId == item.id ? 'selected' : '';
                            select.append('<option value="' + item.id + '" ' + selected + '>' + item.name + '</option>');
                        });
                    }
                },
                error: function () {
                    alert('Error fetching child categories.');
                }
            });
        }

        // On category change
        $(document).on('change', '#category_id', function () {
            let categoryId = $(this).val();
            fetchSubcategories(categoryId);
        });

        // On subcategory change → load child categories
        $(document).on('change', '#subcategory_id', function () {
            fetchChildCategories($(this).val());
        });


        // On page load, populate subcategories if editing
        $(document).ready(function () {
            let categoryId = $('#category_id').val();
            let subcategoryId = $('#current_subcategory_id').val();
            let childcategoryId   = $('#current_childcategory_id').val(); // Hidden input
            fetchSubcategories(categoryId, subcategoryId);
            fetchChildCategories(subcategoryId,childcategoryId);


        });

        $(document).ready(function () {

            let jReq;
            ClassicEditor.create(document.querySelector('#long_description'))
                .then(editor => {
                    jReq = editor;
                })
                .catch(error => {
                    console.error(error);
                });


            ClassicEditor.create(document.querySelector('#additional_info_text'))
                .then(editor => {
                    jReq = editor;
                })
                .catch(error => {
                    console.error(error);
                });


        });

        // Subcategories by  Category
        $(document).on('change', '#category_id', function () {
            let categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: "{{ route('admin.subcategory-by-category', ':id') }}".replace(':id', categoryId),
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        let subcategorySelect = $('#subcategory_id');
                        subcategorySelect.empty().append('<option value="">Select Subcategory</option>');

                        if (response.status === 'success' && response.data.length > 0) {
                            $.each(response.data, function (index, subcategory) {
                                subcategorySelect.append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                            });
                        }
                    },
                    error: function () {
                        alert('Error fetching subcategories.');
                    }
                });
            } else {
                $('#subcategory_id').empty().append('<option value="">Select Subcategory</option>');
            }
        });

        // Child Categories by Subcategory
        $(document).on('change', '#subcategory_id', function () {
            let categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: "{{ route('admin.child-category-by-subcategory', ':id') }}".replace(':id', categoryId),
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        let subcategorySelect = $('#childcategory_id');
                        subcategorySelect.empty().append('<option value="">Select Subcategory</option>');

                        if (response.status === 'success' && response.data.length > 0) {
                            $.each(response.data, function (index, subcategory) {
                                subcategorySelect.append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                            });
                        }
                    },
                    error: function () {
                        alert('Error fetching subcategories.');
                    }
                });
            } else {
                $('#subcategory_id').empty().append('<option value="">Select Subcategory</option>');
            }
        });


    </script>
@endpush
