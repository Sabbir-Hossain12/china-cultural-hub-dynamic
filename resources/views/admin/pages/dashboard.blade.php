@extends('admin.layout.app')

@push('css')

@endpush


@section('content')


    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-sm-0 font-size-18">Total</h3>
            </div>
        </div>
    </div>

    {{--  Overall Chart --}}

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- card -->
            <div class="card card-h-100 shadow">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 text-center  rounded">
                            <i class="fas fa-cart-plus h2"></i>
                        </div>

                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Orders</span>
                            <h4 class="mb-3">
                                <span class="">{{ $orderCount ?? 0 }}</span>
                            </h4>

                        </div>


                    </div>

                </div><!-- end card body -->
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- card -->
            <div class="card card-h-100 shadow">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 text-center  rounded">
                            <i class="fas fa-cart-plus h2"></i>
                        </div>

                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Products</span>
                            <h4 class="mb-3">
                                <span class="">{{ $productCount ?? 0 }}</span>
                            </h4>

                        </div>


                    </div>

                </div><!-- end card body -->
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- card -->
            <div class="card card-h-100 shadow">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 text-center  rounded">
                            <i class="fas fa-cart-plus h2"></i>
                        </div>

                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Categories</span>
                            <h4 class="mb-3">
                                <span class="">{{ $categoryCount ?? 0 }}</span>
                            </h4>

                        </div>


                    </div>

                </div><!-- end card body -->
            </div>
        </div>
    </div>

    {{--    Today --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-sm-0 font-size-18">Today</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- card -->
            <div class="card card-h-100 shadow">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 text-center  rounded">
                            <i class="fas fa-cart-plus h2"></i>
                        </div>

                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Orders</span>
                            <h4 class="mb-3">
                                <span class="">{{ $orderTodayCount ?? 0 }}</span>
                            </h4>
                        </div>
                    </div>

                </div><!-- end card body -->
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- card -->
            <div class="card card-h-100 shadow">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 text-center  rounded">
                            <i class="fas fa-cart-plus h2"></i>
                        </div>

                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Products</span>
                            <h4 class="mb-3">
                                <span class="">{{ $orderProductCount ?? 0 }}</span>
                            </h4>

                        </div>


                    </div>

                </div><!-- end card body -->
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- card -->
            <div class="card card-h-100 shadow">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 text-center  rounded">
                            <i class="fas fa-cart-plus h2"></i>
                        </div>

                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Categories</span>
                            <h4 class="mb-3">
                                <span class="">{{ $categoryTodayCount ?? 0 }}</span>
                            </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
    </div>


@endsection


@push('js')

@endpush
