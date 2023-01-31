@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">

        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('role.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="card shadow mb-4 col-6">
        {{-- <div class="card-body"> --}}
            <form action="{{ $action }}" method="POST">
                @csrf
                @if ($role->id)
                @method('put')
                @endif
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name' ,$role->name) }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 d-none">
                        {{-- <div class="form-group"> --}}
                            <strong>Permission:</strong>
                            <br />

                            @php
                            // $totalChunk = $permission->type;
                            @endphp
                            @foreach ($permission->chunk(5) as $chunk)
                            <div class="card-group">
                            @foreach($chunk as $value)
                            <div class="card">
                                <div class="card-title">
                                    {{ $value->type }}
                                </div>

                                <div>
                                    <input type="checkbox" name="permission[]" class="name" value="{{ $value->id }}"
                                        @checked( in_array($value->id, $rolePermissions ?? []))>
                                    {{ $value->alias }}
                                </div>
                                <br />
                            </div>
                            @endforeach
                        </div>
                        <br>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            @php $tempType = ""; @endphp
                            @forelse ($permission as $item)
                                @if($tempType != $item->type)
                                    @php $tempType = $item->type; @endphp
                                    <div class="col-md-3 col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ $item->type }}
                                            </div>
                                            <div class="card-body">
                                                @forelse ($permission->where('type', $item->type) as $list)
                                                    <div>
                                                        <input type="checkbox" name="permission[]" class="name" value="{{ $list->id }}"
                                                            @checked( in_array($list->id, $rolePermissions ?? []))>
                                                        {{ $list->alias }}
                                                    </div>
                                                @empty
                                                    
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                
                            @endforelse
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="{{ route('role.index') }}" class="btn btn-secondary float-right mr-2">Cancel</a>
                    </div>
                </div>
            </form>
        {{-- </div> --}}
    </div>
</div>
{{-- {!! Form::close() !!} --}}
@endsection
