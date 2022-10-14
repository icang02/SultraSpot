<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sultraspot | Home</title>

  <link rel="apple-touch-icon" sizes="180x180" href="{{ url('frontend') }}/assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32"
    href="{{ url('frontend') }}/assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16"
    href="{{ url('frontend') }}/assets/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend') }}/assets/img/favicons/favicon.ico">
  <link rel="manifest" href="{{ url('frontend') }}/assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="{{ url('frontend') }}/assets/img/favicons/mstile-150x150.png">
  <meta name="theme-color" content="#ffffff">

  <link href="{{ url('frontend') }}/vendors/plyr/plyr.css" rel="stylesheet">
  <link href="{{ url('frontend') }}/assets/css/theme.css" rel="stylesheet" />

</head>

<body>

  <main class="main" id="top">
    {{-- Navbar --}}
    @include('components.home.navbar')
    {{-- End Navbar --}}

    {{-- Hero Section --}}
    @include('components.home.hero')
    {{-- End Hero --}}

    {{-- Places Section --}}
    @include('components.home.places')
    {{-- End Places --}}

    {{-- Videos Section --}}
    @include('components.home.videos')
    {{-- End Videos --}}

    {{-- Videos Section --}}
    @include('components.home.travel')
    {{-- End Videos --}}

    {{-- Experiences Section --}}
    @include('components.home.experiences')
    {{-- End Experiences --}}

    {{-- Experiences Section --}}
    @include('components.home.booking')
    {{-- End Experiences --}}

    {{-- Footer --}}
    @include('components.home.footer')
    {{-- End Footer --}}


  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->




  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="{{ url('frontend') }}/vendors/@popperjs/popper.min.js"></script>
  <script src="{{ url('frontend') }}/vendors/bootstrap/bootstrap.min.js"></script>
  <script src="{{ url('frontend') }}/vendors/is/is.min.js"></script>
  <script src="{{ url('frontend') }}/vendors/plyr/plyr.polyfilled.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="{{ url('frontend') }}/assets/js/theme.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap"
    rel="stylesheet">
</body>

</html>
