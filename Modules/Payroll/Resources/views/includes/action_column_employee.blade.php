<div class="text-right">
    @if($module_name == 'payrolls')
    <x-buttons.show route='{!!route("employee.$module_name.show", $data)!!}'
        title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endif

    @if($module_name == 'resetpayrolls')
    <x-buttons.delete route='{!!route("employee.$module_name.reset", $data)!!}'
        title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" idtag="reset" small="true" id/>
    @endif
</div>