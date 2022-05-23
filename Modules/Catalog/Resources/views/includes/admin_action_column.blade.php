<div class="text-right">
    <x-buttons.show route='{!!route("admin.$module_name.show", $data)!!}' title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
</div>
