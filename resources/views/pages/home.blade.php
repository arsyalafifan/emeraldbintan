@extends('layouts.app')

@section('title')
Paket Wisata Bintan Murah & Terpercaya | Emerald Bintan Tour
@endsection

@section('content')
<section id="beranda" class="hero-section">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                <h1>Liburan Impian di Bintan Dimulai Di Sini</h1>
                <p class="lead mb-4 text-white-50">Dapatkan penawaran eksklusif untuk paket wisata premium, staycation resort mewah, dan petualangan pulau.</p>
                <a href="#paket" class="btn btn-light btn-lg rounded-pill fw-bold text-primary-custom px-5 shadow">Pilih Paket Wisata</a>
            </div>
        </div>
    </div>
    <a href="#paket" class="scroll-down"><i class="fas fa-chevron-down fa-2x"></i></a>
</section>

<section id="paket" class="section-padding bg-image-overlay-paket" 
      {{-- style="background-color: #fbfbfb;" --}}
      >
    <div class="container">
        <div class="section-title text-center section-title-line" data-aos="fade-up">
            <h2>Pilihan Paket Wisata</h2>
            <p class="text-muted">Temukan pengalaman terbaik sesuai budget dan gaya liburan Anda</p>
        </div>

        {{-- <div class="row justify-content-center" data-aos="zoom-in">
            <div class="col-lg-12">
                <div class="featured-deal">
                    <div class="row g-0 align-items-center">
                        <div class="col-lg-6 position-relative" style="height: 100%;">
                            <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Special Deal" class="featured-img">
                            <div class="position-absolute top-0 start-0 m-3 bg-danger text-white px-3 py-1 rounded fw-bold shadow">
                                <i class="fas fa-fire me-1"></i> HOT PROMO
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-4 p-lg-5">
                                <span class="badge bg-primary-custom mb-2">LIMITED OFFER</span>
                                <h3 class="fw-bold mb-3">Emerald Luxury Escape (4D3N)</h3>
                                <p class="text-muted mb-4">Nikmati kemewahan menginap di Private Pool Villa Bintan. Termasuk Candle Light Dinner, Spa, dan Private Tour keliling pulau dengan armada VIP.</p>
                                
                                <div class="row mb-4 small text-muted">
                                    <div class="col-6 mb-2"><i class="fas fa-check text-success me-2"></i>Private Villa</div>
                                    <div class="col-6 mb-2"><i class="fas fa-check text-success me-2"></i>VIP Transport</div>
                                    <div class="col-6 mb-2"><i class="fas fa-check text-success me-2"></i>All-Inclusive Meals</div>
                                    <div class="col-6 mb-2"><i class="fas fa-check text-success me-2"></i>Documentation</div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between border-top pt-3">
                                    <div>
                                        <small class="text-decoration-line-through text-muted">IDR 8.500k</small>
                                        <h3 class="fw-bold text-danger mb-0">IDR 4.250k</h3>
                                    </div>
                                    <a href="#" class="btn btn-primary-custom shadow">Ambil Promo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row mb-5 justify-content-center" data-aos="fade-up">
            <div class="col-auto">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pills-all">Semua Paket</button></li>
                    {{-- <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-oneday">One Day Trip</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-stay">Staycation</button></li> --}}
                </ul>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all">
                <div class="row g-4 align-items-start">

                  @foreach($items as $item)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="package-card"> 
                            <div class="package-thumb">
                              @if($item->isRibbon)
                                <div class="ribbon">{{ $item->ribbonText }}</div>
                              @endif

                                <div id="carousel-{{ $item->travelpackageid }}"
                                    class="carousel slide"
                                    data-bs-ride="carousel">

                                    <div class="carousel-inner">

                                        @forelse ($item->images as $index => $img)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img
                                                    src="{{ asset('storage/' . $img->imgUrl) }}"
                                                    class="d-block w-100"
                                                    alt="{{ $item->packageTitle }}"
                                                >
                                            </div>
                                        @empty
                                            {{-- fallback kalau belum ada image --}}
                                            <div class="carousel-item active">
                                                <img
                                                    src="https://via.placeholder.com/800x500?text=No+Image"
                                                    class="d-block w-100"
                                                    alt="No Image"
                                                >
                                            </div>
                                        @endforelse

                                    </div>
                                </div>

                                @if($item->images->count() > 1)
                                    <button class="carousel-control-prev"
                                            type="button"
                                            data-bs-target="#carousel-{{ $item->travelpackageid }}"
                                            data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>

                                    <button class="carousel-control-next"
                                            type="button"
                                            data-bs-target="#carousel-{{ $item->travelpackageid }}"
                                            data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                @endif
                            </div>
                            <div class="package-body">
                                <h5 class="fw-bold mb-1">{{ $item->packageTitle }}</h5>
                                <div class="text-warning small mb-3"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <div class="facility-icons">
                                    <span>
                                        <i class="fa-solid fa-clock"></i>
                                        @php
                                            $hours = 0;
                                            if ($item->tourTimeFrom && $item->tourTimeTo) {
                                                $diff = strtotime($item->tourTimeTo) - strtotime($item->tourTimeFrom);
                                                $hours = floor($diff / 3600);
                                            }
                                        @endphp
                                        {{ $hours }} Hours
                                    </span>

                                    <span>
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{ $item->destinations->count() }} Destinations
                                    </span>
                                </div>
                                
                                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Mulai dari</small>
                                        @if($item->isPromo)
                                        <div>
                                            <small class="text-decoration-line-through text-muted">IDR {{ number_format($item->price, 0, ',', '.') }}</small>
                                            <h3 class="fw-bold text-danger mb-0">IDR {{ number_format($item->promoPrice, 0, ',', '.') }}</h3>
                                        </div>
                                        @else
                                        <div class="price-final">IDR {{ number_format($item->price, 0, ',', '.') }}</div>
                                        @endif
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary rounded-pill btn-toggle-detail" type="button" data-bs-toggle="collapse" data-bs-target="#detail-{{ $item->travelpackageid }}">
                                        Lihat Detail <i class="fas fa-chevron-down ms-1"></i>
                                    </button>
                                </div>
                                <a href="https://wa.me/?text=Halo" class="btn btn-primary-custom w-100 btn-sm mt-3"><i class="fab fa-whatsapp me-2"></i>Booking</a>
                            </div>

                            <div class="collapse package-detail-collapse" id="detail-{{ $item->travelpackageid }}">
                                <div class="detail-content">
                                    <p class="text-muted small">{{ $item->packageDesc }}</p>

                                    <h6 class="detail-heading">Tour Time</h6>
                                    <ul class="list-unstyled itinerary-list small text-muted">
                                        <li><i class="fa-solid fa-clock"></i> {{ date('H:i', strtotime($item->tourTimeFrom)) }}</li>
                                        <li><i class="fa-solid fa-clock"></i> {{ date('H:i', strtotime($item->tourTimeTo)) }}</li>
                                    </ul>

                                    <h6 class="detail-heading">Tour Destinations</h6>
                                    @if($item->destinations->count())
                                    <ul class="list-unstyled itinerary-list small text-muted">
                                        @foreach($item->destinations as $dest)
                                            <li>
                                                <i class="fa-solid fa-circle-check me-2"></i>
                                                {{ $dest->destinationName }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p class="text-muted small fst-italic">No destination available</p>
                                    @endif

                                    <h6 class="detail-heading">Tour Include</h6>
                                    @if($item->includes->count())
                                    <ul class="list-unstyled itinerary-list small text-muted">
                                        @foreach($item->includes as $inc)
                                            <li>
                                                <i class="fa-solid fa-circle-check me-2"></i>
                                                {{ $inc->includeText }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p class="text-muted small fst-italic">No inclusions</p>
                                    @endif

                                    <h6 class="detail-heading">Tour Exclude</h6>
                                    @if($item->excludes->count())
                                    <ul class="list-unstyled itinerary-list small text-muted">
                                        @foreach($item->excludes as $exc)
                                            <li>
                                                <i class="fa-solid fa-circle-xmark"></i>
                                                {{ $exc->excludeText }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p class="text-muted small fst-italic">No exclusions</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach
                    {{-- <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="package-card"> 
                            <div class="package-thumb">
                                <div class="ribbon">BEST SELLER</div>
                                <img src="https://images.unsplash.com/photo-1590523277543-a94d2e4eb00b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Lagoi">
                            </div>
                            <div class="package-body">
                                <h5 class="fw-bold mb-1">Lagoi Bay Explorer</h5>
                                <div class="text-warning small mb-3"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p class="text-muted small">Jelajahi kawasan eksklusif Lagoi Bay, Treasure Bay, dan Safari Lagoi dalam 3 hari.</p>
                                <div class="facility-icons">
                                    <span><i class="fas fa-hotel"></i> Hotel</span>
                                    <span><i class="fas fa-utensils"></i> Makan</span>
                                    <span><i class="fas fa-car"></i> Mobil</span>
                                </div>
                                
                                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Mulai dari</small>
                                        <div class="price-final">IDR 2.450k</div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary rounded-pill btn-toggle-detail" type="button" data-bs-toggle="collapse" data-bs-target="#detailLagoi" aria-expanded="false">
                                        Lihat Detail <i class="fas fa-chevron-down ms-1"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="collapse package-detail-collapse" id="detailLagoi">
                                <div class="detail-content">
                                    <h6 class="detail-heading">Itinerary Singkat</h6>
                                    <ul class="itinerary-list small text-muted">
                                        <li><strong>Hari 1:</strong> Jemput Ferry, Check-in, Treasure Bay.</li>
                                        <li><strong>Hari 2:</strong> Safari Lagoi, Mangrove Tour, BBQ.</li>
                                        <li><strong>Hari 3:</strong> Belanja Souvenir, Drop Pelabuhan.</li>
                                    </ul>
                                    <a href="https://wa.me/?text=Halo" class="btn btn-primary-custom w-100 btn-sm mt-3"><i class="fab fa-whatsapp me-2"></i>Booking</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="package-card">
                            <div class="package-thumb">
                                <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Gurun">
                            </div>
                            <div class="package-body">
                                <h5 class="fw-bold mb-1">Bintan Desert Trip</h5>
                                <div class="text-warning small mb-3"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                                <p class="text-muted small">Hunting foto di Gurun Pasir Busung & Danau Biru. Full day tour hemat.</p>
                                <div class="facility-icons">
                                    <span><i class="fas fa-ticket-alt"></i> Tiket</span>
                                    <span><i class="fas fa-utensils"></i> Lunch</span>
                                    <span><i class="fas fa-camera"></i> Guide</span>
                                </div>
                                
                                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Mulai dari</small>
                                        <div class="price-final">IDR 550k</div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary rounded-pill btn-toggle-detail" type="button" data-bs-toggle="collapse" data-bs-target="#detailGurun" aria-expanded="false">
                                        Lihat Detail <i class="fas fa-chevron-down ms-1"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="collapse package-detail-collapse" id="detailGurun">
                                    <div class="detail-content">
                                    <h6 class="detail-heading">Itinerary Singkat</h6>
                                    <ul class="itinerary-list small text-muted">
                                        <li><strong>10:30:</strong> Gurun Pasir & Danau Biru.</li>
                                        <li><strong>13:00:</strong> Makan Siang Seafood.</li>
                                        <li><strong>14:30:</strong> Vihara 1000 Wajah.</li>
                                    </ul>
                                    <a href="https://wa.me/?text=Halo" class="btn btn-primary-custom w-100 btn-sm mt-3"><i class="fab fa-whatsapp me-2"></i>Booking</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="package-card">
                            <div class="package-thumb">
                                <div class="ribbon blue">POPULAR</div>
                                <img src="https://images.unsplash.com/photo-1583205310381-5031db68d226?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Snorkeling">
                            </div>
                            <div class="package-body">
                                <h5 class="fw-bold mb-1">White Sands Snorkeling</h5>
                                <div class="text-warning small mb-3"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p class="text-muted small">Snorkeling trip ke White Sands Island + BBQ Dinner di pinggir pantai.</p>
                                <div class="facility-icons">
                                    <span><i class="fas fa-swimmer"></i> Alat</span>
                                    <span><i class="fas fa-ship"></i> Boat</span>
                                    <span><i class="fas fa-fish"></i> BBQ</span>
                                </div>
                                
                                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Mulai dari</small>
                                        <div class="price-final">IDR 1.250k</div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary rounded-pill btn-toggle-detail" type="button" data-bs-toggle="collapse" data-bs-target="#detailSnorkeling" aria-expanded="false">
                                        Lihat Detail <i class="fas fa-chevron-down ms-1"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="collapse package-detail-collapse" id="detailSnorkeling">
                                    <div class="detail-content">
                                    <h6 class="detail-heading">Itinerary Singkat</h6>
                                    <ul class="itinerary-list small text-muted">
                                        <li><strong>Hari 1:</strong> Snorkeling, Kayak, BBQ.</li>
                                        <li><strong>Hari 2:</strong> Sunrise, Pelepasan Tukik.</li>
                                    </ul>
                                    <a href="https://wa.me/?text=Halo" class="btn btn-primary-custom w-100 btn-sm mt-3"><i class="fab fa-whatsapp me-2"></i>Booking</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
            <div class="tab-pane fade" id="pills-oneday"><p class="text-center py-5 text-muted">Memuat paket One Day Trip...</p></div>
            <div class="tab-pane fade" id="pills-stay"><p class="text-center py-5 text-muted">Memuat paket Staycation...</p></div>
        </div>
        
        <div class="text-center mt-5">
            <a href="#" class="btn btn-outline-primary rounded-pill px-4">Lihat Semua Paket <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<section class="section-padding bg-white bg-image-overlay-whyus">
    <div class="container">
        <div class="section-title text-center section-title-line" data-aos="fade-up">
            <h2>Mengapa Kami?</h2>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-box">
                    <i class="fas fa-medal feature-icon"></i>
                    <h5>Resmi & Terpercaya</h5>
                    <p class="text-muted small">Legalitas lengkap dan berbadan hukum.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-box">
                    <i class="fas fa-tags feature-icon"></i>
                    <h5>Harga Jujur</h5>
                    <p class="text-muted small">Tidak ada biaya tersembunyi (No Hidden Cost).</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-box">
                    <i class="fas fa-users-cog feature-icon"></i>
                    <h5>Tim Profesional</h5>
                    <p class="text-muted small">Guide lokal berpengalaman dan ramah.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-box">
                    <i class="fas fa-clock feature-icon"></i>
                    <h5>Layanan 24 Jam</h5>
                    <p class="text-muted small">Support penuh selama Anda berlibur.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tentang" class="section-padding" style="background-color: #f0f2f5;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1576016770483-45853530b61c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Pemandangan Pantai Lagoi Bay Bintan" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                <div class="section-title section-title-line">
                    <h2>Tentang Emerald Bintan</h2>
                </div>
                <p class="text-muted mb-4">Kami bukan sekadar agen perjalanan, kami adalah konsultan liburan Anda di Bintan. Dengan pengalaman lebih dari 5 tahun melayani ribuan wisatawan domestik dan mancanegara, kami paham betul bagaimana menciptakan momen liburan yang tak terlupakan.</p>
                
                <h5 class="fw-bold mb-3 text-primary-custom" id="layanan">Layanan Kami Lainnya:</h5>
                <div class="row g-2">
                    <div class="col-md-6"><i class="fas fa-check-circle text-success me-2"></i>Sewa Mobil (Lepas Kunci/Driver)</div>
                    <div class="col-md-6"><i class="fas fa-check-circle text-success me-2"></i>Tiket Ferry Batam - Bintan</div>
                    <div class="col-md-6"><i class="fas fa-check-circle text-success me-2"></i>Company Gathering (MICE)</div>
                    <div class="col-md-6"><i class="fas fa-check-circle text-success me-2"></i>Paket Golf Ria Bintan</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white bg-image-overlay">
    <div class="container">
        <div class="section-title text-center section-title-line mb-5">
            <h2>Galeri & Testimoni</h2>
        </div>
        
        <div class="row g-3 mb-5">
            <div class="col-md-4 col-6" data-aos="zoom-in"><div class="gallery-item"><img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Galeri"></div></div>
            <div class="col-md-4 col-6" data-aos="zoom-in" data-aos-delay="100"><div class="gallery-item"><img src="https://images.unsplash.com/photo-1468413253725-0d5181091126?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Galeri"></div></div>
            <div class="col-md-4 col-12" data-aos="zoom-in" data-aos-delay="200"><div class="gallery-item"><img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Galeri"></div></div>
        </div>

        <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-lg-8 text-center">
                <div class="card border-0 shadow-sm p-4 bg-light">
                    <i class="fas fa-quote-left fa-2x text-primary-custom mb-3 opacity-25"></i>
                    <figure>
                        <blockquote class="blockquote">
                            <p class="fs-5 fst-italic">"Sangat puas dengan pelayanan Emerald Bintan. Drivernya on-time, mobil bersih, dan itinerary-nya fleksibel banget. Recommended!"</p>
                        </blockquote>
                        <figcaption class="blockquote-footer mt-2">
                            Anita Wijaya, <cite title="Source Title">Jakarta</cite>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-primary-custom text-white text-center">
    <div class="container" data-aos="zoom-in">
        <h2 class="fw-bold">Sudah Siap Berangkat?</h2>
        <p class="mb-4 text-white-50">Konsultasikan rencana perjalanan Anda sekarang, Gratis!</p>
        <a href="https://wa.me/" class="btn btn-light btn-lg rounded-pill fw-bold text-primary-custom"><i class="fab fa-whatsapp me-2"></i>Chat WhatsApp</a>
    </div>
</section>
@endsection
