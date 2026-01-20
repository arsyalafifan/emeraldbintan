@extends('layouts.app')

@section('title')
{{ tr('Bintan Tour Packages, Taxi & Car Rental | Emerald Bintan Travel') }}
@endsection

@section('content')
<section id="{{ section_id('beranda') }}" class="hero-section">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                <h1>{{ tr('Liburan Impian di Bintan Dimulai Di Sini') }}</h1>
                <p class="lead mb-4 text-white-50">{{ tr('Dapatkan penawaran eksklusif untuk paket wisata premium, staycation resort mewah, dan petualangan pulau.') }}</p>
                <a href="#{{ section_id('paket') }}" class="btn btn-light btn-lg rounded-pill fw-bold text-primary-custom px-5 shadow">{{ tr('Pilih Paket Wisata') }}</a>
            </div>
        </div>
    </div>
    <a href="#{{ section_id('paket') }}" class="scroll-down"><i class="fas fa-chevron-down fa-2x"></i></a>
</section>

<section id="{{ section_id('paket') }}" class="section-padding bg-image-overlay-paket" 
      {{-- style="background-color: #fbfbfb;" --}}
      >
    <div class="container">
        <div class="section-title text-center section-title-line" data-aos="fade-up">
            <h2>{{ tr('Pilihan Paket Wisata Bintan') }}</h2>
            <p class="text-muted">{{ tr('Temukan pengalaman terbaik sesuai budget dan gaya liburan Anda') }}</p>
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
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pills-all">{{ tr('Semua Paket Tur') }}</button></li>
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
                                                    loading="lazy"
                                                    src="{{ asset('storage/' . $img->imgUrl) }}"
                                                    class="d-block w-100"
                                                    alt="{{ $item->packageTitle }}"
                                                >
                                            </div>
                                        @empty
                                            {{-- fallback kalau belum ada image --}}
                                            <div class="carousel-item active">
                                                <img
                                                    loading="lazy"
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
                                        {{ $hours }} {{ tr('Hours') }}
                                    </span>

                                    <span>
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{ $item->destinations->count() }} {{ tr('Destinations') }}
                                    </span>
                                </div>

                                <div class="mt-3 pt-3 border-top d-flex justify-content-center align-items-center">
                                    <div style="width: 100%;">
                                        {{-- <small class="text-muted d-block" style="font-size: 0.75rem;">{{ tr('Mulai dari') }}</small>
                                        @if($item->isPromo)
                                        <div>
                                            <small class="text-decoration-line-through text-muted">IDR {{ number_format($item->price, 0, ',', '.') }}</small>
                                            <h3 class="fw-bold text-danger mb-0">IDR {{ number_format($item->promoPrice, 0, ',', '.') }}</h3>
                                        </div>
                                        @else
                                        <div class="price-final">IDR {{ number_format($item->price, 0, ',', '.') }}</div>
                                        @endif --}}

                                        @if($item->prices->count())
                                        <div style="display: flex; flex-direction: column; gap: 12px;">
                                            @foreach($item->prices as $pr)
                                                <div class="price-card p-3 border rounded-3" style="background: #f8f9fa; border: 1px solid #dee2e6;">
                                                    <div class="price-title mb-2">
                                                        <p style="font-weight: bold; margin: 0; color: #083c55; font-size: 0.95rem;">{{ tr($pr->packagePriceTitle ?? '') }}</p>
                                                    </div>
                                                    <div class="price-display">
                                                        @if($pr->isPromo)
                                                        <div>
                                                            <small class="text-decoration-line-through text-muted d-block mb-1">IDR {{ number_format($pr->price, 0, ',', '.') }}</small>
                                                            <h5 style="margin: 0; color: #dc3545; font-weight: bold; font-size: 1.1rem;">
                                                                IDR {{ number_format($pr->promoPrice, 0, ',', '.') }}
                                                                @if($pr->pricePer)
                                                                <span style="font-size: 0.75rem;" class="text-muted">{{ " / " . $pr->pricePer }}</span>
                                                                @endif
                                                            </h5>
                                                            <small class="text-success" style="font-weight: 500; display: block; margin-top: 5px;">
                                                                @php
                                                                    $savings = $pr->price - $pr->promoPrice;
                                                                    $percentage = ($savings / $pr->price) * 100;
                                                                @endphp
                                                                Hemat IDR {{ number_format($savings, 0, ',', '.') }} ({{ round($percentage) }}%)
                                                            </small>
                                                        </div>
                                                        @else
                                                        <h5 style="margin: 0; color: #6fd4ff; font-weight: bold; font-size: 1.1rem;">
                                                            IDR {{ number_format($pr->price, 0, ',', '.') }}
                                                            @if($pr->pricePer)
                                                            <span style="font-size: 0.75rem;" class="text-muted">{{ " / " . $pr->pricePer }}</span>
                                                            @endif
                                                        </h5>
                                                        @endif
                                                    </div>
                                                    @if($pr->priceDesc)
                                                    <div>
                                                        <p style="color: #999; margin: 8px 0 0 0; font-size: 12px;">{{ $pr->priceDesc }}</p>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        @else
                                        <p class="text-muted small fst-italic">No price available</p>
                                        @endif
                                    </div>
                                </div>
                                <a href="https://wa.me/6285766256958?text={{ urlencode(tr('Hi, I want to book ' . $item->packageTitle)) }}" class="btn btn-primary-custom w-100 btn-sm mt-3"><i class="fab fa-whatsapp me-2"></i>Booking</a>
                                <a href="#" class="btn-link-toggle text-primary-custom text-center mt-2" role="button" data-bs-toggle="collapse" data-bs-target="#detail-{{ $item->travelpackageid }}" onclick="return false;">
                                    {{ tr('Lihat Detail') }} <i class="fas fa-chevron-down ms-1"></i>
                                </a>
                            </div>

                            <div class="collapse package-detail-collapse" id="detail-{{ $item->travelpackageid }}">
                                <div class="detail-content">
                                    <p class="text-muted small">{{ tr($item->packageDesc) }}</p>

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
                </div>
            </div>
            <div class="tab-pane fade" id="pills-oneday"><p class="text-center py-5 text-muted">Memuat paket One Day Trip...</p></div>
            <div class="tab-pane fade" id="pills-stay"><p class="text-center py-5 text-muted">Memuat paket Staycation...</p></div>
        </div>
        
        {{-- <div class="text-center mt-5">
            <a href="#" class="btn btn-outline-primary rounded-pill px-4">{{ tr('Lihat Semua Paket') }} <i class="fas fa-arrow-right ms-2"></i></a>
        </div> --}}
    </div>
