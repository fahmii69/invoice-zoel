@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-puzzle-piece"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Product</span>
                    <span class="info-box-number">
                        {{ $product->count() }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-truck"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Supplier</span>
                    <span class="info-box-number">{{ $supplier->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">{{ $sale->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Customer</span>
                    <span class="info-box-number">{{ $customer->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Monthly Recap Report</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-wrench"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item">Action</a>
                                <a href="#" class="dropdown-item">Another action</a>
                                <a href="#" class="dropdown-item">Something else here</a>
                                <a class="dropdown-divider"></a>
                                <a href="#" class="dropdown-item">Separated link</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                    <!-- /.card-header -->
                <div class="card-footer">
				<div class="col-md-4">
                    <label for="" class="row">Date Range</label>
                    <input type="text" name="daterange" class="form-control row" value="" id="daterange" />
                    <br>
                </div>
				<div class="col-sm-12">
                    <canvas id="barChart" height="300" style="display: block; width: 1576px; max-height: 300px;" ></canvas>
                </div>
            </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">US-Visitors Report</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div>
                        <canvas id="pieChart" height="300" style="display: block; width: 1576px; max-height: 300px;" ></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-md-6">
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                    <!-- USERS LIST -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<!--/. container-fluid -->
@endsection
@push('js')
<script>

    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            locale:{
                format: 'DD/MM/YYYY'
            }
        }, function(startDate, endDate, label) {
            console.log(startDate, endDate)
            console.log("A new date selection was made: " + startDate.format('YYYY-MM-DD') + ' to ' + endDate.format('YYYY-MM-DD'));
            $('input[name="daterange"]').val(startDate.format('YYYY-MM-DD') + ' - ' + endDate.format('YYYY-MM-DD'));
            $('input[name="daterange"]').html(startDate.format('YYYY-MM-DD') + ' - ' + endDate.format('YYYY-MM-DD'));
            fetch_data(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));
        });
        
        var date=new Date(); 
        var firstDay=new Date(date.getFullYear(), date.getMonth(), 2).toISOString().slice(0, 10); 
        var lastDay=new Date(date.getFullYear(), date.getMonth() + 1,).toISOString().slice(0, 10); 
        $('input[name="daterange"]').val(firstDay + ' - ' + lastDay);
                $('input[name="daterange"]').html(firstDay + ' - ' + lastDay);
        fetch_data(firstDay, lastDay);

    });

    function fetch_data(startDate, endDate)
    {

        $.ajax({
            type: "GET",
            url: `{{ url("chart") }}`,
            data: {
                action : "fetch",
                startDate,
                endDate,	
            },
            success: function (response) {

                console.log(response.data.map);

                var labels = response.data.map(function (e) {
                    return e.sale.sales_date
                })

                var data = response.data.map(function (e) {
                    return e.total_quantity
                })

                console.log(response.data, labels, data);

                var ctx = $('#barChart');
                var ctx2 = $('#pieChart');
                var config = {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Product Sales per Day',
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 1)',

                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day',
                                    displayFormats: {
                                        quarter: 'MMM YYYY'
                                    }
                                }
                            }
                        }
                    }
                };
                // ctx.empty();


                const c = Chart.getChart(ctx);
                if (c) c.destroy();

                const d = Chart.getChart(ctx2);
                if (d) d.destroy();


                const myChart1 = new Chart(ctx, config);

                const myChart2 = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Product Sales per Day',
                            data: data,

                        }]
                    },
                    // options: options2
                })
                // var chart = new Chart(ctx, config);
            },
            error: function(xhr) {
                console.log(xhr.responseJSON);
            }
        });
    };
</script>
@endpush
