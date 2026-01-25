<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">

        {{-- BRAND --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <img width="44" height="44"
                 src="{{ asset('frontend/images/emerald-bintan-logo.png') }}"
                 alt="Emerald Bintan">
            <span>Emerald Bintan</span>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            {{-- MENU --}}
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                {{-- LANGUAGE SWITCHER (HARUS LI) --}}
                <li class="nav-item d-flex align-items-center me-lg-2">
                    <div class="language-switcher d-flex">
                        <a href="/id"
                           class="lang-item {{ app()->getLocale()=='id'?'active':'' }}">
                            <img src="https://flagcdn.com/w20/id.png" alt="ID"> ID
                        </a>
                        <a href="/en"
                           class="lang-item {{ app()->getLocale()=='en'?'active':'' }}">
                            <img src="https://flagcdn.com/w20/gb.png" alt="EN"> EN
                        </a>
                    </div>
                </li>

                {{-- NAV LINKS --}}
                <li class="nav-item">
                    <a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('beranda') }}">
                        {{ tr('Beranda') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('paket') }}">
                        {{ tr('Paket Tour') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('stay') }}">
                        {{ tr('Paket Stay') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('layanan_taxi') }}">
                        {{ tr('Layanan Taxi') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('rental_mobil') }}">
                        {{ tr('Rental Mobil') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/{{ app()->getLocale() }}#{{ section_id('tentang_kami') }}">
                        {{ tr('Tentang Kami') }}
                    </a>
                </li>

                {{-- CTA --}}
                <li class="nav-item ms-lg-3">
                    <a href="https://wa.me/628136814512?text={{ urlencode(tr('Hi, I want to book a tour')) }}"
                       class="btn btn-primary-custom">
                        {{ tr('Hubungi Kami') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
