@extends('layouts.vertical')

@section('title') {{ __($module_action) }} {{ $module_title }} @endsection

@section('css')
<style>
.select2-disabled {
    background-color: #ddd;
    border-color: #a8a8a8;
}
</style>
@endsection

@section('breadcrumb')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ $module_title }}
    </x-backend-breadcrumb-item>

    <x-backend-breadcrumb-item type="active">{{ __($module_action) }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i> {{ $module_title }}
                    <small class="text-muted">{{ __('labels.backend.users.create.action') }} </small>
                </h4>
                <div class="small text-muted">
                    {{ $module_title }} Management
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <x-buttons.return-back />
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">
            {{ html()->form('POST', route("backend.$module_name.store"))->attribute('enctype','multipart/form-data')->class('form')->id('form-upload')->open() }}
                {{ csrf_field() }}

                <!-- <div class="form-group">
                    {{ html()->label('Periode')->class('form-control-label')->for('date_period') }}
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="date_period" value="">
                    </div>
                </div> -->

                <div class="form-group">
                    {{ html()->label('Pilih File')->class('form-control-label')->for('file') }}
                    {{ html()->file('report_file')
                                ->class('form-control')
                                ->attribute('maxlength', 191)
                                ->required() }}
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <x-buttons.create title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}">
                                {{__('Create')}}
                            </x-buttons.create>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>

    <table id="sample_table" style="display:none;">
        <tr id="">
            <td><span class="sn"></span>.</td>
            <td>
                <select class="custom-select mb-2 select-user select-2" name="user_id[]" id="user_id" required="true">
                    <option value="" selected>-</option>
                    @foreach ($users as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
            </td>
            <td><input type="text" class="form-control input-element nominal-detail" required="true"
                    onkeyup="myfunction()" name="nominal[]"></td>
            <td class="text-center"><a href="#" class="btn btn-xs delete-record btn-danger" data-id="0"><i
                        class="uil uil-minus"></i></a></td>
        </tr>
    </table>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">

                </small>
            </div>
        </div>
    </div>
</div>

@endsection

@push ('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</script>

<script src="{{ url(asset('assets/js/custom.js')) }}"></script>

@endpush