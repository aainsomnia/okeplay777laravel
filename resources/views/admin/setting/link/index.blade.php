@extends('admin.layout.app')

@section('title') Settings @endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Settings Link</h1>
        <div class="ml-auto">
            <button class="btn btn-primary btn-lg btn-save" id="btn_save">
                <i class="fas fa-save"></i>&nbsp; Save
            </button>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
                            <strong>Failed to save link, please check again the required fields !</strong><br> 
                            <p class="error-message"></p>
                        </div>
                        <form class="form" id="form">
                            <div class="row">
                                <input type="text" name="id" id="id" @if($data != null) value="{{ $data->id }}" @else value="" @endif hidden>
                                <div class="col-6">
                                    <label for="link_btn_login" class="col-form-label">Link Login <b class="text-danger">*</b></label>
                                    <input type="text" class="form-control mb-2" name="link_btn_login" id="link_btn_login" placeholder="ex : https://example-login.com" @if($data != null) value="{{ $data->link_btn_login }}" @else value="" @endif>
                                </div>
                                <div class="col-6">
                                    <label for="link_btn_register" class="col-form-label">Link Register <b class="text-danger">*</b></label>
                                    <input type="text" class="form-control mb-2" name="link_btn_register" id="link_btn_register" placeholder="ex : https://example-register.com" @if($data != null) value="{{ $data->link_btn_register }}" @else value="" @endif>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });

        $('#btn_save').click(function(){
            var form = new FormData();
            var elem_button = $(this).html();

            var id = $('#id').val();
            var link_btn_login = $('#link_btn_login').val();
            var link_btn_register = $('#link_btn_register').val();

            form.append('id', id);
            form.append('link_btn_login', link_btn_login);
            form.append('link_btn_register', link_btn_register);

            $.ajax({
                url: "{{ route('setting.update') }}",
                method: "POST",
                data: form,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    button_loading("#btn_save",'',true);
                },
                success: function(data){
                    console.log(data);
                    button_loading("#btn_save",elem_button,false);
                    Swal.fire('Information', 'Link Successfully saved.', 'success');
                },
                error:function(data){
                    console.log(data);
                    button_loading("#btn_save", elem_button, false);
                    $('.alert').show();
                    if (data.status == 500) {
                        var pesan = $.parseJSON(data.responseText);
                        var isi = [];
                        $.each(pesan, function(key, value) {
                            var result = `<li>${value}</li>`;
                            isi.push(result);
                        });
                        $('.error-message').html(isi);
                        $('.error-message').fadeIn(500);
                    }
                }
            });
        });
    });
</script>
@endsection
