<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta description="OKEPLAY777 Situs Judi Slot Online Dengan RTP Tertinggi Terlengkap Dan Terpercaya Di Indonesia Infini88 Memberikan Rekomendasi Slot Gacor Hari Ini 2023">
    <title>OKEPLAY777 | SITUS JUDI SLOT ONLINE DENGAN RTP TERTINGGI</title>
    <link rel="shortcut icon" href="{{ asset('web/images/okeplaylogo7777.gif')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('web/css/app.css')}}">
</head>
<body>
    <main class="py-[50px]">
        <div class="container">
            <img src="{{ asset('web/images/okeplaylogo7777.gif')}}" alt="" class="block mx-auto mb-5">
            <div class="banners">

            </div>
            <div class="flex flex-row max-w-[356px] mx-auto lg:max-w-none justify-center mb-5 gap-0 md:gap-2" id="links_btn">
                {{-- <a href="https://143.198.211.108" class="btn btn-warning btn-gold flex-initial btn-block text-[22px] font-bold">Daftar</a>
                <a href="https://143.198.211.108" class="btn btn-warning btn-silver flex-initial btn-block text-[22px] font-bold">Login</a> --}}
            </div>
            @yield('content')
        </div>
        <footer>
            <div class="container">
                <div class="text-center text-white p-5 text-[12px]">
                    ©Copyright 2022 Okeplay777. All Rights Reserved | 18+
                </div>
            </div>
        </footer>
    </main>
</body>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="{{ asset('web/js/app.js')}}"></script>
    <script src="{{ asset('web/js/jquery.js')}}"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
            });

             $.ajax({
                url: "{{route('get_banner')}}",
                type: "POST",
                success: function(data) {
                    // console.log(data);
                    var html = '';
                    $.each(data, function(key, value) {
                        var src_result = `{{ URL::to('storage/images/banner/') }}`+'/'+value.banner_img;
                        html += `<img src="${src_result}" alt="" class="w-11/12 md:w-8/12 mx-auto mb-10">`;
                    });
                    $('.banners').html(html);
                },
                error: function(xhr, status){
                    // console.log(xhr);
                }
            });

            $.ajax({
                url: "{{route('get_link_btn')}}",
                type: "POST",
                success: function(data) {
                    // console.log(data);
                    var link_logins = "https://143.198.211.108";
                    var link_registers = "https://143.198.211.108";

                    if (data.link_btn_register != null) {
                        link_registers = data.link_btn_register;
                    }

                    if (data.link_btn_login != null) {
                        link_logins = data.link_btn_login;
                    }

                    $('#links_btn').html(`
                        <a href="${link_registers}" class="btn btn-warning btn-gold flex-initial btn-block text-[22px] font-bold">Daftar</a>
                        <a href="${link_logins}" class="btn btn-warning btn-silver flex-initial btn-block text-[22px] font-bold">Login</a>
                    `);
                },
                error: function(xhr, status){
                    // console.log(xhr);
                }
            });
        });
    </script>
</html>
