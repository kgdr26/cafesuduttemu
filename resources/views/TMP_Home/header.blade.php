<header class="py-lg-5 py-4 border-bottom border-bottom-lg-0">
    <div class="container">
        <div class="row w-100 align-items-center gx-3">
            <div class="col-xl-7 col-lg-8">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand d-none d-lg-block" href="">
                        <img src="{{asset('assets/images/logo/freshcart-logo.svg')}}" alt="eCommerce HTML Template" style="width: 25%;">
                    </a>
                </div>
                <div class="d-flex justify-content-between align-items-center w-100 d-lg-none">
                    <a class="navbar-brand mb-0" href="">
                        <img src="{{asset('assets/images/logo/freshcart-logo.svg')}}" alt="eCommerce HTML Template" style="width: 55%;">
                    </a>
                    <div class="d-flex align-items-center lh-1" style="white-space: nowrap">
                        <div class="list-inline me-4">
                            <div class="list-inline-item ">
                                <div class="dropdown  ">
                                    <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-shopping-cart align-text-bottom">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path
                                                    d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                                </path>
                                            </svg>
                                        </span>
                                        <span id="totalh2_1">Rp. -</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-5">
                                        <div class="d-flex justify-content-between align-items-center border-bottom pb-5 mb-3">
                                            <div>
                                                <span><i class="feather-icon icon-shopping-cart"></i></span>
                                                <span class="text-success" id="qtyh2_1">0</span>
                                            </div>
                                            <div>
                                                <span>Total:</span>
                                                <span class="text-success" id="totalh2_2">Rp. -</span>
                                            </div>
                                        </div>
                                        <ul class="list-group list-group-flush" id="listh2_1">

                                        </ul>
                                        @if (isset($cek_order->id))
                                            <div class="mt-2 d-grid">
                                                @if ($cek_order->status == 1)
                                                    <button type="button" class="btn btn-primary mb-3" data-name="checkout" data-item="{{$cek_order->id}}">Checkout</button>
                                                @endif

                                                @if ($cek_order->status == 2)
                                                    <button type="button" class="btn btn-light" data-name="showorderan" data-item="{{$cek_order->id}}">View Orderan</button>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-4 d-flex align-items-center ">
                <div class="list-inline ms-auto d-lg-block d-none">
                    <div class="list-inline-item me-3">
                        <div class="dropdown d-none d-xl-block ">
                            <a href="#" class="dropdown-toggle text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-shopping-cart align-text-bottom">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                        </path>
                                    </svg>
                                </span>
                                <span id="totalh1_1">Rp. -</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-5">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-5">
                                    <div>
                                        <span><i class="feather-icon icon-shopping-cart"></i></span>
                                        <span class="text-success" id="qtyh1_1">0</span>
                                    </div>
                                    <div>
                                        <span>Total:</span>
                                        <span class="text-success" id="totalh1_2">Rp. -</span>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush" id="listh1_1">

                                </ul>
                                @if (isset($cek_order->id))
                                    <div class="mt-2 d-grid">
                                        @if ($cek_order->status == 1)
                                            <button type="button" class="btn btn-primary mb-3" data-name="checkout" data-item="{{$cek_order->id}}">Checkout</button>
                                        @endif

                                        @if ($cek_order->status == 2)
                                            <button type="button" class="btn btn-light" data-name="showorderan" data-item="{{$cek_order->id}}">View Orderan</button>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- JS List Order --}}
<script>
    $(document).ready(function() {
        setTimeout(showdataorderan);
    });

    function showdataorderan() {
        var id  = "{!! $id_ordering !!}";

        $.ajax({
            type: "POST",
            url: "{{ route('showdataorder') }}",
            data: {id:id},
            cache: false,
            success: function(data) {
                // console.log(data);
                $('#totalh1_1').text('Rp. '+data.total);
                $('#totalh1_2').text('Rp. '+data.total);
                $('#qtyh1_1').text(data.qty);
                $('#listh1_1').html(data.list);

                $('#totalh2_1').text('Rp. '+data.total);
                $('#totalh2_2').text('Rp. '+data.total);
                $('#qtyh2_1').text(data.qty);
                $('#listh2_1').html(data.list);
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

        // alert(id);
    };
</script>
{{-- End JS List Order --}}

{{-- JS Checkout --}}
<script>
    $(document).on("click", "[data-name='checkout']", function (e) {
        var id  = $(this).attr("data-item");

        $.ajax({
            type: "POST",
            url: "{{ route('actcheckout') }}",
            data: {id:id},
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
    });
</script>
{{-- End JS Checkout --}}
