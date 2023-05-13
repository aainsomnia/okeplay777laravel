@extends('web.layout.app')
@section('title') Okeplay777 @endsection
@section('content')

    <!-- Slider main container -->


    <div class="flex gap-2 w-full max-w-full bg-gray-800 py-5 px-5 sm:px-10 slider-container mb-10">
        <div class="w-[40px] sm:w-[50px] flex-none grow-0 shrink-0">
            <button class="btn p-0 flex items-center justify-center text-sm !bg-transparent border-0 rounded-none w-full h-[50px] sm:h-[90px] text-white btn-prev"><span class="iconify-inline" data-icon="fa-solid:chevron-left"></span></button>
        </div>
        <div class="grow w-[200px] md:w-[400px] max-w-full shrink-0">
            <div class="swiper slides flex">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                <!-- Slides -->

                @foreach ($categorys as $ctg)
                    <div class="swiper-slide">
                        <a href="{{ route('byId', ['name'=>Str::slug($ctg->category_name, '-'),'id'=>$ctg->category_id]) }}" class="bg-black hover:bg-yellow-800 h-[50px] sm:h-[90px] flex flex-col items-center justify-center gap-1 w-full p-2">
                            <img src="{{ url('storage/images/category/'.$ctg->category_img) }}" alt="" class="h-[20px] sm:h-[40px]">
                            <div class="text-[9px] sm:text-[12px] text-center">{{ $ctg->category_name }}</div>
                        </a>
                    </div>
                @endforeach

                </div>
                <!-- If we need pagination -->


                <!-- If we need navigation buttons -->

                <!-- If we need scrollbar -->

            </div>
        </div>

        <div class="w-[40px] sm:w-[50px] flex-none grow-0 shrink-0">
            <button class="btn p-0 flex items-center justify-center text-sm !bg-transparent border-0 rounded-none w-full h-[50px] sm:h-[90px] text-white btn-next"><span class="iconify-inline" data-icon="fa-solid:chevron-right"></span></button>
        </div>
    </div>

    <div class="px-5 pb-5 lg:pb-10 lg:px-10 content-bg">
        <div class="flex -mt-[10px] mb-[30px] justify-center items-center gap-3">
            <div class="content-dots jd1">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <h1 class="content-h1">{{ $title_category->category_name }}</h1>
            <div class="content-dots jd2">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2">
            @foreach ($contents as $ct)
                <div class="card group rounded-lg bg-[#3C2B0D] border-[3px] border-[#755720] shadow-lg text-white relative">

                    <div class="relative">
                        <img src="{{ url('storage/images/content/'.$ct->content_img) }}" alt="" class="w-full object-contain bg-black rounded-t-lg">
                    </div>
                    <div class="card-title text-center text-[12px] py-2 px-2 text-center w-full block leading-normal whitespace-nowrap">
                        {{ $ct->content_name }}

                    </div>
                    <div class="relative px-2 pb-2">
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
                        <div class="progress progress-striped active progress-sm">
                            <div role="progressbar " style="width: {{ $ct->content_persen }}%;" class="progress-bar progress-bar-{{ $bar_colour }} "><span>&nbsp;</span></div>
                        </div>

                        <div class="z-40 absolute left-0 top-0 right-0 h-full py-2 text-center font-bold text-black text-xs">
                            {{ $ct->content_persen }}%
                        </div>
                    </div>
                    <div class="z-50 absolute left-0 top-0 right-0 w-full h-full flex invisible opacity-0 transition-all bg-black bg-opacity-70 group-hover:visible group-hover:opacity-100">
                        <a href="{{ $ct->category->game_url }}" class="btn btn-warning btn-sm bg-gradient-to-b from-yellow-100 via-yellow-300 to-yellow-600 hover:bg-gradient-to-t hover:from-yellow-100 hover:via-yellow-300 hover:to-yellow-600 rounded-xl w-10/12 m-auto">Main</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-black px-5 py-5 lg:px-20 lg:py-10  border-[4px] -mt-[2px] border-[#755720]">
        <article class="word ">
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

            </div>
        </article>
    </div>
@endsection
