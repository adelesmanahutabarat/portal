@extends('backend.layouts.app')

@section('title') {{ $module_action }} {{ $module_title }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs route='label.dashboard'>
    <x-backend-breadcrumb-item route='{{route("label.$module_name.index")}}' icon='{{ $module_icon }}' >
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
                    <i class="{{ $module_icon }}"></i>  {{ $module_title }} <small class="text-muted">{{ $module_action }}</small>
                </h4>
                <div class="small text-muted">
                    {{ ucwords($module_name) }} Management Dashboard
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route("label.$module_name.index") }}" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" title="{{ $module_title }} List"><i class="fas fa-list-ul"></i> List</a>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">
                
                {{ html()->modelForm($$module_name_singular, 'PATCH', route("label.$module_name.update", $$module_name_singular))->class('form')->open() }}
                <div class="row mb-2">
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            
                            <?php
                                $avatar = $$module_name_singular->artwork_url ? Storage::disk('s3')->url($$module_name_singular->artwork_url):asset('img/default-avatar.jpg');
                            ?>
                            <img src="{{ $avatar }}" class="user-profile-image img-fluid img-thumbnail" style="max-height:100%; max-width:100%;" />
                         
                        </div>
                
                    </div>
                    <div class="col-12 col-md-5">
                        
                        <div class="form-group">
                            <?php
                            $field_name = 'title';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                        <div class="form-group">
                            <?php
                            $field_name = 'artis_name';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                        <div class="form-group">
                            <?php
                            $field_name = 'composer';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                        <div class="form-group">
                            <?php
                            $field_name = 'genre';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required",'list'=>'genres']) }}
                            <datalist id="genres">
                                <option value='African'>African</option>
                                <option value='Alternative'>Alternative</option>
                                <option value='Arabic'>Arabic</option>
                                <option value='Asian'>Asian</option>
                                <option value='Blues'>Blues</option>
                                <option value='Brazilian'>Brazilian</option>
                                <option value='Children Music'>Children Music</option>
                                <option value='Christian & Gospel'>Christian & Gospel</option>
                                <option value='Classical'>Classical</option>
                                <option value='Country'>Country</option>
                                <option value='Dance'>Dance</option>
                                <option value='Easy Listening'>Easy Listening</option>
                                <option value='Electronic'>Electronic</option>
                                <option value='Folk'>Folk</option>
                                <option value='Hip Hop/Rap'>Hip Hop/Rap</option>
                                <option value='Indian'>Indian</option>
                                <option value='Jazz'>Jazz</option>
                                <option value='Latin'>Latin</option>
                                <option value='Metal'>Metal</option>
                                <option value='Pop'>Pop</option>
                                <option value='R&B/Soul'>R&B/Soul</option>
                                <option value='Reggae'>Reggae</option>
                                <option value='Relaxation'>Relaxation</option>
                                <option value='Rock'>Rock</option>
                                <option value='Various'>Various</option>
                                <option value='World Music / Regional Folklore'>World Music / Regional Folklore</option>
                            </datalist>
                              
                        </div>
                        <div class="form-group">
                            <?php
                            $field_name = 'sub_genre';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                       
                        <div class="form-group">
                            <?php
                            $field_name = 'record_label';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required",'list'=>'records']) }}
                            <datalist id="records">
                                <option value='Premier Pro'>Premier Pro</option>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <?php
                            $field_name = 'produced_by';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                        
                    </div>
                    <div class="col-12 col-md-5">
                        
                        <div class="form-group">
                            <?php
                            $field_name = 'production_year';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                        <div class="form-group">
                            <?php
                            $field_name = 'first_release_date';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                        <div class="form-group">
                            <?php
                            $field_name = 'release_date';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                        <div class="form-group">
                            <?php
                            $field_name = 'lyric_language';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "readonly";
                
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required",'list'=>'language']) }}
                            <datalist id="language">
                                <option value='None/ Instrumental'>None/ Instrumental</option>
                                <option value="Arabic">Arabic</option>
                                <option value="English">English</option>
                                <option value="Indonesian">Indonesian</option>
                                <option value="Javanese">Javanese</option>
                                <option value="Sundanese">Sundanese</option>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <?php
                            $field_name = 'lyric_url';
                            $field_label = label_case($field_name);
                            $field_placeholder = $field_label;
                            $required = "";
                            ?>
                            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                            <p>
                            @if($$module_name_singular->lyric_url)
                                <a href="{{ $$module_name_singular->download_url }}" class="btn btn-primary btn-sm mt-2" data-toggle="tooltip" title="Download Lyric "><i class="fas fa-download"></i> Download Lyric</a>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
                <div class="row">
                    <div class="col-md-12">
                        
                        <h3>Track File</h3>
                        <div class="table-responsive my-2">
                            <table  class="table table-bordered table-hover" id="table-upload">
                                <thead>
                                    <tr >
                                        <th>
                                            Title
                                        </th>
                                        <th class="text-right" width="25%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($files)==0)
                                    <tr class="temp-upload">
                                        <td colspan="2">Belum Ada Data</td> 
                                    </tr>
                                @endif
                                @foreach($files as $file)
                                    <tr>
                                        <td>
                                            {{$file->file_name}}
                                        </td>
                                        <td>
                                            @include ("catalog::includes.files_action_column",[$module_name,'data'=>$file,'is_show'=>false])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                </div>
                 

                

            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    Updated: {{$$module_name_singular->updated_at->diffForHumans()}},
                    Created at: {{$$module_name_singular->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>

@stop