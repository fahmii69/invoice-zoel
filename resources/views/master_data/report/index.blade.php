@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4 col-8">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="" class="row">Date Range</label>
                    <input type="text" name="daterange" class="form-control  @error('daterange') is-invalid @enderror"
                        id="daterange" value="{{ $period }}" />
                        <div class="bd-highlight mt-2">
                            <button class="btn btn-success btn-icon-split btn-export">
                                <i class="fas fa-plus-circle"></i> Export Excel</butt>
                        </div>
                    @error('daterange')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <br>
                </div>
            </div>
            <div class="form-group mt-4 table-responsive">
                <table class="table" width="100%">
                    <thead>
                        <th style="width: 500px">Product</th>
                        <th>Quantity </th>
                    </thead>
                    <tbody id="product-column">
                        <x-reports.breakdownsales :saleDetail="$saleDetail" :startDate="$startDate" :endDate="$endDate"/>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
<script>
    $(function () {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            locale: {
                format: 'DD-MM-YYYY'
            }
        }, function (startDate, endDate, label) {
            // console.log(startDate, endDate)
            console.log("A new date selection was made: " + startDate.format('YYYY-MM-DD') + ' to ' +
                endDate.format('YYYY-MM-DD'));
            $('input[name="daterange"]').val(startDate.format('YYYY-MM-DD') + ' - ' + endDate.format(
                'YYYY-MM-DD'));
            $('input[name="daterange"]').html(startDate.format('YYYY-MM-DD') + ' - ' + endDate.format(
                'YYYY-MM-DD'));
            loopSales(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));

        });
    });

    $(document).on('click', '.btn-export', function(){
        let url = "{{ route('report.export',['daterange' => 'x1']) }}";
        url = url.replace("x1", $('#daterange').val());
        window.open(url, '_blank');
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var loopSales = async function (startDate, endDate) {

        salesQuantity = await getTotalSalesQuantity(startDate, endDate);

        var tr = $('#product-column').find('.tes-product ');
        $('#product-column').empty();
        $.each(tr, function (i, v) {
            container = $(this);

            let productId = container.find('.productId').html();
            let quantity = container.find('.quantity').html();
        })

        $('#product-column').html(salesQuantity.html);
    }

    let getTotalSalesQuantity = async function (startDate, endDate) {
        let result = await fetch("{{ route('report.getTotalSalesQuantity') }}", {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": "{{ csrf_token() }}"
            },
            method: "post",
            body: JSON.stringify({
                startDate,
                endDate,
            }),
        }).then(function (response) {
            return response.json()
        })

        return result;
    }

</script>
@endpush
