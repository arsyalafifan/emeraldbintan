<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Agen tour travel Bintan terpercaya. Menyediakan paket wisata Lagoi Bay, Gurun Pasir, Snorkeling, dan sewa mobil Bintan dengan harga kompetitif. Booking sekarang!">
    
    <meta name="keywords" content="paket wisata bintan, tour bintan, travel bintan, sewa mobil bintan, wisata lagoi, emerald bintan">

    <meta name="author" content="Emerald Bintan">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Liburan ke Bintan? Emerald Bintan Solusinya!" />
    <meta property="og:description" content="Dapatkan paket tour Bintan lengkap mulai dari Rp 500rb. Klik untuk info detail." />
    <meta property="og:image" content="https://kabarsdgs.com/wp-content/uploads/2025/04/pantai-trikora-profile1695024664.jpg" /> <meta property="og:url" content="https://website-anda.com" />
    <meta property="og:type" content="website" />
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
  </body>
</html>