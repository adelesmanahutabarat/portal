
<div class="text-right">
    @if($is_show==true)
        <a href="{{route("label.catalogfiles.destroy", $data)}}" class="btn btn-danger btn-sm" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.delete')}}"><i class="fas fa-trash-alt"></i></a>
    @endif
    <a href="{{route("label.catalogfiles.show", $data)}}" class="btn btn-success btn-sm " data-toggle="tooltip" title="" data-original-title="Download Files">
        <i class="fas fa-download"></i>
    </a>
</div>
