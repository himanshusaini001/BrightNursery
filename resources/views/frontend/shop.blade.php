    @extends('main')
    @section('content')
{{-- 
    @php
    if (isset($category_with_product)) {
        echo "<pre>";
        foreach ($category_with_product as $product) {
            foreach ($product['products'] as $prod) {
                echo "CID: " . $prod->cid . "\n";
            }
        }
        echo "</pre>";
    }
    die;
@endphp --}}
    <!-- ##### Breadcrumb Area Start ##### -->
    <div class="breadcrumb-area">
        <!-- Top Breadcrumb Area -->
        <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(img/bg-img/24.jpg);">
            <h2>Shop</h2>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Shop Area Start ##### -->
    <section class="shop-page section-padding-0-100">
        <div class="container">
            <div class="row">
                <!-- Shop Sorting Data -->
                <div class="col-12">
                    <div class="shop-sorting-data d-flex flex-wrap align-items-center justify-content-center">
                        <!-- Shop Page Count -->
                        <div class="shop-page-count ">
                            <h2><b>All Type Plants</b></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Sidebar Area -->
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop-sidebar-area">

                        <!-- Shop Widget -->
                        {{-- <div class="shop-widget price mb-50">
                            <h4 class="widget-title">Prices</h4>
                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="8" data-max="30" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="8" data-value-max="30" data-label-result="Price:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all first-handle" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Price: $8 - $30</div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Shop Widget -->
                            <div class="shop-widget catagory mb-50">
                                <h4 class="widget-title">Categories</h4>
                                <div class="widget-desc">
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        
                                       <a href="" id="alldatafetch">All plants </a><span class="text-muted">({{$totalProduct}})</span>
                                    </div>
                                    @foreach ($category as $categoryid)
                                        
                                        <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <a href="" class="FetchProductWithValue" value="{{$categoryid->id}}">{{$categoryid->name}}</a>
                                                @php
                                                $printed = false; // Flag to track if we have printed the count
                                                
                                                foreach ($category_with_product as $countproduct) {
                                                    foreach ($countproduct['products'] as $countids) {
                                                        if ($categoryid->id == $countids->cid && !$printed) {
                                                            
                                                            echo "<span class='text-muted'>(" . $countproduct['product_count'] . ")</span>";
                                                            $printed = true; // Set flag to true once printed
                                                            break; // Exit inner loop since we printed the count
                                                        }
                                                    }
                                                }
                                            @endphp
                                               
                                                
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        <!-- Shop Widget -->
                        <div class="shop-widget sort-by mb-50">
                            <h4 class="widget-title">Sort by</h4>
                            <div class="widget-desc">
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <a href="" class="FetchProductWithValue" value="AtoZ">Alphabetically, A-Z</a>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                  <a href="" class="FetchProductWithValue" value="ZtoA">Alphabetically, Z-A</a>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                   <a href="" class="FetchProductWithValue" value="LowtoHigh">Price: Low to High</a>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                    <a href="" class="FetchProductWithValue" value="HighttoLow">Price: Hight to Low</a>
                                </div>
                            </div>
                        </div>

                        <!-- Shop Widget -->
                        <div class="shop-widget best-seller mb-50">
                            <h4 class="widget-title">Best Seller</h4>
                            <div class="widget-desc">

                                <!-- Single Best Seller Products -->
                                <div class="single-best-seller-product d-flex align-items-center">
                                    <div class="product-thumbnail">
                                        <a href="shop-details.html"><img src="img/bg-img/4.jpg" alt=""></a>
                                    </div>
                                    <div class="product-info">
                                        <a href="shop-details.html">Cactus Flower</a>
                                        <p>$10.99</p>
                                        <div class="ratings">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Best Seller Products -->
                                <div class="single-best-seller-product d-flex align-items-center">
                                    <div class="product-thumbnail">
                                        <a href="shop-details.html"><img src="img/bg-img/5.jpg" alt=""></a>
                                    </div>
                                    <div class="product-info">
                                        <a href="shop-details.html">Tulip Flower</a>
                                        <p>$11.99</p>
                                        <div class="ratings">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Best Seller Products -->
                                <div class="single-best-seller-product d-flex align-items-center">
                                    <div class="product-thumbnail">
                                        <a href="shop-details.html"><img src="img/bg-img/34.jpg" alt=""></a>
                                    </div>
                                    <div class="product-info">
                                        <a href="shop-details.html">Recuerdos Plant</a>
                                        <p>$9.99</p>
                                        <div class="ratings">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- All Products Area -->
                <div class="col-12 col-md-8 col-lg-9"  >
                    <div class="shop-products-area">
                        <div class="row"  id="allproduct">
                            @foreach($product as $allproduct)
                            <!-- Single Product Area -->
                                <div class="col-12 col-sm-6 col-lg-4" >
                                    <div class="single-product-area mb-50"  >
                                        <!-- Product Image -->
                                        <div class="product-img">
                                            <a href="shop-details.html"><img src="{{ asset('storage/img/product/' . $allproduct->img) }}" alt=""></a>
                                            <!-- Product Tag -->
                                            <div class="product-tag">
                                                <a href="#">Hot</a>
                                            </div>
                                            <div class="product-meta d-flex">
                                                <a href="#" class="wishlist-btn"><i class="icon_heart_alt"></i></a>
                                                <a href="{{route('cart')}}" class="add-to-cart-btn">Add to cart</a>
                                                <a href="#" class="compare-btn"><i class="arrow_left-right_alt"></i></a>
                                            </div>
                                        </div>
                                        <!-- Product Info -->
                                        <div class="product-info mt-15 text-center">
                                           <a href="{{ route('shopDetail', $allproduct->id) }}">
                                                <!-- Display the product name -->
                                                <p>{{ $allproduct->name }}</p>
                                            </a>
                                            <h6>{{$allproduct->price}}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                     <!-- Pagination -->
                     <div class="d-flex justify-content-center custom-pagination" id="paginationLinks">
                        @if(isset($product))
                        {!! $product->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Area End ##### -->

    @endsection