@extends('main')
@section('content')

<div class="container">
    <!-- row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- pageheader -->
                <div>
                    <h2>Dashboard</h2>
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

    <div class="row ">
        <div class="col-xl-3 col-3 mb-5">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-xl-4 col-12">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <h1 class="text-primary"><i class="bi bi-cup-straw"></i></h1>
                            </div>
                        </div>
                        <div class="col-xl-8 col-12 text-center">
                            <p class="mb-0 fs-3" id="c_product">-</p>
                            <h4>Product</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-12 mb-5">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-xl-4 col-12">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <h1 class="text-primary"><i class="bi bi-inboxes-fill"></i></h1>
                            </div>
                        </div>
                        <div class="col-xl-8 col-12 text-center">
                            <p class="mb-0 fs-3" id="c_stock">-</p>
                            <h4>Stocks</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-12 mb-5">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-xl-4 col-12">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <h1 class="text-primary"><i class="bi bi-box-arrow-up"></i></h1>
                            </div>
                        </div>
                        <div class="col-xl-8 col-12 text-center">
                            <p class="mb-0 fs-3" id="c_sold">-</p>
                            <h4>Sold</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-12 mb-5">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id=""><i class="bi bi-table"></i></span>
                        <input type="text" class="form-control" id="" placeholder="Filter List Product" data-name="filter_table" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="input-group mb-0">
                        <span class="input-group-text" id=""><i class="bi bi-bar-chart-line"></i></span>
                        <input type="text" class="form-control" id="" placeholder="Filter Chart" data-name="filter_chart" value="">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-12 mb-5">
            <!-- card -->
            <div class="card h-100 card-lg">
                <!-- card body -->
                <div class="card-body p-3">
                    <h4 class="mb-0 fs-5">Sales History</h4><br>

                    <figure class="mb-0">
                        <div id="chart_history" style="height: 14rem;"></div>
                    </figure>

                </div>
            </div>
        </div>

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
                                    <th>Product Name</th>
                                    <th>Kategory</th>
                                    <th>Total Of Product Sold</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="table">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- JS Realtime Data --}}
<script>
    $(document).ready(function() {
        setTimeout(shoddatadashboard);
        setTimeout(chart_history);
    });

    function shoddatadashboard(date) {
        if(date == null){
            var date  = new Date();
        }else{
            var date  = date;
        }


        $.ajax({
            type: "POST",
            url: "{{ route('showdatadashboard') }}",
            data: {date:date},
            cache: false,
            success: function(data) {
                // console.log(data);
                $('#c_product').text(data.c_product);
                $('#c_stock').text(data.c_stock);
                $('#c_sold').text(data.c_sold);
                $('#table').html(data.table);

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

    };
</script>
{{-- End JS Realtime Data --}}

{{-- JS Chart History --}}
<script>
    Highcharts.chart('chart_history', {
        chart: {
            type: 'line',
            backgroundColor: null,
        },
        title: {
            text: null
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: []
            // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep','Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: null
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Sales History',
            data: [],
            // data: [16.0, 18.2, 23.1, 27.9, 32.2, 36.4, 39.8, 38.4, 35.5, 29.2,22.0, 17.8],
            color: '#76453B',
            dataLabels: {
            enabled: true,
            formatter: function() {
                // Format number as Rupiah
                return 'Rp ' + Highcharts.numberFormat(this.y, 0, ',', '.');
            }
        }
        }]
    });


    function chart_history(start, end) {
        var start   = start;
        var end     = end;
        var chart   = $('#chart_history').highcharts();

        $.ajax({
            type: "POST",
            url: "{{ route('showchartdashboard') }}",
            data: {start:start,end:end},
            cache: false,
            success: function(data) {
                // console.log(data);
                chart.xAxis[0].setCategories(data.categories);
                chart.series[0].setData(data.series);
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
</script>
{{-- End JS Chart History --}}

{{-- Datatable --}}
<script>
    $('#dataTable').DataTable();
</script>
{{-- End Datatable --}}

{{-- JS Datepicker --}}
<script>
    $('[data-name="filter_table"]').datepicker({
        format: "yyyy-mm-dd",
        viewMode: "days",
        minViewMode: "days",
        autoclose: true
    }).on('changeDate', function(e) {
        // console.log(e.date);
        var date = moment(e.date).format('YYYY-MM-DD');
        shoddatadashboard(date);
    });

    $('[data-name="filter_chart"]').daterangepicker();

    $('[data-name="filter_chart"]').on('apply.daterangepicker', function(ev, picker) {
        var start       = picker.startDate.format('YYYY-MM-DD');
        var end         = picker.endDate.format('YYYY-MM-DD');

        chart_history(start,end);
    });
</script>
{{-- End JS Datepicker --}}

@stop
