@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form action="{{ $action }}" method="POST">
                @csrf
                @if ($role->id)
                @method('put')
                @endif
                <div class="row">
                    <div class="col-md-12">
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

                    <div class="col-sm-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br>
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
                                                <input type="checkbox" name="permission[]" class="name"
                                                    value="{{ $list->id }}" @checked( in_array($list->id,
                                                $rolePermissions ?? []))>
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
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="{{ route('role.index') }}" class="btn btn-secondary float-right mr-2">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
