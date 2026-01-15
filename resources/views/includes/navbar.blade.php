<nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img width="50" height="50" style="margin: 5px;" src="{{ asset('frontend/images/emerald-bintan-logo.png') }}" alt="emerald-bintan-logo"> Emerald Bintan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <div class="language-switcher d-flex align-items-center ms-3">
                        <a href="/id"
                        class="lang-item {{ app()->getLocale()=='id'?'active':'' }}">
                            <img src="https://flagcdn.com/w20/id.png" alt="ID">
                            ID
                        </a>
                        <a href="/en"
                        class="lang-item {{ app()->getLocale()=='en'?'active':'' }}">
                            <img src="https://flagcdn.com/w20/gb.png" alt="EN">
                            EN
                        </a>
                    </div>
                    <li class="nav-item"><a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('beranda') }}">{{ tr('Beranda') }}</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/{{ app()->getLocale() }}#{{ section_id('paket') }}">{{ tr('Paket Tour') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('rental_mobil') }}">{{ tr('Rental Mobil') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('layanan_taxi') }}">{{ tr('Layanan Taxi') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('tentang_kami') }}">{{ tr('Tentang Kami') }}</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="https://wa.me/" class="btn btn-primary-custom">{{ tr('Hubungi Kami') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>