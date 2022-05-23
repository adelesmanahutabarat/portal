<div class="row">
    <div class="col-12 col-md-12">
        <div class="form-group">
            <?php
            $field_name = 'title';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
            <small>Ini adalah Judul Lagu/ Musik atau Judul Album. Mohon diperhatikan ejaan penulisan serta penggunaan huruf besar dan huruf kecil pada bagian Judul.</small>
        </div>
    </div>
</div>
