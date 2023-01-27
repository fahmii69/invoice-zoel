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
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name' , $customer->name) }}"
                        class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address' , $customer->address) }}"
                        class="form-control @error('address') is-invalid @enderror">
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" value="{{ old('state' , $customer->state) }}"
                            class="form-control @error('state') is-invalid @enderror">
                            @error('state')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" value="{{ old('province' , $customer->province) }}"
                            class="form-control @error('province') is-invalid @enderror">
                            @error('province')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode" name="postcode" value="{{ old('postcode' , $customer->postcode) }}"
                            class="form-control @error('postcode') is-invalid @enderror">
                            @error('postcode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="work_phone">Phone</label>
                        <input type="text" id="work_phone" name="work_phone" value="{{ old('work_phone' , $customer->work_phone) }}"
                            class="form-control @error('work_phone') is-invalid @enderror">
                            @error('work_phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" value="{{ old('country' , $customer->country) }}"
                            class="form-control @error('country') is-invalid @enderror">
                            @error('country')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="customer_type">Customer Type</label>
                        <input type="text" id="customer_type" name="customer_type" value="{{ old('customer_type' , $customer->customer_type) }}"
                            class="form-control @error('customer_type') is-invalid @enderror">
                            @error('customer_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="payment_terms">Payment Terms</label>
                        <input type="number" id="payment_terms" name="payment_terms" value="{{ old('payment_terms' , $customer->payment_terms) }}"
                            class="form-control @error('payment_terms') is-invalid @enderror">
                            @error('payment_terms')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="send_reminders">Send Reminders ?</label>
                    <input type='hidden' value='0' name="send_reminders">
                    <input type="checkbox" id="send_reminders" name="send_reminders" @checked(old('send_reminders', $customer->send_reminders))
                        class="@error('send_reminders') is-invalid @enderror">
                        @error('send_reminders')
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
<script>
    $('#send_reminders').on('change', function(){
    this.value = this.checked ? 1 : 0;
//    alert(this.value);
});
</script>
@endpush
