<div class="text-right">
    @can('edit_'.$module_name)
    <x-buttons.edit route='{!!route("label.$module_name.edit", $data)!!}' title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endcan
    <x-buttons.show route='{!!route("label.$module_name.show", $data)!!}' title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
</div>
