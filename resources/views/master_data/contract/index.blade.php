@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <x-create-button route="{{route('contract.create')}}" title=Contract />
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="contract-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Product Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
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
<script>
    $(document).ready(function () {
        var table = $('#contract-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('contract.list') }}",
            columns: [{
                    data      : 'DT_RowIndex',
                    name      : 'DT_RowIndex',
                    orderable : false,
                    searchable: false,
                },
                {
                    data: 'customer_id',
                    name: 'customer_id'
                },
                {
                    data: 'contract_product',
                    name: 'contract_product'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
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
                    let url = '{{ route('contract.destroy', ':id') }}';
                        url = url.replace(':id', id);

                    $.ajax({
                        url : url,
                        type : 'delete',
                        data : {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response){
                            if(response.success){
                                Toast.fire({
                                    icon: 'success',
                                    title: response.message
                                });
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.message
                                });
                            }
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