</section>

<section id="{{ section_id('layanan_taxi') }}" class="section-padding bg-image-overlay-paket" 
      {{-- style="background-color: #fbfbfb;" --}}
      >
    <div class="container">
        <div class="section-title text-center section-title-line" data-aos="fade-up">
            <h2>{{ tr('Pilihan Layanan Taxi') }}</h2>
            <p class="text-muted">{{ tr('Temukan pengalaman terbaik sesuai budget dan gaya liburan Anda') }}</p>
        </div>

        <div class="row mb-5 justify-content-center" data-aos="fade-up">
            <div class="col-auto">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pills-all">{{ tr('Semua Taxi') }}</button></li>
                    {{-- <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-oneday">One Day Trip</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-stay">Staycation</button></li> --}}
                </ul>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all">
                <div class="row g-4 align-items-start">
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-0">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle mb-0">
                                        <thead style="background:#6fd4ff;color:#083c55">
                                            <tr class="text-center">
                                                <th>{{ tr('From') }}</th>
                                                <th>{{ tr('To') }}</th>
                                                <th>7 {{ tr('Seats') }}<br>{{ tr('One Way') }}</th>
                                                <th>7 {{ tr('Seats') }}<br>{{ tr('Two Ways') }}</th>
                                                <th>HiAce 14 {{ tr('Seats') }}<br>{{ tr('One Way') }}</th>
                                                <th>HiAce 14 {{ tr('Seats') }}<br>{{ tr('Two Ways') }}</th>
                                                <th>{{ tr('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($taxi as $t)
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            {{ optional($t->destinationFrom)->destinationName }}
                                                        </strong>
                                                    </td>

                                                    <td>
                                                        <strong>
                                                            {{ optional($t->destination)->destinationName }}
                                                        </strong>
                                                    </td>

                                                    <td class="text-center">
                                                        {{ idr_short($t->price7seatoneway) }}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ idr_short($t->price7seattwoway) }}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ idr_short($t->price14seatoneway) }}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ idr_short($t->price14seattwoway) }}
                                                    </td>

                                                    <td class="text-center">
                                                        <a
                                                            href="https://wa.me/6285766256958?text={{ urlencode(
                                                                tr('Hello, I want to book taxi service to') . ' ' .
                                                                optional($t->destination)->destinationName
                                                            ) }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-success rounded-pill px-3"
                                                        >
                                                            <i class="fab fa-whatsapp me-1"></i>
                                                            {{ tr('Book Now') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted py-4">
                                                        {{ tr('No taxi services available') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-oneday"><p class="text-center py-5 text-muted">Memuat paket One Day Trip...</p></div>
            <div class="tab-pane fade" id="pills-stay"><p class="text-center py-5 text-muted">Memuat paket Staycation...</p></div>
        </div>
        
        {{-- <div class="text-center mt-5">
            <a href="#" class="btn btn-outline-primary rounded-pill px-4">{{ tr('Lihat Semua Paket') }} <i class="fas fa-arrow-right ms-2"></i></a>
        </div> --}}
    </div>
</section>

<section id="{{ section_id('rental_mobil') }}" class="section-padding bg-image-overlay-paket">
    <div class="container">

        <div class="section-title text-center section-title-line" data-aos="fade-up">
            <h2>{{ tr('Car Rental') }}</h2>
            <p class="text-muted">{{ tr('Flexible car rental packages with competitive prices') }}</p>
        </div>

        {{-- TABLE --}}
        <div class="table-responsive mb-5" data-aos="fade-up">
            <table class="table table-bordered text-center align-middle rental-table">
                <thead class="bg-primary-custom text-white">
                    <tr>
                        <th>{{ tr('Coach Type') }}</th>
                        <th>{{ tr('Half Day') }}<br>(4 hrs)</th>
                        <th>{{ tr('Full Day') }}<br>(8 hrs)</th>
                        <th>{{ tr('Whole Day') }}<br>(12 hrs)</th>
                        <th>{{ tr('Add Hrs') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carRental as $car)
                        <tr>
                            <td class="fw-semibold">{{ $car->type }}</td>
                            <td>{{ idr_short($car->pricehalfday) }}</td>
                            <td>{{ idr_short($car->pricefullday) }}</td>
                            <td>{{ idr_short($car->pricewholeday) }}</td>
                            <td>{{ idr_short($car->priceadditional) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted py-4">
                                {{ tr('No car rental data available') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- CAR RENTAL CARDS --}}
        <div class="row g-4">
            @foreach($carRental as $index => $car)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="rental-card">

                        {{-- IMAGE --}}
                        <div class="rental-image">
                            <div id="carCarousel{{ $car->carrentalserviceid }}" 
                                class="carousel slide" 
                                data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @forelse($car->images as $i => $img)
                                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                            <img loading="lazy" src="{{ asset('storage/' . $img->imgUrl) }}" alt="{{ $car->type }}">
                                        </div>
                                    @empty
                                        <div class="carousel-item active">
                                            <img loading="lazy" src="https://via.placeholder.com/600x400?text=Car+Image">
                                        </div>
                                    @endforelse
                                </div>

                                @if($car->images->count() > 1)
                                    <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carCarousel{{ $car->carrentalserviceid }}"
                                            data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                            data-bs-target="#carCarousel{{ $car->carrentalserviceid }}"
                                            data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                @endif
                            </div>
                        </div>

                        {{-- BODY --}}
                        <div class="rental-body">

                            <h5 class="rental-title">{{ $car->type }}</h5>

                            <div class="price-box">
                                <div><span>IDR {{ idr_short($car->pricehalfday) }}</span> / 4 hours</div>
                                <div><span>IDR {{ idr_short($car->pricefullday) }}</span> / 8 hours</div>
                                <div><span>IDR {{ idr_short($car->pricewholeday) }}</span> / 12 hours</div>
                                <div class="price-extra">
                                    {{ tr('Additional hour') }}: {{ idr_short($car->priceadditional) }}
                                </div>
                            </div>

                            @if($car->includes)
                                <div class="include-box">
                                    <strong>{{ tr('Includes') }}</strong>
                                    <p>{!! nl2br(e($car->includes)) !!}</p>
                                </div>
                            @endif

                            <a href="https://wa.me/6285766256958?text={{ urlencode('Hi, I want to rent '.$car->type) }}"
                            target="_blank"
                            class="btn btn-book">
                                {{ tr('Book Now') }}
                            </a>

                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </div>
</section>


<section id="{{ section_id('tentang_kami') }}" class="section-padding" style="background-color: #f0f2f5;">
    <div class="container">
        <div class="row align-items-center mb-5">
            {{-- <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1576016770483-45853530b61c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Tim Emerald Bintan" class="img-fluid rounded-4 shadow-lg position-relative z-2">
                    <div class="position-absolute bg-primary-custom rounded-4" style="width: 100%; height: 100%; top: 20px; left: -20px; z-index: 1; opacity: 0.1;"></div>
                </div>
            </div> --}}
            
            <div class="col-lg-12 ps-lg-5" data-aos="fade-left">
                <div class="section-title section-title-line mb-4">
                    <h2 class="text-primary-custom">{{ tr('Tentang Emerald Tour & Travel') }}</h2>
                </div>
                
                <p class="lead fw-bold text-dark">{{ tr('Partner Perjalanan Profesional Anda di Pulau Bintan') }}</p>
                <p class="text-muted">
                    {{ tr('Emerald Tour and Travel Bintan adalah perusahaan jasa pariwisata yang berbasis di Pulau Bintan, Kepulauan Riau. Kami fokus pada layanan tour, travel, dan rental mobil profesional untuk memberikan pengalaman perjalanan yang aman, nyaman, dan berkesan bagi wisatawan domestik maupun mancanegara.') }}
                </p>
                <p class="text-muted mb-4">
                    {{ tr('Dengan pemahaman mendalam tentang destinasi wisata lokal, kami menyediakan layanan fleksibel mulai dari liburan santai, perjalanan bisnis, hingga transportasi VIP yang disesuaikan dengan kebutuhan Anda.') }}
                </p>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 shadow-sm border-start border-4 border-primary h-100">
                            <h5 class="fw-bold text-dark"><i class="fas fa-eye text-primary-custom me-2"></i>{{ tr('Visi') }}</h5>
                            <p class="small text-muted mb-0">{{ tr('Menjadi penyedia jasa tour dan travel terpercaya di Bintan yang dikenal akan profesionalisme, keandalan layanan, dan kepuasan pelanggan.') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 shadow-sm border-start border-4 border-warning h-100">
                            <h5 class="fw-bold text-dark"><i class="fas fa-bullseye text-warning me-2"></i>{{ tr('Misi') }}</h5>
                            <ul class="small text-muted mb-0 ps-3">
                                <li>{{ tr('Memberikan pengalaman aman & menyenangkan.') }}</li>
                                <li>{{ tr('Layanan transportasi & tour profesional.') }}</li>
                                <li>{{ tr('Mendukung promosi pariwisata Bintan.') }}</li>
                                <li>{{ tr('Membangun hubungan jangka panjang.') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h4 class="fw-bold mb-4 text-primary-custom"><i class="fas fa-concierge-bell me-2"></i>{{ tr('Layanan Kami') }}</h4>
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-unstyled text-muted">
                                <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle text-success me-3"></i>{{ tr('Paket Wisata Bintan & Sekitarnya') }}</li>
                                <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle text-success me-3"></i>{{ tr('Tour Privat & Grup') }}</li>
                                <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle text-success me-3"></i>{{ tr('Rental Mobil (Lepas Kunci / Driver)') }}</li>
                                <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle text-success me-3"></i>{{ tr('Airport & Ferry Terminal Transfer') }}</li>
                                <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle text-success me-3"></i>{{ tr('City Tour & Custom Itinerary') }}</li>
                                <li class="mb-2 d-flex align-items-center"><i class="fas fa-check-circle text-success me-3"></i>{{ tr('Transportasi Corporate & Event') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="p-4 bg-primary-custom text-white rounded-4 shadow-sm h-100">
                    <h4 class="fw-bold mb-4 text-white"><i class="fas fa-thumbs-up me-2"></i>{{ tr('Mengapa Memilih Kami?') }}</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-map-marked-alt fa-lg me-3 mt-1 text-warning"></i>
                            <div>
                                <strong>{{ tr('Berbasis Lokal') }}</strong>
                                <br><span class="small opacity-75">{{ tr('Kami sangat memahami rute dan budaya lokal Bintan.') }}</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-car fa-lg me-3 mt-1 text-warning"></i>
                            <div>
                                <strong>{{ tr('Armada Terawat') }}</strong>
                                <br><span class="small opacity-75">{{ tr('Kendaraan bersih, nyaman, dan rutin di-service.') }}</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-tag fa-lg me-3 mt-1 text-warning"></i>
                            <div>
                                <strong>{{ tr('Harga Transparan') }}</strong>
                                <br><span class="small opacity-75">{{ tr('Harga kompetitif tanpa biaya tersembunyi.') }}</span>
                            </div>
                        </li>
                        <li class="mb-0 d-flex align-items-start">
                            <i class="fas fa-smile fa-lg me-3 mt-1 text-warning"></i>
                            <div>
                                <strong>{{ tr('Layanan Ramah') }}</strong>
                                <br><span class="small opacity-75">{{ tr('Respon cepat dan driver yang sopan & profesional.') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-5" data-aos="fade-up">
            <div class="col-12 text-center">
                <p class="fs-5 fst-italic text-muted">"{{ tr('Emerald Tour and Travel Bintan siap menjadi partner perjalanan Anda untuk menjelajahi keindahan Bintan dengan tenang dan penuh kenyamanan.') }}"</p>
                <div class="mt-4">
                    <a href="https://wa.me/6285766256958?text={{ urlencode(tr('Hi, I want to book a tour')) }}" class="btn btn-primary-custom px-4 shadow">{{ tr('Hubungi Tim Kami') }}</a>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="section-padding bg-white bg-image-overlay">
    <div class="container">
        <div class="section-title text-center section-title-line mb-5">
            <h2>{{ tr('Galeri & Testimoni') }}</h2>
        </div>
        
        <div class="row g-3 mb-5">
            <div class="col-md-4 col-6" data-aos="zoom-in"><div class="gallery-item"><img loading="lazy" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Galeri"></div></div>
            <div class="col-md-4 col-6" data-aos="zoom-in" data-aos-delay="100"><div class="gallery-item"><img loading="lazy" src="https://images.unsplash.com/photo-1468413253725-0d5181091126?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Galeri"></div></div>
            <div class="col-md-4 col-12" data-aos="zoom-in" data-aos-delay="200"><div class="gallery-item"><img loading="lazy" src="https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Galeri"></div></div>
        </div>

        <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-lg-8 text-center">
                <div class="card border-0 shadow-sm p-4 bg-light">
                    <i class="fas fa-quote-left fa-2x text-primary-custom mb-3 opacity-25"></i>
                    <figure>
                        <blockquote class="blockquote">
                            <p class="fs-5 fst-italic">"{{ tr('Sangat puas dengan pelayanan Emerald Bintan. Drivernya on-time, mobil bersih, dan itinerary-nya fleksibel banget. Recommended!') }}"</p>
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
        <h2 class="fw-bold">{{ tr('Sudah Siap Berangkat?') }}</h2>
        <p class="mb-4 text-white-50">{{ tr('Konsultasikan rencana perjalanan Anda sekarang, Gratis!') }}</p>
        <a href="https://wa.me/6285766256958?text={{ urlencode(tr('Hi, I want to book a tour')) }}" class="btn btn-light btn-lg rounded-pill fw-bold text-primary-custom"><i class="fab fa-whatsapp me-2"></i>{{ tr('Chat WhatsApp') }}</a>
    </div>
</section>
@endsection
