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
				<div class="col-md-4 p-4">
                    <label for="" class="row">Date Range</label>
                    <input type="text" name="daterange" class="form-control row" value="" id="daterange" />
                    <br>
                </div>
				<div class="col-sm-12">
                    <canvas id="myChart" height="300" style="display: block; width: 1576px; max-height: 300px;" ></canvas>
                </div>
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

                <!-- ./card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                    17%</span>
                                <h5 class="description-header">$35,210.43</h5>
                                <span class="description-text">TOTAL REVENUE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                    0%</span>
                                <h5 class="description-header">$10,390.90</h5>
                                <span class="description-text">TOTAL COST</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                    20%</span>
                                <h5 class="description-header">$24,813.53</h5>
                                <span class="description-text">TOTAL PROFIT</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                    18%</span>
                                <h5 class="description-header">1200</h5>
                                <span class="description-text">GOAL COMPLETIONS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-footer -->
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


		let date = new Date();
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();

        // This arrangement can be altered based on how we want the date's format to appear.
        let currentDate = `${year}-${month}-${day}`;
        fetch_data(currentDate, currentDate);
	    
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

                    var labels = response.data.map(function (e) {
                        return e.product_id
                    })

                    var data = response.data.map(function (e) {
                        return e.total_quantity
                    })

                    console.log(response.data, labels, data);

                    var ctx = $('#myChart');
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
                                // yAxes: [{
                                //     ticks: {
                                //         beginAtZero: true
                                //     }
                                // }]
                            }
                        }
                    };
					// ctx.empty();

					const c = Chart.getChart(ctx);
					if (c) c.destroy();

					new Chart(ctx, config);
                    // var chart = new Chart(ctx, config);
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                }
            });
        };
</script>
@endpush
