@extends('layouts.company_master')

@section('company-content')
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="fw-bold">Arduino vs. Raspberry Pi: Pilih yang Tepat untuk Proyek Anda</h1>
                    <h5>20 Januari 2022</h5>
                    <div>
                        <img src="/assets/img/png/arduino.jpg" class="card-img-top" alt="...">
                        <div class="mt-3">
                            <p style="text-align: justify;">Mikrokontroler adalah perangkat kecil yang dirancang
                                untuk mengontrol dan memonitor berbagai sistem elektronik. Mereka digunakan dalam
                                berbagai proyek, mulai dari otomasi rumah hingga robotika. Dua mikrokontroler yang
                                paling populer adalah Arduino dan Raspberry Pi. Meskipun keduanya memiliki fungsi
                                yang mirip, mereka memiliki perbedaan mendasar yang perlu dipertimbangkan sebelum
                                memilih yang tepat untuk proyek Anda.</p>
                            <h2>Simplicity and Flexibility</h2>
                            <p style="text-align: justify;">
                                Arduino Uno adalah salah satu varian papan Arduino yang paling populer. Papan ini
                                didasarkan pada mikrokontroler ATmega328P dan dilengkapi dengan berbagai pin
                                input/output yang memungkinkan Anda menghubungkan berbagai sensor dan perangkat
                                elektronik. Keuntungan utama Arduino Uno adalah kemudahan penggunaan dan
                                fleksibilitasnya. Bahkan bagi pemula sekalipun, Arduino Uno mudah dipahami dan
                                diprogram. Dengan menggunakan bahasa pemrograman yang sederhana dan intuitif,
                                seperti Arduino IDE, Anda dapat dengan cepat mengembangkan proyek-proyek elektronik
                                yang menarik. Arduino Uno juga merupakan pilihan yang baik untuk proyek-proyek yang
                                membutuhkan kontrol real-time atau interaksi langsung dengan perangkat keras.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <div>
                            <h1 class="fw-bold" style="border-bottom: 1px solid #000;">Lates Post</h1>
                        </div>

                        <div class="row mb-2 lh-1">
                            <div class="col-4">
                                <img src="/assets/img/png/arduino.jpg" class="card-img-top" alt="">
                            </div>
                            <div class="col-8">
                                <p class="fw-bold">Arduino vs. Raspberry Pi: Pilih yang Tepat untuk Proyek Anda</p>
                                <p>20 Januari 2022</p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-4">
                                <img src="/assets/img/png/arduino-2.jpg" class="card-img-top" alt="">
                            </div>
                            <div class="col-8 lh-1">
                                <p class="fw-bold">Membuat Proyek Robot Mini dengan Arduino</p>
                                <p>20 Januari 2022</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
