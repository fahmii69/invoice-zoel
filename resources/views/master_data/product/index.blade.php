@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <x-create-button route="{{route('product.create')}}" title=Product />
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Category</th>
                            <th>Inventory</th>
                            <th>Buy Price</th>
                            <th>Sale Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        var table = $('#product-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.list') }}",
            columns: [{
                    data      : 'DT_RowIndex',
                    name      : 'DT_RowIndex',
                    orderable : false,
                    searchable: false,
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category_id',
                    name: 'category_id'
                },
                {
                    data: 'total_inventory',
                    name: 'total_inventory'
                },
                {
                    data: 'buy_price',
                    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ),
                },
                {
                    data: 'sale_price',
                    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ),
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '10%'
                },
            ]
        });

        $(document).on('click','.btn-delete', function(){
            id = $(this).attr('data-id');

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                background: 'gray',
                timer: 5000
            });
            Swal.fire({
                // title: 'Are you sure?',
                text: "You won't be able to revert this!",
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete this!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    let url = '{{ route('product.destroy', ':id') }}';
                        url = url.replace(':id', id);

                    $.ajax({
                        url : url,
                        type : 'delete',
                        data : {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response){
                            
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                            table.ajax.reload();
                        },
                        error: function(e){
                            Toast.fire({
                                icon: 'error',
                                title: e.responseJSON.message
                            });
                        }
                    });
                }
            })
        })
    });
</script>
@endpush
