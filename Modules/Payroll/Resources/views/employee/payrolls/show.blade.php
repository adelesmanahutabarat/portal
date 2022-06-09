@extends ('layouts.vertical')

@section('title') {{ $module_action }} {{ $module_title }} @endsection

@section('breadcrumb')
<x-backend-breadcrumbs route='label.dashboard'>
    <x-backend-breadcrumb-item route='{{route("employee.$module_name.index")}}' icon='{{ $module_icon }}' >
        {{ $module_title }}
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item type="active">{{ $module_action }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{ $module_icon }}"></i> {{ $module_title }} <small class="text-muted">{{ $module_action }}</small>
                </h4>
                <div class="small text-muted">
                    {{ ucwords($module_name) }} Management Dashboard
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route("employee.$module_name.index") }}" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" title="{{ $module_title }} List"><i class="fas fa-list-ul"></i> List</a>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">
                <div class="row">
                    <div class="col-12 col-md-12">
                        {{ html()->modelForm($data) }}
                        <div class="form-group">
                            <?php
                            $field_name = 'amount';
                            $field_lable = label_case($field_name);
                            $field_placeholder = $field_lable;
                            $required = "readonly";
                            ?>
                            {{ html()->label("Jumlah") }} 
                            {{ html()->number($field_name)->placeholder("Jumlah")->class('form-control')->attributes(["$required",'min'=>'1000']) }}
                        </div>
                        <!-- <div class="form-group">
                            <?php
                            $field_name = 'description';
                            $field_lable = label_case($field_name);
                            $field_placeholder = $field_lable;
                            $required = "readonly";
                            ?>
                            {{ html()->label("Keterangan") }}
                            {{ html()->textarea($field_name)->placeholder("")->class('form-control')->attributes(["$required"]) }}
                        </div> -->
                        <div class="form-group">
                            {{ html()->label("Status")}}
                            <p>
                                {!! $data->status_formatted !!}
                            </p>
                        </div>
                        @if($data->status!=0 && $data->approved_description!='')
                            <div class="form-group">
                                <?php
                                $field_name = 'approved_description';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = "readonly";
                                ?>
                                {{ html()->label("Catatan untuk user"),$field_lable }} 
                                {{ html()->textarea($field_name)->placeholder("")->class('form-control')->attributes(["$required"]) }}
                            </div>
                        @endif
                        <div class="form-group">
                            {{ html()->label("Bukti Transfer")}}
                            <p>
                            @if($data->proof_of_payment)
                                <img src="{{ asset('storage/bukti/'.$data->proof_of_payment) }}" class="user-profile-image img-fluid img-thumbnail" style="max-height:200px; max-width:200px;">
                            @else
                                <span class="badge badge-info">Belum ada Bukti</span>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
                
             

            </div>
        </div>
    </div>

    
</div>

@stop
