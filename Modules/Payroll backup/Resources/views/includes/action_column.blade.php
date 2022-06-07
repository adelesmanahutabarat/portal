<div class="text-right">
    @can('edit_'.$module_name)
    <x-buttons.edit route='{{route("backend.$module_name.edit", $data)}}'
        title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endcan
    @can('delete_'.$module_name)
    <x-buttons.delete route='{{route("backend.$module_name.trashed", $data)}}'
        title="{{__('Delete')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endcan
    @if($module_name <> 'banks' and $module_name <> 'branches' and $module_name <> 'employeestatus')
        <x-buttons.show route='{!!route("backend.$module_name.show", $data)!!}'
            title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endif
</div>