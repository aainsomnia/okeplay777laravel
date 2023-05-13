@extends('admin.layout.app')

@section('title') Login @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admin/css/bootstrap-social.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="{{ asset('web/images/okeplaylogo7777.gif')}}" alt="logo" width="190" class="">
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation form" novalidate="">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="user_email" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>
                            <div class="alert alert-danger error-message" role="alert" style="display: none;"></div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block logins" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="simple-footer">
                    Copyright &copy; Okeadmin 2022
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.logins', function(e){
            e.preventDefault();
            var form = $('.form').serializeArray();
            var elem_button = $(this).html();
            $.ajax({
                url: "{{ route('login_process') }}",
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                },
                data: form,
                beforeSend:function(){
                    $('.error-message').fadeOut(100);
                    button_loading('.logins','',true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.success == 1) {
                        window.location.href = "{{ route('category.view') }}";
                        location.reload();
                    } else {
                        button_loading('.logins',elem_button,false);
                        $('.error-message').html(data.responseJSON.message);
                        $('.error-message').fadeIn(500);
                    }
                },
                error:function(data){
                    console.log(data);
                    button_loading('.logins',elem_button,false);
                    $('.error-message').html(data.responseJSON.message);
                    $('.error-message').fadeIn(500);
                }
            });
        });
    });
</script>
@endsection
