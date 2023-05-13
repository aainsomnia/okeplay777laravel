@extends('web.layout.app')
@section('title') Okeplay777 @endsection
@section('content')

    <!-- Slider main container -->
    <div class="grid grid-cols-12 gap-2 w-full bg-gray-800 p-2 slider-container">
        <div>
            <button class="btn p-0 flex items-center justify-center text-2xl !bg-transparent border-0 rounded-none w-full h-[100px] btn-prev"><span class="iconify-inline" data-icon="fa-solid:chevron-left"></span></button>
        </div>

        <div class="col-span-10">
            <div class="swiper slides">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                <!-- Slides -->

                @foreach ($categorys as $ctg)
                    <div class="swiper-slide">
                        <a href="{{ route('byId', ['name'=>Str::slug($ctg->category_name, '-'),'id'=>$ctg->category_id]) }}" class="bg-black hover:bg-yellow-800 h-[100px] flex flex-col items-center gap-1 w-full p-2">
                            <img src="{{ url('storage/images/category/'.$ctg->category_img) }}" alt="" class="h-[40px]">
                            <div>{{ $ctg->category_name }}</div>
                        </a>
                    </div>
                @endforeach

                </div>
                <!-- If we need pagination -->


                <!-- If we need navigation buttons -->

                <!-- If we need scrollbar -->

            </div>
        </div>

        <div>
            <button class="btn p-0 flex items-center justify-center text-2xl !bg-transparent border-0 rounded-none w-full h-[100px] btn-next"><span class="iconify-inline" data-icon="fa-solid:chevron-right"></span></button>
        </div>
    </div>

    <div class="bg-black p-5 lg:p-10">
        <h1 class="text-center text-2xl text-white font-bold mb-5">{{ $title_category->category_name }}</h1>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-10">
            @foreach ($contents as $ct)
                <div class="card group rounded-2xl bg-white text-black relative">

                    <div class="relative">
                        <img src="{{ url('storage/images/content/'.$ct->content_img) }}" alt="" class="w-full h-[150px] object-cover rounded-t-xl">
                    </div>
                    <div class="card-title py-5 px-2 text-center w-full block">
                        {{ $ct->content_name }}
                    </div>
                    <div class="relative">
                        @php
                            // Note
                            // warna persen :
                            //     ≤ 20% : merah
                            //     ≥ 21% & ≤ 60% : kuning
                            //     ≥ 61% : hijau

                            $bar_colour = 'danger';
                            if ($ct->content_persen > 61) {
                                $bar_colour = 'success';
                            } else if ($ct->content_persen > 21) {
                                $bar_colour = 'warning';
                            }

                        @endphp
                        <div class="progress progress-striped active progress-lg">
                            <div role="progressbar " style="width: {{ $ct->content_persen }}%;" class="progress-bar progress-bar-{{ $bar_colour }}"><span>&nbsp;</span></div>
                        </div>
                        @php
                            if($ct->content_persen > 50) {
                                $color = "text-white";
                            } else {
                                $color = "text-black";
                            }
                        @endphp

                        <div class="absolute left-0 top-0 right-0 h-full py-1 text-center font-bold {{$color}}">
                            {{ $ct->content_persen }}%
                        </div>
                    </div>
                    <div class="absolute left-0 top-0 right-0 w-full h-full flex invisible opacity-0 transition-all bg-black bg-opacity-70 group-hover:visible group-hover:opacity-100">
                        <a href="{{ $ct->category->game_url }}" class="btn btn-warning btn-sm bg-gradient-to-b from-yellow-100 via-yellow-300 to-yellow-600 hover:bg-gradient-to-t hover:from-yellow-100 hover:via-yellow-300 hover:to-yellow-600 rounded-xl w-10/12 m-auto">Main</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-black p-5 lg:p-10 rounded-b-lg">
        <article class="word p-5 lg:p-10 border-2 border-yellow-300 border-dashed rounded-lg">
            <div class="site-description prose-base max-w-none text-white">
                <h1 class="text-white">Seputar informasi RTP Daftar Slot Gacor Tertinggi</h1>
                <p style="text-align:justify">Beberapa informasi seputar dalam permainan slot gacor hari ini
                    bisa anda ketahui beberapa keuntungan dan beberapa nilai RTP dalam mesin slot online
                    pragmatic, habanero, spade gaming, dan pg soft. Seperti ini lah permainan slot online yang
                    mempunyai RTP sehingga semua permainan slot gacor hari ini menjadi lebih mudah untuk meriah
                    kemenangan. Permainan slot gacor akhirnya menggeser sejumlah permainan judi online karena
                    situs judi slot online menyajikan pelayanan yang sangat bagus dan bisa di andalkan.</p>
                <p style="text-align:justify">Sebagian orang tentunya tidak mengetahui slot gacor hari ini mana
                    yang bisa di andalakan dan mana yang tidak bisa di andalakn. Nanti kami akan membahas
                    persoalan ini di bawah sini. Jadi untuk kalian jangan pernah takut untuk melakukan permainan
                    slot online gacor hari ini. Karena kami selalu memberikan yang terbaik informasi paling
                    paten ini.</p>
                <p style="text-align:justify">Kami merupakan dari agen judi slot online resmi di indonesia.
                    Selalu memberikan bocoran RTP tertinggi setiap permainan slot online gacor yang tersedia.
                </p>
                <h2 class="text-white">Menghitung Volum Permainan RTP Slot Gacor Hari Ini</h2>
                <p style="text-align:justify">Menghitung dalam volum permainan slot online rtp tertinggi bisa
                    anda kunjungi situs slot gacor game paling populer dan paling gacor di dunia google. Nah
                    buat kalian yang belum tahu menghitung ukuran volum dalam rtp mesin slot gacor hari ini bisa
                    anda dapatkan dari informasi kami.</p>
                <p style="text-align:justify">RTP mesin slot gacor ini bisa anda ukur dari pemutaran beberapa
                    kali yang biasa nya di gunakan untuk taruhan dari terkecil sampai terbesar. Dengan ada nya
                    menghitung volum ini anda tidak mudah meraih kekalahan. Jadi setiap mesin slot gacor ini
                    mempunyai volum rtp yang berbeda beda.</p>
                <p style="text-align:justify">Jadi sebelum kalian mengikuti permainan taruhan asli di mesin slot
                    gacor hari ini. Anda sebaiknya mencoba di permainan demo slot dulu. Baru menginjak taruhan
                    sesungguh nya. Biar kalian tahu step step dalam pemutaran volum di mesin slot gacor ini.</p>
                <p style="text-align:justify">Tetapi tenang saja untuk pemula bisa mencoba dari beberapa taruhan
                    terkecil dulu. Untuk menguasai perhitungan volum mesin slot gacor tertinggi berjalan. Nah
                    itu lah beberapa ulasan paling paten yang bisa anda ikuti dan mencoba beberapa permainan
                    slot gacor.</p>
                <h3 class="text-white">Paling Top 5 Provider slot online dan permainan slot dengan nilai RTP tinggi yaitu?</h3>
                <ul>
                    <li style="text-align:justify">1. CQ9 Permainan Ganesha JR. 97,75 persen RTP</li>
                    <li style="text-align:justify">2. Pg Pocket Games Soft permainan Mahjong ways 2 98,89 persen
                        RTP</li>
                    <li style="text-align:justify">3. Pragmatic Play permainan Gates OF Olympus / Zeus 99,78
                        persen RTP</li>
                    <li style="text-align:justify">4. Micro Gaming dengan permainan Africa X Up 96,98 persen RTP
                    </li>
                    <li style="text-align:justify">5. Habanero dengan permainan lucky durian 89,95 persen RTP
                    </li>
                </ul>
                <p style="text-align:justify">Ini lah 5 provder slot online dengan 5 permainan slot online yang
                    bisa anda coba untuk mencari peruntungan semata. Dengan adanya RTP semua permainan menjadi
                    mudah untuk meraih keuntungan besar.</p>
                <div class="container">
                    <div class="footer text-center pb-2">
                        <span>©Copyright 2022 Okeplay777. All Rights Reserved | 18+</span>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
