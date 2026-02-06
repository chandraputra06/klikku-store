@extends('layouts.main')

@section('title', 'Tentang Kami - KlikkuStore')

@section('content')
{{-- HERO --}}
<header class="bg-light border-bottom overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge text-bg-primary mb-3">Tentang KlikkuStore</span>
                <h1 class="display-6 fw-bold mb-3">
                    Belanja yang cepat, aman, dan terasa simpel.
                </h1>
                <p class="lead text-secondary mb-4">
                    KlikkuStore dibangun untuk bikin pengalaman belanja online lebih nyaman:
                    katalog rapi, stok jelas, dan proses checkout yang nggak ribet.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-2">
                    <a href="{{ route('shop.products.index') }}" class="btn btn-primary btn-lg">
                        Mulai Belanja
                    </a>
                    <a href="{{ route('homepage') }}#products" class="btn btn-outline-secondary btn-lg">
                        Lihat Produk Terbaru
                    </a>
                </div>

                <div class="row g-3 mt-4">
                    <div class="col-6 col-md-4">
                        <div class="p-3 bg-white border rounded-4 h-100">
                            <div class="fw-bold h4 mb-0">Cepat</div>
                            <div class="small text-secondary">Checkout ringkas</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="p-3 bg-white border rounded-4 h-100">
                            <div class="fw-bold h4 mb-0">Aman</div>
                            <div class="small text-secondary">Transaksi terjaga</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-3 bg-white border rounded-4 h-100">
                            <div class="fw-bold h4 mb-0">Support</div>
                            <div class="small text-secondary">Respons cepat</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm overflow-hidden rounded-4">
                    <div class="p-4 bg-white">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-4 bg-body-tertiary">
                                <img src="{{ asset('images/klikku-logo.png') }}" alt="KlikkuStore" style="height:48px;width:auto;">
                            </div>
                            <div>
                                <div class="fw-bold fs-4 mb-0">Klikku<span class="text-primary">Store</span></div>
                                <div class="text-secondary small">Belanja cepat, aman, dan hemat.</div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 border rounded-4 h-100">
                                    <div class="fw-semibold">Katalog</div>
                                    <div class="text-secondary small">Produk tersusun rapi</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border rounded-4 h-100">
                                    <div class="fw-semibold">Stok</div>
                                    <div class="text-secondary small">Update real-time</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 border rounded-4">
                                    <div class="fw-semibold">Komitmen Kami</div>
                                    <div class="text-secondary small">
                                        Memberikan pengalaman belanja yang sederhana dengan pelayanan yang konsisten.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="bg-primary text-white p-4">
                        <div class="fw-semibold">Tip</div>
                        <div class="small opacity-75">
                            Gunakan fitur pencarian untuk menemukan produk lebih cepat.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- STORY + TIMELINE --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Cerita Singkat</h2>
                <p class="text-secondary mb-3">
                    Kami percaya belanja online harus terasa mudah seperti belanja di toko dekat rumah:
                    pilih barangnya, bayar, dan barang cepat sampai.
                </p>
                <p class="text-secondary mb-0">
                    KlikkuStore fokus membangun sistem yang rapi di belakang layar supaya di depan,
                    customer tinggal menikmati pengalaman belanja yang lancar.
                </p>
            </div>

            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-4 h-100">
                    <div class="fw-bold mb-3">Timeline</div>

                    <div class="d-flex gap-3 mb-3">
                        <div class="badge text-bg-primary rounded-pill">1</div>
                        <div>
                            <div class="fw-semibold">Mulai membangun katalog</div>
                            <div class="small text-secondary">Struktur produk & kategori yang rapi.</div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-3">
                        <div class="badge text-bg-primary rounded-pill">2</div>
                        <div>
                            <div class="fw-semibold">Admin panel</div>
                            <div class="small text-secondary">Kelola produk, kategori, dan user.</div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="badge text-bg-primary rounded-pill">3</div>
                        <div>
                            <div class="fw-semibold">Customer experience</div>
                            <div class="small text-secondary">Cari produk, lihat detail, dan belanja.</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- VALUES --}}
<section class="py-5 bg-light border-top border-bottom">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2">Nilai yang Kami Pegang</h2>
            <p class="text-secondary mb-0">Hal-hal yang bikin KlikkuStore konsisten.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 rounded-4">
                    <div class="card-body p-4">
                        <div class="badge text-bg-primary mb-3">Simpel</div>
                        <h5 class="fw-bold">UX yang mudah</h5>
                        <p class="text-secondary mb-0">Navigasi jelas dan alur belanja tidak membingungkan.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 rounded-4">
                    <div class="card-body p-4">
                        <div class="badge text-bg-success mb-3">Aman</div>
                        <h5 class="fw-bold">Kepercayaan</h5>
                        <p class="text-secondary mb-0">Kami jaga keamanan transaksi dan data pengguna.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 rounded-4">
                    <div class="card-body p-4">
                        <div class="badge text-bg-warning mb-3">Responsif</div>
                        <h5 class="fw-bold">Support</h5>
                        <p class="text-secondary mb-0">Fast response untuk pertanyaan dan kendala customer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MINI FAQ --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <h2 class="fw-bold mb-2">Pertanyaan yang sering muncul</h2>
                <p class="text-secondary mb-0">
                    Beberapa jawaban cepat sebelum kamu mulai belanja.
                </p>
            </div>

            <div class="col-lg-7">
                <div class="accordion" id="faqAbout">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Apakah stok selalu update?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAbout">
                            <div class="accordion-body text-secondary">
                                Ya, stok mengikuti data produk yang dikelola dari admin panel.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Bagaimana cara mencari produk?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAbout">
                            <div class="accordion-body text-secondary">
                                Gunakan search di navbar atau halaman Produk untuk menemukan item lebih cepat.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apakah harus login untuk belanja?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAbout">
                            <div class="accordion-body text-secondary">
                                Untuk fitur checkout/riwayat belanja nanti, login akan diperlukan.
                                Saat ini kamu bisa browse produk tanpa login.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-4 border rounded-4 bg-light">
                    <div class="fw-semibold mb-1">Butuh bantuan lebih lanjut?</div>
                    <div class="text-secondary small">
                        Hubungi support kami melalui email/WhatsApp (bisa kamu isi nanti di bagian kontak).
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-5">
    <div class="container">
        <div class="p-5 rounded-4 bg-primary text-white">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-1">Siap mulai belanja?</h3>
                    <p class="mb-0 opacity-75">Lihat produk, pilih yang kamu butuhkan, dan nikmati proses yang simpel.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('shop.products.index') }}" class="btn btn-light btn-lg">
                        Lihat Produk
                    </a>
                    @guest
                        <a href="{{ route('auth.register-page') }}" class="btn btn-outline-light btn-lg ms-lg-2 mt-2 mt-lg-0">
                            Daftar
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>
@endsection