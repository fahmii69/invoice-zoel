@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')
                <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name' , $user->name) }}"
                        class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
            </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email' , $user->email) }}"
                        class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        @if($user->id)
                        placeholder="Only fill if you want to change password"
                        @endif
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        @if($user->id)
                        placeholder="Only fill if you want to change password"
                        @endif
                        class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="{{ url('') }}" class="btn btn-secondary float-right mr-2">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
@endpush
