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
                                <h1 class="mt-3 mb-0 h4">Masukkan Kode Atau Scan</h1>
                                <small>Masukkan kode atau scan untuk memesan</small>
                            </div>
                            <div class="row g-3">
                                @if (isset($cek_order))
                                    <div class="col">
                                        <label for="postcod" class="visually-hidden">Postcode</label>
                                        <input type="text" class="form-control" id="" value="{{$cek_order->kode_table}}" disabled>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" disabled><i class="bi bi-qr-code-scan"></i></button>
                                    </div>
                                @else
                                    <div class="col">
                                        <label for="postcod" class="visually-hidden">Postcode</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter Postcode" disabled>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-name="action_scane"><i class="bi bi-qr-code-scan"></i></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-lg-8 my-8">
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
                            <a href="{{route('home',['category_id'=>null])}}" class="text-decoration-none text-inherit">
                                <div class="card mb-0 card-lift">
                                    <div class="card-body text-center py-3 text-center">
                                        <div>ALL</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        @foreach ($category as $key => $val)
                            <div class="item">
                                <a href="{{route('home',['category_id'=>$val->id])}}" class="text-decoration-none text-inherit">
                                    <div class="card mb-0 card-lift">
                                        <div class="card-body text-center py-3 text-center">
                                            <div>{{$val->name}}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="">
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
    </section> --}}

    <section class="">
        <div class="container mb-5">
            @foreach ($product as $key => $val)
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
                                                <img src="{{asset('assets/img/products/'.$val->foto)}}" alt="Grocery Ecommerce Template" class="mb-3 img-fluid" style="min-width: 5rem;max-width: 5rem;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-7 flex-grow-1">
                                        <div class="text-small mb-1">
                                            <a href="#!" class="text-decoration-none text-muted">
                                                <small>{{$val->cat_name}}</small>
                                            </a>
                                        </div>
                                        <h2 class="fs-6">
                                            <a href="" class="text-inherit text-decoration-none">
                                                {{$val->name}}
                                            </a>
                                        </h2>
                                    <div>
                                </div>
                                <div class=" mt-6">
                                    <!-- price -->
                                    <div>
                                        <span class="text-dark">Rp. {{number_format($val->price, 0, ',', '.')}}</span>
                                    </div>
                                    <div>
                                        <span class="text-dark">Stock : {{$val->qty}}</span>
                                    </div>
                                    <div class="mt-2">
                                        @if (isset($cek_order->id))
                                            <button type="button" class="btn btn-primary" data-name="add_cart" data-item="{{$val->id}}">
                                                <i class="bi bi-cart"></i> Add to Cart
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-primary" data-name="action_scane">
                                                <i class="bi bi-cart"></i> Add to Cart
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</main>

{{-- Modal Scan --}}
<div class="modal fade" id="modal_scan" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">Scan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-cam">
                    <div id="qr_reader"></div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kode</label>
                    <input type="text" class="form-control" placeholder="Kode" data-name="kode" id="kode">
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="action_booking">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- MOdal Scan --}}

{{-- Modal Add cart --}}
<div class="modal fade" id="modal_add_cart" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">Add Orderan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-4 col-5">
                                <div class="text-center position-relative ">
                                    <img id="add_foto" src="{{asset('assets/img/products/default.png')}}" alt="" class="mb-3 img-fluid" style="min-width: 5rem;max-width: 5rem;">
                                </div>
                            </div>
                            <div class="col-md-8 col-7 flex-grow-1">
                                <div class="text-small mb-1">
                                    <small id="add_cat">-</small>
                                </div>
                                <h2 class="fs-6" id="add_name">
                                    -
                                </h2>
                                <span class="text-dark" id="add_price">-</span><br>
                                <span class="text-dark" id="add_stock">Stock : -</span>
                            <div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mt-3">
                            <div class="col-6 ">
                                <label for="">Dine In</label>
                                <div class="input-group input-spinner">
                                    <input type="button" value="-" class="button-minus btn btn-sm " data-field="quantity">
                                    <input type="number" step="1" max="" value="1" name="quantity" data-name="dine_in" class="quantity-field form-control-sm form-input">
                                    <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Take Away</label>
                                <div class="input-group input-spinner">
                                    <input type="button" value="-" class="button-minus btn btn-sm" data-field="quantity">
                                    <input type="number" step="1" max="" value="1" name="quantity" data-name="take_away" class="quantity-field form-control-sm form-input">
                                    <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" data-name="id_product">
                        @if (isset($cek_order->id))
                            <input type="hidden" data-name="id_order" value="{{$cek_order->id}}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save_add">Add</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Add Cart --}}

