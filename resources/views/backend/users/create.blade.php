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
                    <i class="{{$module_icon}}"></i> {{ __('labels.backend.users.index.title') }}
                    <small class="text-muted">{{ __('labels.backend.users.create.action') }} </small>
                </h4>
                <div class="small text-muted">
                    {{ __('labels.backend.users.index.sub-title') }}
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

                {{ html()->form('POST', route('backend.users.store'))->class('form-horizontal')->open() }}
                {{ csrf_field() }}

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.first_name'))->class('col-sm-2 form-control-label')->for('first_name') }}
                    <div class="col-sm-10">
                        {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.first_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.last_name'))->class('col-sm-2 form-control-label')->for('last_name') }}
                    <div class="col-sm-10">
                        {{ html()->text('last_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.last_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.email'))->class('col-sm-2 form-control-label')->for('email') }}

                    <div class="col-sm-10">
                        {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.password'))->class('col-sm-2 form-control-label')->for('password') }}

                    <div class="col-sm-10">
                        {{ html()->password('password')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.password'))
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.password_confirmation'))->class('col-sm-2 form-control-label')->for('password_confirmation') }}

                    <div class="col-sm-10">
                        {{ html()->password('password_confirmation')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.password_confirmation'))
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.mobile'))->class('col-sm-2 form-control-label')->for('mobile') }}
                    <div class="col-sm-10">
                        {{ html()->text('mobile')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.mobile'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.gender'))->class('col-sm-2 form-control-label')->for('gender') }}
                    <div class="col-sm-10">
                        <select class="form-control" name="gender" id="gender">
                            <option value="Male">Pria</option>
                            <option value="Female">Wanita</option>
                        </select>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.date_of_birth'))->class('col-sm-2 form-control-label')->for('date_of_birth') }}
                    <div class="col-sm-10">
                        {{ html()->date('date_of_birth')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.date_of_birth'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.place_of_birth'))->class('col-sm-2 form-control-label')->for('place_of_birth') }}
                    <div class="col-sm-10">
                        {{ html()->text('place_of_birth')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.place_of_birth'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.placement'))->class('col-sm-2 form-control-label')->for('placement') }}
                    <div class="col-sm-10">
                        <select class="form-control" name="placement_id" id="placement_id">
                            @foreach($branches as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.employee_status'))->class('col-sm-2 form-control-label')->for('employee_status') }}
                    <div class="col-sm-10">
                        <select class="form-control" name="status_id" id="status_id">
                            @foreach($employee_status as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.religion'))->class('col-sm-2 form-control-label')->for('religion') }}
                    <div class="col-sm-10">
                        <select class="form-control" name="religion" id="religion">
                            @foreach($religions as $item)
                            <option value="{{ $item->value }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.position'))->class('col-sm-2 form-control-label')->for('position') }}
                    <div class="col-sm-10">
                        {{ html()->text('position')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.position'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.npwp'))->class('col-sm-2 form-control-label')->for('npwp') }}
                    <div class="col-sm-10">
                        {{ html()->text('npwp')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.npwp'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.last_education'))->class('col-sm-2 form-control-label')->for('last_education') }}
                    <div class="col-sm-10">
                        {{ html()->text('last_education')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.last_education'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.address'))->class('col-sm-2 form-control-label')->for('address') }}
                    <div class="col-sm-10">
                        {{ html()->text('address')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.address'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.id_card_number'))->class('col-sm-2 form-control-label')->for('id_card_number') }}
                    <div class="col-sm-10">
                        {{ html()->text('id_card_number')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.users.fields.id_card_number'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.status'))->class('col-6 col-sm-2 form-control-label')->for('status') }}

                    <div class="col-6 col-sm-10">
                        <div class="custom-control custom-checkbox">
                            {{ html()->checkbox('status', true,'1')->class('custom-control-input')->id('status') }}
                            {{ html()->label('status')->class('custom-control-label')->for('status') }}
                        </div>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.confirmed'))->class('col-6 col-sm-2 form-control-label')->for('confirmed') }}

                    <div class="col-6 col-sm-10">
                        <div class="custom-control custom-checkbox">
                            {{ html()->checkbox('confirmed', true,'1')->class('custom-control-input')->id('confirmed') }}
                            {{ html()->label('confirmed')->class('custom-control-label')->for('confirmed') }}
                        </div>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label('Abilities')->class('col-sm-2 form-control-label') }}

                    <div class="col">
                        <div class="row">
                            <div class="col-12 col-sm-7">
                                <div class="card bg-secondary">
                                    <div class="card-header">
                                        @lang('Roles')
                                    </div>
                                    <div class="card-body">
                                        @if ($roles->count())
                                        @foreach($roles as $role)
                                        <div class="card bg-secondary">
                                            <div class="card-header">
                                                <div class="custom-control custom-checkbox">
                                                    {{ html()->checkbox('roles[]', old('roles') && in_array($role->name, old('roles')) ? true : false, $role->name)->class('custom-control-input')->id('role-'.$role->id) }}
                                                    {{ html()->label($role->name)->class('custom-control-label')->for('role-'.$role->id) }}
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if ($role->id != 1)
                                                @if ($role->permissions->count())
                                                @foreach ($role->permissions as $permission)
                                                <i class="far fa-check-circle mr-1"></i>{{ $permission->name }}&nbsp;
                                                @endforeach
                                                @else
                                                None
                                                @endif
                                                @else
                                                @lang('All Permissions')
                                                @endif
                                            </div>
                                        </div>
                                        <!--card-->
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5">
                                <div class="card bg-secondary">
                                    <div class="card-header">
                                        @lang('Permissions')
                                    </div>
                                    <div class="card-body">
                                        @if ($permissions->count())
                                        @foreach($permissions as $permission)
                                        <div class="custom-control custom-checkbox">
                                            {{ html()->checkbox('permissions[]', old('permissions') && in_array($permission->name, old('permissions')) ? true : false, $permission->name)->class('custom-control-input')->id('permission-'.$permission->id) }}
                                            {{ html()->label($permission->name)->class('custom-control-label')->for('permission-'.$permission->id) }}
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--form-group-->

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <x-buttons.create title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}">
                                {{__('Create')}}
                            </x-buttons.create>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <div class="form-group">
                                <x-buttons.cancel />
                            </div>
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