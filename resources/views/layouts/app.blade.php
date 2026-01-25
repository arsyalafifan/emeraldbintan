<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="{{ $seo['description'] ?? 'Bintan tour, staycation, taxi and car rental service' }}">
    
    <meta name="keywords" content="paket wisata bintan, tour bintan, travel bintan, sewa mobil bintan, wisata lagoi, emerald bintan, bintan tour, taxi bintan, car rental bintan, bintan travel agent">

    <meta name="author" content="Emerald Bintan">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Liburan ke Bintan? Emerald Bintan Solusinya!" />
    <meta property="og:description" content="Dapatkan paket tour Bintan lengkap mulai dari Rp 500rb. Klik untuk info detail." />
    <meta property="og:image" content="https://kabarsdgs.com/wp-content/uploads/2025/04/pantai-trikora-profile1695024664.jpg" /> <meta property="og:url" content="https://website-anda.com" />
    <meta property="og:type" content="website" />

    <link rel="alternate" hreflang="id" href="{{ url('id') }}">
    <link rel="alternate" hreflang="en" href="{{ url('en') }}">
    <link rel="alternate" hreflang="x-default" href="https://emeraldbintan.com/{{ app()->getLocale() }}">

    <link rel="canonical" href="{{ url()->current() }}">
    {{-- <link rel="canonical" href="https://emeraldbintan.com/id"> --}}

    <link rel="icon" href="{{ asset('frontend/images/emerald-bintan-logo.png') }}" type="image/png" />
    <link rel="shortcut icon" href="{{ asset('frontend/images/emerald-bintan-logo.png') }}">

    <link rel="apple-touch-icon" href="{{ asset('frontend/images/emerald-bintan-logo.png') }}">


    <title>@yield('title')</title>

    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
    
  </head>
  <body>
    @include('includes.navbar')    
    @yield('content')
    @include('includes.footer')    

    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')

    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "TravelAgency",
        "name": "Emerald Bintan Travel",
        "url": "https://emeraldbintan.com",
        "areaServed": "Bintan Island",
        "telephone": "+62-822-8432-7726",
        "sameAs": [
          "https://www.instagram.com/...",
          "https://www.facebook.com/..."
        ]
      }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [{
        "@type": "Question",
        "name": "How much is taxi service in Bintan?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Taxi prices in Bintan start from IDR 150K depending on destination and vehicle type."
        }
      },
      {
        "@type": "Question",
        "name": "Do you provide airport transfer in Bintan?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Yes, we provide private airport and ferry terminal transfer services across Bintan Island."
        }
      }]
    }
    </script>
  </body>
</html>