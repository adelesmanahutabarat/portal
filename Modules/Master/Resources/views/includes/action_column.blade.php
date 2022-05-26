<div class="text-right">
    @can('edit_'.$module_name)
    <x-buttons.edit route='#' title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endcan
    <x-buttons.show route='#' title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
</div>
