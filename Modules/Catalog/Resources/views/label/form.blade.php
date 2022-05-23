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
            $required=$$module_name_singular->artwork_url?"":"required";
            $field_name="Cover Artwork";
            ?>
            {{ html()->label($field_name) }} {!! fielf_required($required) !!}
            <div class="input-group mb-3">
                <div class="custom-file">
                    {{ html()->text("artwork_url")->placeholder("")->class('custom-file-input')->attributes(["$required","id"=>'file','type'=>'file','accept'=>"image/*"]) }}
                    <label class="custom-file-label" for="file" aria-describedby="Cover">Pilih Foto</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php
            $field_name = 'title';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "required";

            ?>
            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
        <div class="form-group">
            <?php
            $field_name = 'artis_name';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";

            ?>
            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
        <div class="form-group">
            <?php
            $field_name = 'composer';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";

            ?>
            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
        <div class="form-group">
            <?php
            $field_name = 'genre';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "required";

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
            $required = "";

            ?>
            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
       
        <div class="form-group">
            <?php
            $field_name = 'record_label';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "required";

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
            $required = "required";

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
            $required = "required";

            ?>
            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
        <div class="form-group">
            <?php
            $field_name = 'first_release_date';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "required";

            ?>
            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
        <div class="form-group">
            <?php
            $field_name = 'release_date';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "required";

            ?>
            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
        <div class="form-group">
            <?php
            $field_name = 'lyric_language';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "required";

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
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(['type'=>'file','accept'=>'.doc,.docx,.txt,.pdf']) }}
            @if($$module_name_singular->lyric_url)
                <a href="{{ $$module_name_singular->download_url }}" class="btn btn-primary btn-sm mt-2" data-toggle="tooltip" title="Download Lyric "><i class="fas fa-download"></i> Download Lyric</a>
            @endif
        </div>
        <div class="form-group">
            <?php
            $field_name = 'description';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";

            ?>
            {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->textarea($field_name)->placeholder("Catatan tambahan untuk aggregator")->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button id="btn-mp3" class="btn  btn-primary  mt-2" type="button"><i class="fas fa-upload"></i> Upload Audio</button>
        {{ html()->text("file_url[]")->placeholder("")->class('invisible')->attributes(["$required","id"=>'mp3','type'=>'file','accept'=>".mp3,.wav",'multiple']) }}
              
        <div class="table-responsive my-2">
            <span class="float-left">Max 10 Files <span class="text-danger">*</span></span>  
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
                            @include ("catalog::includes.files_action_column",[$module_name,'data'=>$file,'is_show'=>true])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
 