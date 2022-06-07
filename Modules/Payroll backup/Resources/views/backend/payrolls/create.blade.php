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
                {{ html()->form('POST', route('backend.payrolls.store'))->class('form-horizontal')->open() }}
                {{ csrf_field() }}

                <div class="form-group">
                    {{ html()->label('Cabang')->class('form-control-label')->for('branch_id') }}
                    <div class="input-group mb-3">
                        <!-- <select class="custom-select mb-2 select2-disabled select-branch select-2" name="branch_id" id="branch_id" required="true" disabled="">
                            <option value="" selected>Select Cabang</option>
                            @foreach ($branches as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $branch->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select> -->
                        <input type="text" class="form-control" value="{{ $branch->name }}" readonly>
                        <input type="hidden" class="form-control" name="branch_id" value="{{ $branch->id }}">
                    </div>
                </div>

                <div class="form-group">
                    {{ html()->label('Periode')->class('form-control-label')->for('date_period') }}
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="date_period" value="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12">
                        @if ($errors->has('estimated_price'))
                        <span class="text-danger">{{ $errors->first('estimated_price') }}</span>
                        @endif
                        <div>
                            <div class="well clearfix">
                                <a href="#" class="btn btn-primary pull-right add-record float-right" data-added="0"><i
                                        class='uil uil-plus'></i> Add Detail</a>
                            </div>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_posts">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Karyawan</th>
                                            <th>Nominal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_posts_body">
                                        <tr id="rec-1">
                                            <td><span class="sn">1</span>.</td>
                                            <td>
                                                <select class="custom-select mb-2 select-user select-2"
                                                    name="user_id[]" id="user_id" required="true">
                                                    <option value="" selected>Select Karyawan</option>
                                                    @foreach ($users as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" required="true"
                                                    class="form-control input-element nominal-detail"
                                                    onkeyup="myfunction()" name="nominal[]" placeholder="6.000.000">
                                            </td>
                                            <td><a class="btn btn-xs delete-record" data-id="1"><i
                                                        class="glyphicon glyphicon-trash"></i></a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr id="rec-1">
                                            <td></td>
                                            <td class="font-weight-bold">Total</td>
                                            <td> <input type="text" class="form-control input-element input-total"
                                                    id="total" name="total" placeholder="" readonly></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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

    <table id="sample_table" style="display:none;">
        <tr id="">
            <td><span class="sn"></span>.</td>
            <td>
                <select class="custom-select mb-2 select-user select-2" name="user_id[]" id="user_id"
                    required="true">
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