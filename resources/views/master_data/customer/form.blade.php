@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form action="{{ $action }}" method="POST">
                @csrf
                @if ($customer->id)
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="name">Customer Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name' , $customer->name) }}"
                        class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="address">Customer Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address' , $customer->address) }}"
                        class="form-control @error('address') is-invalid @enderror">
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Customer Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone' , $customer->phone) }}"
                        class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary float-right mr-2">Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
@endpush
