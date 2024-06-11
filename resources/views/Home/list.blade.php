@extends('home')
@section('content')

<main>
    <section class="py-lg-16 py-10" style="background: url(../assets/images/banner/banner-4.jpg)no-repeat; background-position: center; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-xl-4  col-lg-6 col-md-7">
                    <div class="card border-0 shadow">
                        <div class="card-body p-6">
                            <div class="mb-4">
                                <h1 class="mt-3 mb-0 h4">Masukkan Kode Atau Scane</h1>
                                <small>Masukkan kode atau scane untuk memesan</small>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label for="postcod" class="visually-hidden">Postcode</label>
                                    <input type="text" class="form-control" id="" placeholder="Enter Postcode" >
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-qr-code-scan"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-lg-14 my-8">
        <div class="container ">
            <div class="row align-items-center mb-6">
                <div class="col-10 ">
                    <div>
                        <h3 class="align-items-center d-flex mb-0 h4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-layers text-primary">
                                <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                <polyline points="2 17 12 22 22 17"></polyline>
                                <polyline points="2 12 12 17 22 12"></polyline>
                            </svg>
                            <span class="ms-3">Shop by Categories</span>
                        </h3>
                    </div>
                </div>
            <div class="col-2">
                <div class="slider-arrow  slider-8-columns-arrow" id="slider-8-columns-arrows"></div>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-12">
                <div class="position-relative">
                    <div class="slider-8-columns " id="slider-8-columns">
                        <div class="item">
                            <a href="" class="text-decoration-none text-inherit">
                                <div class="card mb-0 card-lift">
                                    <div class="card-body text-center py-3 text-center">
                                        <div>ALL</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        @for ($i=1;$i<=10;$i++)
                            <div class="item">
                                <a href="" class="text-decoration-none text-inherit">
                                    <div class="card mb-0 card-lift">
                                        <div class="card-body text-center py-3 text-center">
                                            <div>Bakery</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container ">
            <div class="input-group ">
                <input class="form-control rounded" type="search" placeholder="Search for products">
                <span class="input-group-append">
                    <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container ">
            @for ($i=1;$i<=10;$i++)
                <div class="row g-4 row-cols-1 mt-3">
                    <div class="col">
                        <!-- card -->
                        <div class="card card-product">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <!-- col -->
                                    <div class="col-md-4 col-5">
                                        <div class="text-center position-relative ">
                                            <a href="">
                                                <img src="../assets/images/products/product-img-1.jpg" alt="Grocery Ecommerce Template" class="mb-3 img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-7 flex-grow-1">
                                        <div class="text-small mb-1">
                                            <a href="#!" class="text-decoration-none text-muted">
                                                <small>Snack & Munchies</small>
                                            </a>
                                        </div>
                                        <h2 class="fs-6">
                                            <a href="" class="text-inherit text-decoration-none">
                                                Haldiram's Sev Bhujia
                                            </a>
                                        </h2>
                                    <div>
                                </div>
                                <div class=" mt-6">
                                    <!-- price -->
                                    <div>
                                        <span class="text-dark">Rp. 20.000</span>
                                    </div>
                                    <div>
                                        <div class="input-group input-spinner  ">
                                            <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                                            <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input">
                                            <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <a href="" class="btn btn-primary ">
                                            <i class="bi bi-cart"></i> Add to Cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>

</main>


@stop
