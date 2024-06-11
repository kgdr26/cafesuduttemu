@extends('main')
@section('content')

<div class="container">
    <!-- row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- pageheader -->
                <div>
                    <h2>List Product</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List Product</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <button type="button" class="btn btn-primary" data-name="add">Add New Product</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xl-12 col-12 mb-5">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-3">
                    <!-- table -->
                    <div class="table-responsive ">
                        <table class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox" id="dataTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Img</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Is Active</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($arr as $key => $value)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>
                                            <img src="{{asset('assets/img/products/'.$value->foto)}}" alt="" class="avatar avatar-xs rounded-circle">
                                        </td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->cat_name}}</td>
                                        <td>Rp. {{number_format($value->price, 0, ',', '.')}}</td>
                                        <td>{{$value->qty}}</td>
                                        <td>Is Active</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm" data-name="edit" data-item="{{$value->id}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm" data-name="delete" data-item="{{$value->id}}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Add --}}
<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <div class="card-style">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" id="" placeholder="Name" data-name="name">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="text" class="form-control" id="" placeholder="Price" data-name="price">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">QTY</label>
                                <input type="number" class="form-control" id="" placeholder="QTY" data-name="qty">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <select data-name="category_id" class="form-select select-2-add">
                                    <option value="">-- Select Category --</option>
                                    @foreach($cat as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card-style">
                            <div class="card-foto">
                                <img src="{{asset('assets/img/products/default.png')}}" alt="user avatar" id="img_add">
                            </div>
                            <div class="input-type-file">
                                <input type="file" id="add_image" name="add_image" accept="image/*" />
                                <label for="add_image">Choose File</label>
                            </div>
                            <input type="hidden" id="add_name_foto" data-name="foto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save_add">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal ADD --}}

{{-- Modal Edit --}}
<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <div class="card-style">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" id="" placeholder="Name" data-name="edit_name">
                                <input type="hidden" data-name="edit_id">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="text" class="form-control" id="" placeholder="Price" data-name="edit_price">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">QTY</label>
                                <input type="number" class="form-control" id="" placeholder="QTY" data-name="edit_qty">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <select data-name="edit_category_id" class="form-select select-2-edit">
                                    <option value="">-- Select Category --</option>
                                    @foreach($cat as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card-style">
                            <div class="card-foto">
                                <img src="" alt="user avatar" id="img_edit">
                            </div>
                            <div class="input-type-file">
                                <input type="file" id="edit_foto" name="edit_foto" accept="image/*" />
                                <label for="edit_foto">Choose File</label>
                            </div>
                            <input type="hidden" id="edit_name_foto" data-name="edit_foto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save_edit">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Edit --}}

{{-- JS Add Data --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $("[data-name='name']").val('');
        $("[data-name='price']").val('');
        $("[data-name='qty']").val('');
        $("[data-name='category_id']").val('').trigger("change");
        $("[data-name='foto']").val('');
        $("#modal_add").modal('show');
    });

    $("[data-name='price']").on('keyup', function() {
        var inputVal = $(this).val();
        var numberString = inputVal.replace(/[^,\d]/g, '').toString();
        var split = numberString.split(',');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        $(this).val('Rp. '+rupiah);
    });

    $(document).on("click", "[data-name='save_add']", function (e) {
        var name        = $("[data-name='name']").val();
        var price_asli  = $("[data-name='price']").val();
        var price       = price_asli.replace(/[^0-9]/g, '');
        var qty         = $("[data-name='qty']").val();
        var category_id = $("[data-name='category_id']").val();
        var foto        = $("[data-name='foto']").val();
        var is_active   = 1;
        var update_by   = "{!! $idnusr->id !!}";
        var table       = "trx_product";
        if(foto === ''){
            var foto    = 'default.png';
        }else{
            var foto    = $("[data-name='foto']").val();
        }

        var data = {
                name:name,
                price:price,
                qty:qty,
                category_id:category_id,
                foto:foto,
                is_active: is_active,
                update_by: update_by
            };

        if (name === '' || category_id === '' || price === '' || qty === '') {
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
                url: "{{ route('actionadd') }}",
                data: {table: table, data: data},
                cache: false,
                success: function(data) {
                    // console.log(data);
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        location.reload();
                    })
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

    $("#add_image").on("change", function(e){
        var ext = $("#add_image").val().split('.').pop().toLowerCase();
        // console.log(ext)
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format image failed!'
            })
        } else {
            var uploadedFile    = URL.createObjectURL(e.target.files[0]);
            $('#img_add').attr('src', uploadedFile);
            var photo           = e.target.files[0];
            var formData        = new FormData();
            formData.append('add_image', photo);
            $.ajax({
                url: "{{route('upload_profile')}}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    $('#add_name_foto').val(res);
                }
            })

        }
    });
