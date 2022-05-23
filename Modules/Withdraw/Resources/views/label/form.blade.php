<div class="row">
    <div class="col-12 col-md-12">
        <div class="form-group">
            <?php
            $field_name = 'amount';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label("Jumlah") }} {!! fielf_required($required) !!}
            {{ html()->number($field_name)->placeholder("Jumlah")->class('form-control')->attributes(["$required",'min'=>'1000']) }}
        </div>
        <div class="form-group">
            <?php
            $field_name = 'account_number';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label("No Rekening") }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder("No Rekening")->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>