{{-- JS Add Cart --}}
<script>
    $(document).on("click", "[data-name='add_cart']", function (e) {
        var id      = $(this).attr("data-item");
        $.ajax({
            type: "POST",
            url: "{{ route('showprod') }}",
            data: {id:id},
            cache: false,
            success: function(data) {
                // console.log(data['data']);
                $("[data-name='dine_in']").val(0);
                $("[data-name='take_away']").val(0);
                $("[data-name='id_product']").val(id);
                $("#add_cat").text(data.cat);
                $("#add_name").text(data.name);
                $("#add_price").text('Rp. '+data.price);
                $("#add_stock").text('Stock : '+data.stock);

                var show_foto   = "assets/img/products/"+data.foto;
                $('#add_foto').attr('src', show_foto);
                $("#modal_add_cart").modal('show');
            },
            error: function (data) {
                Swal.fire({
                    position:'center',
                    title: 'Action Not Valid!',
                    icon: 'warning',
                    showConfirmButton: true,
                    // timer: 1500
                }).then((data) => {
                    // location.reload();
                })
            }
        });
    });

    $(document).on("click", "[data-name='save_add']", function (e) {
        var id_product  = $("[data-name='id_product']").val();
        var dine_in     = $("[data-name='dine_in']").val();
        var take_away   = $("[data-name='take_away']").val();
        var id_order    = $("[data-name='id_order']").val();

        if (id_product === '' || dine_in === '' || take_away == '') {
            Swal.fire({
                position:'center',
                title: 'Form is empty!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
            })
        }else{
            $.ajax({
                type: "POST",
                url: "{{ route('addcart') }}",
                data: {id_product: id_product, dine_in: dine_in, take_away: take_away, id_order: id_order},
                cache: false,
                success: function(response) {
                    if(response === 'success'){
                        Swal.fire({
                            position: 'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((response) => {
                            location.reload();
                        })
                    }else{
                        Swal.fire({
                            position: 'center',
                            title: 'Kode Tidak bOleh sama!',
                            icon: 'warning',
                            showConfirmButton: true,
                            // timer: 1500
                        }).then((response) => {
                            // location.reload();
                        })
                    }
                },
                error: function (data) {
                    Swal.fire({
                        position:'center',
                        title: 'Action Not Valid!',
                        icon: 'warning',
                        showConfirmButton: true,
                        // timer: 1500
                    }).then((data) => {
                        // location.reload();
                    })
                }
            });
        }

    });
</script>
{{-- End JS Add Cart --}}

{{-- JS Scan --}}
<script>
    $(document).on("click", "[data-name='action_scane']", function (e) {
        $("[data-name='kode']").val('');
        $("#modal_scan").modal('show');
    });

    $(document).on("click", "[data-name='action_booking']", function (e) {
        var kode        = $("[data-name='kode']").val();

        if (kode === '') {
            Swal.fire({
                position:'center',
                title: 'Form is empty!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
            })
        }else{
            $.ajax({
                type: "POST",
                url: "{{route('actbooking')}}",
                data: {kode: kode},
                cache: false,
                success: function(response) {
                    // console.log(data);
                    if(response === 'success'){
                        Swal.fire({
                            position: 'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((response) => {
                            location.reload();
                        })
                    }else{
                        Swal.fire({
                            position: 'center',
                            title: 'Meja sudah di booking hubungin kasir!',
                            icon: 'warning',
                            showConfirmButton: true,
                            // timer: 1500
                        }).then((response) => {
                            // location.reload();
                        })
                    }
                },
                error: function (data) {
                    Swal.fire({
                        position:'center',
                        title: 'Action Not Valid!',
                        icon: 'warning',
                        showConfirmButton: true,
                        // timer: 1500
                    }).then((data) => {
                        // location.reload();
                    })
                }
            });
        }
    });

    $('#modal_scan').on('shown.bs.modal', function (e) {
        initQrCodeScanner();
    });

    function initQrCodeScanner() {
        var resultContainer = document.getElementById('qr_reader_results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            $("#modal_scan").modal('hide');
            $('#kode').val(decodedText);
            var kode = decodedText;
            $.ajax({
                type: "POST",
                url: "{{route('actbooking')}}",
                data: {kode: kode},
                cache: false,
                success: function(response) {
                    // console.log(data);
                    location.reload();
                    // if(response === 'success'){
                    //     Swal.fire({
                    //         position: 'center',
                    //         title: 'Success!',
                    //         icon: 'success',
                    //         showConfirmButton: false,
                    //         timer: 1500
                    //     }).then((response) => {
                    //         location.reload();
                    //     })
                    // }else{
                    //     Swal.fire({
                    //         position: 'center',
                    //         title: 'Meja sudah di booking hubungin kasir!',
                    //         icon: 'warning',
                    //         showConfirmButton: true,
                    //         // timer: 1500
                    //     }).then((response) => {
                    //         // location.reload();
                    //     })
                    // }
                },
                error: function (data) {
                    Swal.fire({
                        position:'center',
                        title: 'Action Not Valid!',
                        icon: 'warning',
                        showConfirmButton: true,
                        // timer: 1500
                    }).then((data) => {
                        // location.reload();
                    })
                }
            });
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr_reader", { fps: 10, qrbox: 200 });
        html5QrcodeScanner.render(onScanSuccess);

        // Close the modal and stop the scanner
        $('#modal_scan').on('hidden.bs.modal', function (e) {
            html5QrcodeScanner.clear();
            // clear qr code
            $('#kode').val('');
        });
    }

    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        // Initialize scanner when DOM is ready
        initQrCodeScanner();
    });
</script>
{{-- End JS Scan --}}


@stop
