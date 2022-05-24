@extends('layouts.vertical')

@section('title') {{ __($module_action) }} {{ $module_title }} @endsection

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
                    <i class="{{$module_icon}}"></i> Bank
                    <small class="text-muted">{{ __('labels.backend.users.create.action') }} </small>
                </h4>
                <div class="small text-muted">
                    Bank Account Management
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
                {{ html()->form('POST', route('backend.bankaccounts.store'))->class('form-horizontal')->open() }}
                {{ csrf_field() }}

                <div class="form-group">
                    {{ html()->label('User')->class('form-control-label')->for('user') }}
                    <div class="input-group mb-3">
                        <select class="custom-select mb-2 select-user" name="user_id" id="user_id"
                            required="true">
                            <option value="" selected>Select User</option>
                            @foreach ($users as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    {{ html()->label('Bank')->class('form-control-label')->for('bank') }}
                    <div class="input-group mb-3">
                        <select class="custom-select mb-2 select-bank" name="bank_id" id="bank_id"
                            required="true">
                            <option value="" selected>Select Bank</option>
                            @foreach ($banks as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    {{ html()->label('Nomor Rekening')->class('form-control-label')->for('account_number') }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="account_number" value="">
                    </div>
                </div>

                <div class="form-group">
                    {{ html()->label('Atas Nama')->class('form-control-label')->for('name_on_account') }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name_on_account" value="">
                    </div>
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

@endpush