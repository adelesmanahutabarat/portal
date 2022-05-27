@extends('layouts.vertical')

@section('title') {{ $module_action }} {{ $module_title }} @endsection

@section('breadcrumb')
@role('super admin')
<x-backend-breadcrumbs title="{{ $module_name }}">
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}' >
        {{ $module_title }}
    </x-backend-breadcrumb-item>

    <x-backend-breadcrumb-item type="active">Profile</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endrole
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i> Profile
                    <small class="text-muted">{{ __('labels.backend.users.show.action') }} </small>
                </h4>
                <div class="small text-muted">
                    {{ __('labels.backend.users.index.sub-title') }}
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="float-right">
                    <a href="{{ route("$link.users.profileEdit", $user->id) }}" class="btn btn-primary mt-1 btn-sm" data-toggle="tooltip" title="Edit {{ Str::singular($module_name) }} Profile"><i class="fas fa-wrench"></i> Edit</a>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>{{ __('labels.backend.users.fields.avatar') }}</th>
                            <td><img src="{{asset($user->avatar)}}" class="user-profile-image img-fluid img-thumbnail" style="max-height:200px; max-width:200px;" /></td>
                        </tr>

                        <?php $fields_array = [
                            [ 'name' => 'name' ],
                            [ 'name' => 'email' ],
                            [ 'name' => 'mobile' ],
                            [ 'name' => 'gender' ],
                            [ 'name' => 'date_of_birth', 'type' => 'date'],
                            [ 'name' => 'url_website', 'type' => 'url' ],
                            [ 'name' => 'url_facebook', 'type' => 'url' ],
                            [ 'name' => 'url_twitter', 'type' => 'url' ],
                            [ 'name' => 'url_linkedin', 'type' => 'url' ],
                            [ 'name' => 'profile_privecy' ],
                            [ 'name' => 'address' ],
                            [ 'name' => 'bio' ],
                            [ 'name' => 'last_login', 'type' => 'datetime' ],
                            [ 'name' => 'last_ip' ],
                        ]; ?>

                            <tr>
                                <td>
                                    <strong>
                                        Gender
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->gender }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Date of Birth
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->date_of_birth }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Place of Birth
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->place_of_birth }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Placement
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->placement }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Status Employee
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->employee_status }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Religion
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->religion }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Position
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->position }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        NPWP
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->npwp }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Last Education
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->last_education }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Address
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->address }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        ID Card
                                    </strong>
                                </td>
                                <td>
                                    {{ $user->id_card_number }}
                                </td>
                            </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.password') }}</th>
                            <td>
                                <a href="{{ route("$link.users.changeProfilePassword", $user->id) }}" class="btn btn-outline-primary btn-sm">Change password</a>
                            </td>
                        </tr>
                        @role('super admin')
                        <tr>
                            <th>{{ __('labels.backend.users.fields.status') }}</th>
                            <td>{!! $user->status_label !!}</td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.confirmed') }}</th>
                            <td>{!! $user->confirmed_label !!}</td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.created_at') }}</th>
                            <td>{{ $user->created_at->isoFormat('llll') }}<br><small>({{ $user->created_at->diffForHumans() }})</small></td>
                        </tr>

                        <tr>
                            <th>{{ __('labels.backend.users.fields.updated_at') }}</th>
                            <td>{{ $user->updated_at->isoFormat('llll') }}<br/><small>({{ $user->updated_at->diffForHumans() }})</small></td>
                        </tr>
                        @endrole
                    </table>
                </div><!--table-responsive-->
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
