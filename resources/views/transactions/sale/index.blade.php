@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <x-create-button route="{{route('sale.create')}}" title=Sale />
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="sale-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Sale Date</th>
                            <th>Due Date</th>
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
        var table = $('#sale-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('sale.list') }}",
            columns: [{
                    data      : 'DT_RowIndex',
                    name      : 'DT_RowIndex',
                    orderable : false,
                    searchable: false,
                },
                {
                    data: 'product_list',
                    name: 'product_list'
                },
                {
                    data: 'customer_id',
                    name: 'customer_id'
                },
                {
                    data: 'sales_date',
                    name: 'sales_date'
                },
                {
                    data: 'due_date',
                    name: 'due_date'
                },
                {
                    data: 'grand_total',
                    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ),
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
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
                    let url = '{{ route('sale.destroy', ':id') }}';
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
