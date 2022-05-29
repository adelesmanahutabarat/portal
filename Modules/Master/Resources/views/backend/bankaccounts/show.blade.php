@extends('layouts.vertical')

@section('title') {{ __($module_action) }} {{ $module_title }} @endsection

@section('breadcrumb')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index", $$module_name_singular->id)}}'
        icon='{{ $module_icon }}'>
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
                    <i class="{{$module_icon}}"></i> Bank Account
                    <small class="text-muted">{{ __('labels.backend.users.show.action') }} </small>
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
                <div class="form-group">

                    <table>
                        <tr>
                            <td>Nama Karyawan</td>
                            <td>:</td>
                            <td><b>{{$bankaccount->employee_name}}</b></td>
                        </tr>
                        <tr>
                            <td>Bank</td>
                            <td>:</td>
                            <td><b>{{$bankaccount->bank_name}}</b></td>
                        </tr>
                        <tr>
                            <td>Atas Nama</td>
                            <td>:</td>
                            <td><b>{{$bankaccount->name_on_account}}</b></td>
                        </tr>
                        <tr>
                            <td>Nomor Rekening</td>
                            <td>:</td>
                            <td><b>{{$bankaccount->account_number}}</b></td>
                        </tr>
                    </table>

                    <!-- <div class="form-group">
                        {{ html()->label('Nama Karyawan')->class('form-control-label')->for('user_id') }} :
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="employee_name"
                                value="{{$bankaccount->employee_name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        {{ html()->label('Bank')->class('form-control-label')->for('bank_name') }}
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="bank_name"
                                value="{{$bankaccount->bank_name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        {{ html()->label('Atas Nama')->class('form-control-label')->for('name_on_account') }}
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="name_on_account"
                                value="{{$bankaccount->name_on_account}}">
                        </div>
                    </div>

                    <div class="form-group">
                        {{ html()->label('Nomor Rekening')->class('form-control-label')->for('account_number') }}
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="account_number"
                                value="{{$bankaccount->account_number}}">
                        </div>
                    </div> -->
                </div>
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