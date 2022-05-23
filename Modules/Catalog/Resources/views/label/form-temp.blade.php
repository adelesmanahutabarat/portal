<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <?php
            $field_name = 'file_url';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name.'[]')->placeholder($field_placeholder)->class('form-control')->attributes(["$required",'type'=>'file','multiple']) }}
        </div>
    </div>
</div>
@push ('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
    $('form').ajaxForm({
        beforeSend:function(){
            $('#status').empty();
            $('.progress-bar').text('0%');
            $('.progress-bar').css('width', '0%');
        },
        uploadProgress:function(event, position, total, percentComplete){
            $('.progress-bar').text(percentComplete + '0%');
            $('.progress-bar').css('width', percentComplete + '0%');
        },
        success:function(data)
        {
            if(data.status)
            {
                $('#status').html('<div class="text-success text-center"><b>'+data.message+'</b></div><br /><br />');
                $('#status').append(data.image);
                $('.progress-bar').text('Uploaded');
                $('.progress-bar').css('width', '100%');
            }
        }
    });
});
</script>
@endpush
