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
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i> {{ __('labels.backend.users.edit.title') }}
                    <small class="text-muted">{{ __('labels.backend.users.edit.action') }} </small>
                </h4>
                <div class="small text-muted">
                    {{ __('labels.backend.users.edit.sub-title') }}
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <x-buttons.return-back />
                </div>
            </div>
        </div>
        <hr>

        <div class="row mt-4">
            <div class="col">
                {{ html()->modelForm($user, 'PATCH', route('backend.users.update', $user->id))->class('form-horizontal')->open() }}

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
                    {{ html()->label(__('labels.backend.users.fields.password'))->class('col-5 col-sm-2 form-control-label')->for('password') }}

                    <div class="col-7 col-sm-10">
                        <a href="{{ route('backend.users.changePassword', $user->id) }}"
                            class="btn btn-outline-primary btn-sm"><i class="fas fa-key"></i> Change password</a>
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label('Profile')->class('col-5 col-sm-2 form-control-label')->for('profile') }}

                    <div class="col-7 col-sm-10">
                        <a href="{{ route("backend.users.profileEdit", $user->id) }}"
                            class="btn btn-outline-primary btn-sm"><i class="fas fa-user"></i> Update Profile</a>
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
                    {{ html()->label(__('labels.backend.users.fields.confirmed'))->class('col-5 col-sm-2 form-control-label')->for('confirmed') }}

                    <div class="col-7 col-sm-10">
                        @if ($user->email_verified_at == null)
                        <a href="{{route('backend.users.emailConfirmationResend', $user->id)}}"
                            class="btn btn-outline-primary btn-sm " data-toggle="tooltip"
                            title="Send Confirmation Email"><i class="fas fa-envelope"></i> Send Confirmation Email</a>
                        @else
                        {!! $user->confirmed_label !!}
                        @endif
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label('Abilities')->class('col-sm-2 form-control-label') }}
                    <div class="col">
                        <div class="row">
                            <div class="col-sm-6">
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
                                                    {{ html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)->class('custom-control-input')->id('role-'.$role->id) }}
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
                                                All Permissions
                                                @endif
                                            </div>
                                        </div>
                                        <!--card-->
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card bg-secondary">
                                    <div class="card-header">
                                        @lang('Permissions')
                                    </div>
                                    <div class="card-body">
                                        @if ($permissions->count())
                                        @foreach($permissions as $permission)
                                        <div class="custom-control custom-checkbox">
                                            {{ html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)->class('custom-control-input')->id('permission-'.$permission->id) }}
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

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ html()->submit($text = icon('fas fa-save')." Save")->class('btn btn-primary') }}
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="float-right">
                            @if ($$module_name_singular->status != 2 && $$module_name_singular->id != 1)
                            <a href="{{route('backend.users.block', $$module_name_singular)}}" class="btn btn-danger"
                                data-method="PATCH" data-token="{{csrf_token()}}" data-toggle="tooltip"
                                title="{{__('labels.backend.block')}}" data-confirm="Are you sure?"><i
                                    class="fas fa-ban"></i></a>
                            @endif
                            @if ($$module_name_singular->status == 2)
                            <a href="{{route('backend.users.unblock', $$module_name_singular)}}" class="btn btn-info"
                                data-method="PATCH" data-token="{{csrf_token()}}" data-toggle="tooltip"
                                title="{{__('labels.backend.unblock')}}" data-confirm="Are you sure?"><i
                                    class="fas fa-check"></i> Unblock</a>
                            @endif
                            @if ($$module_name_singular->email_verified_at == null)
                            <a href="{{route('backend.users.emailConfirmationResend', $$module_name_singular->id)}}"
                                class="btn btn-primary" data-toggle="tooltip" title="Send Confirmation Email"><i
                                    class="fas fa-envelope"></i></a>
                            @endif
                            @if($$module_name_singular->id != 1)
                            <a href="{{route("backend.$module_name.destroy", $$module_name_singular)}}"
                                class="btn btn-danger" data-method="DELETE" data-token="{{csrf_token()}}"
                                data-toggle="tooltip" title="{{__('labels.backend.delete')}}"><i
                                    class="fas fa-trash-alt"></i> Delete</a>
                            @endif
                            <a href="{{ route("backend.$module_name.index") }}" class="btn btn-warning"
                                data-toggle="tooltip" title="{{__('labels.backend.cancel')}}"><i
                                    class="fas fa-reply"></i> Cancel</a>
                        </div>
                    </div>
                </div>
                {{ html()->closeModelForm() }}
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    Updated: {{$user->updated_at->diffForHumans()}},
                    Created at: {{$user->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>

@endsection