@extends('main')
@section('content')

<div class="container">
    <!-- row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- pageheader -->
                <div>
                    <h2>Pembayaran</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center w-100">

        @foreach ($arr as $key => $val)
            <div class="col-md-4 col-sm-12">
                <div class="card card-product mb-lg-4">
                    <div class="card-body text-center py-8">
                        <img src="{{asset('assets/img/qrcode/'.$val->qr_code)}}" alt="Grocery Ecommerce Template" class="mb-3 img-fluid" style="width: 20%;">
                        <div class="text-truncate">{{$val->name}}</div>


                        <div class="row mt-3 mb-3">
                            <div class="col-12">
                                @if ($val->status == 1)
                                    <button type="button" class="btn btn-danger btn-sm w-100" disabled>
                                        <i class="bi bi-person-circle"></i> Terisi
                                    </button>
                                @else
                                    <button type="button" class="btn btn-info btn-sm w-100" disabled>
                                        <i class="bi bi-check2-circle"></i> Kosong
                                    </button>
                                @endif

                            </div>
                        </div>

                        <div class="row mb-3">
                            @if ($val->status == 1)
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary w-100" data-name="print_order" data-item="{{$val->id}}">
                                        <i class="bi bi-printer"></i> Print Order
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary w-100" data-name="end_order" data-item="{{$val->id}}">
                                        <i class="bi bi-align-end"></i> End Order
                                    </button>
                                </div>
                            @else
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary w-100" disabled>
                                        <i class="bi bi-printer"></i> Print Order
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary w-100" disabled>
                                        <i class="bi bi-align-end"></i> End Order
                                    </button>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>

</div>

{{-- Modal Print Order --}}
<div class="modal fade" id="modal_print_order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Print Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="areaprint">

                <div class="card-body text-center py-8">
                    <img id="show_img" src="{{asset('assets/img/qrcode/01.svg')}}" alt="Grocery Ecommerce Template" class="mb-3 img-fluid" style="width: 20%;">
                    <div class="text-truncate" id="show_name">-</div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;">No</th>
                            <th style="vertical-align: middle;">Kategori</th>
                            <th style="vertical-align: middle;">Name</th>
                            <th class="text-center">Dine In</th>
                            <th class="text-center">Take Away</th>
                            <th class="text-center">Total Qty</th>
                            <th class="text-center" style="vertical-align: middle;">Price</th>
                            <th class="text-center">Total Price</th>
                        </tr>
                    </thead>
                    <tbody id="list_order">

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7" class="text-center">Total Pembayaran</th>
                            <th id="total_harga">Rp. </th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="print_orderan"><i class="bi bi-printer"></i></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Print Order --}}

{{-- JS Print HTML --}}
<script>
    $(document).on("click", "[data-name='print_orderan']", function (e) {
        var divToPrint  = $("#areaprint");
        var newWin = window.open('', '_blank');
            newWin.document.open();
            newWin.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Print</title>
                    <link rel="stylesheet" href="{{asset('assets/css/theme.min.css')}}">
                    <style>
                        body { font-family: Arial, sans-serif; }
                        table { border-collapse: collapse; width: 100%; }
                        table, th, td { border: 1px solid black; }
                        th, td { padding: 8px; text-align: left; }
                    </style>
                </head>
                <body>
                    ${divToPrint.html()}
                </body>
                </html>
            `);
            newWin.document.close();
            newWin.print();
    });
</script>
{{-- End JS Print HTML --}}

{{-- JS Print Orderan --}}
<script>
    $(document).on("click", "[data-name='print_order']", function (e) {
        var id      = $(this).attr("data-item");
        $.ajax({
            type: "POST",
            url: "{{ route('showprintorder') }}",
            data: {id:id},
            cache: false,
            success: function(data) {
                // console.log(data['data']);
                $("#show_name").text(data.show_name);
                $("#total_harga").text(data.total);
                $("#list_order").html(data.list);

                var show_foto   = "assets/img/qrcode/"+data.foto;
                $('#show_img').attr('src', show_foto);
                $("#modal_print_order").modal('show');
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
{{-- End JS Print Orderan --}}

{{-- JS End Orderan --}}
<script>
    $(document).on("click", "[data-name='end_order']", function (e) {
        var id      = $(this).attr("data-item");
        $.ajax({
            type: "POST",
            url: "{{ route('endorder') }}",
            data: {id:id},
            cache: false,
            success: function(response) {
                // console.log(data['data']);
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
                        title: 'Gagal!',
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
{{-- End JS End Orderan --}}

@stop
