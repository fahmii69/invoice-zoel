@if(isset($canEdit) && $canEdit)
    <a href="{{$route}}" data-id="{{ $data->id }}" class="btn btn-warning btn-sm btn-edit"><i class="fas fa-edit me-1"></i>Edit</a>
@endif
@if(isset($canDelete) && $canDelete)
<a href='#' data-id="{{ $data->id }}" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash me-1"></i>Del</a>
@endif