</script>
{{-- End JS Add Data --}}

{{-- JS Edit Data --}}
<script>
    $("[data-name='edit_price']").on('keyup', function() {
        var inputVal = $(this).val();
        var numberString = inputVal.replace(/[^,\d]/g, '').toString();
        var split = numberString.split(',');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        $(this).val('Rp. '+rupiah);
    });

    $(document).on("click", "[data-name='edit']", function (e) {
        var id      = $(this).attr("data-item");
        var table   = 'trx_product';
        var field   = 'id';

        $.ajax({
            type: "POST",
            url: "{{ route('actionshowdata') }}",
            data: {id:id,table:table,field:field},
            cache: false,
            success: function(data) {
                // console.log(data['data']);
                $("[data-name='edit_id']").val(data['data'].id);
                $("[data-name='edit_name']").val(data['data'].name);
                $("[data-name='edit_price']").val(data['data'].price);
                $("[data-name='edit_qty']").val(data['data'].qty);
                $("[data-name='edit_category_id']").val(data['data'].category_id).trigger("change");
                $("[data-name='edit_foto']").val(data['data'].foto);
                var show_foto   = "assets/img/products/"+data['data'].foto;
                $('#img_edit').attr('src', show_foto);
                $("#modal_edit").modal('show');
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

    $(document).on("click", "[data-name='save_edit']", function (e) {
        var name        = $("[data-name='edit_name']").val();
        var price_asli  = $("[data-name='edit_price']").val();
        var price       = price_asli.replace(/[^0-9]/g, '');
        var qty         = $("[data-name='edit_qty']").val();
        var category_id = $("[data-name='edit_category_id']").val();
        var foto        = $("[data-name='edit_foto']").val();
        var is_active   = 1;
        var update_by   = "{!! $idnusr->id !!}";
        if(foto === ''){
            var foto    = 'default.png';
        }else{
            var foto    = $("[data-name='edit_foto']").val();
        }

        var table       = "trx_product";
        var whr         = "id";
        var id          = $("[data-name='edit_id']").val();
        var dats        = {
            name:name,
            price:price,
            qty:qty,
            category_id:category_id,
            foto:foto,
            is_active: is_active,
            update_by: update_by
        };

        if (name === '' || category_id === '' || price === '' || qty === '') {
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
                url: "{{ route('actionedit') }}",
                data: {id:id,whr:whr,table:table,dats:dats},
                cache: false,
                success: function(data) {
                    // console.log(data);
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        location.reload();
                    })
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

    $("#edit_foto").on("change", function(e){
        var ext = $("#edit_foto").val().split('.').pop().toLowerCase();
        // console.log(ext)
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format image failed!'
            })
        } else {
            var uploadedFile    = URL.createObjectURL(e.target.files[0]);
            $('#img_edit').attr('src', uploadedFile);
            var photo           = e.target.files[0];
            var formData        = new FormData();
            formData.append('add_image', photo);
            $.ajax({
                url: "{{route('upload_profile')}}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    $('#edit_name_foto').val(res);
                }
            })

        }
    });
</script>
{{-- End JS Edit Data --}}

{{-- JS Delete Data --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        var id      = $(this).attr("data-item");
        var table   = 'users';
        var whr     = 'id';

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Aksi ini tidak dapat diulang!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('actiondelete') }}",
                    data: {id:id,whr:whr,table:table},
                    cache: false,
                    success: function(data) {
                        Swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((data) => {
                            location.reload();
                        })
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
        })
    });
</script>
{{-- End JS Delete Data --}}

{{-- Select2 --}}
<script>
    $(".select-2-add").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $("#modal_add")
    });

    $(".select-2-edit").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $("#modal_edit")
    });
</script>
{{-- End Select2 --}}

{{-- Datatable --}}
<script>
    $('#dataTable').DataTable();
</script>
{{-- End Datatable --}}

@stop
