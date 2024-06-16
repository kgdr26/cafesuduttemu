@extends('main')
@section('content')

<div class="container">
    <!-- row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- pageheader -->
                <div>
                    <h2>List Pesanan</h2>
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

    <div class="category-slider ">

        @foreach ($arr as $key => $val)
            <div class="item">
                <div class="text-decoration-none text-inherit">
                    <div class="card card-product mb-lg-4">
                        <div class="card-body text-center py-8">
                            <img src="{{asset('assets/img/qrcode/'.$val->qr_code)}}" alt="Grocery Ecommerce Template" class="mb-3 img-fluid" style="width: 20%;">
                            <div class="text-truncate">{{$val->name}}</div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;">No</th>
                                    <th style="vertical-align: middle;">Action</th>
                                    <th style="vertical-align: middle;">Kategori</th>
                                    <th style="vertical-align: middle;">Name</th>
                                    <th class="text-center">Dine In</th>
                                    <th class="text-center">Take Away</th>
                                    <th class="text-center">Total Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $data_list   = json_decode($val->orderan);
                                    $no = 1;
                                @endphp
                                @foreach ($data_list as $k => $v)
                                    @php
                                        $prd    = DB::table('trx_product')->select('trx_product.*', 'b.name as name_cat')
                                                ->leftJoin('mst_category as b', 'b.id', '=', 'trx_product.category_id')
                                                ->where('trx_product.id', $v->id_product)->first();
                                    @endphp
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>
                                            @if ($v->status == 2)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="" data-name="checklist" data-item="{{$k}}" data-order="{{$val->id}}" checked>
                                                    <label class="form-check-label" for=""></label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="" data-item="{{$k}}" data-order="{{$val->id}}" data-name="checklist">
                                                    <label class="form-check-label" for=""></label>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{$prd->name_cat}}</td>
                                        <td>{{$prd->name}}</td>
                                        <td class="text-center">{{$v->dine_in}}</td>
                                        <td class="text-center">{{$v->take_away}}</td>
                                        <td class="text-center">{{$v->dine_in+$v->take_away}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mb-5">
                            <button type="button" class="btn btn-primary" data-name="done_order" data-item="{{$val->id}}"><i class="bi bi-check2-square me-3"></i> Order Done</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>

{{-- JS Done Orderan --}}
<script>
    $(document).on("click", "[data-name='done_order']", function (e) {
        var id      = $(this).attr("data-item");

        $.ajax({
            type: "POST",
            url: "{{ route('actdoneorder') }}",
            data: {id: id},
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

    $(document).on("change", "[data-name='checklist']", function (e) {
        var id          = $(this).attr("data-item");
        var id_order    = $(this).attr("data-order");

        $.ajax({
            type: "POST",
            url: "{{ route('actioncheklist') }}",
            data: {id: id, id_order: id_order},
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
{{-- End JS Done Orderan --}}

@stop
