<div class="text-right">
    @can('edit_'.$module_name)
    @if($module_name == "employees")
        <x-buttons.edit route='{{route("backend.users.edit", $data)}}'
        title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @else
        <x-buttons.edit route='{{route("backend.$module_name.edit", $data)}}'
        title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endif

    @endcan
    @if($module_name <> 'banks' and $module_name <> 'branches' and $module_name <> 'employeestatus')
                <x-buttons.show route='{!!route("backend.$module_name.show", $data)!!}'
                    title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
                @endif
</div>