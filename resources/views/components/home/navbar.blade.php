<nav class="navbar navbar-expand-lg fixed-top py-3 backdrop" data-navbar-on-scroll="data-navbar-on-scroll">
  <div class="container"><a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="#"> <img
        class="d-inline-block align-top img-fluid" src="{{ url('frontend') }}/assets/img/gallery/logo-icon.png"
        alt="" width="50" /><span class="text-primary fs-4 ps-2">SultraSpot</span></a>
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">

      <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link text-600" href="#featuresVideos">Video</a></li>
        <li class="nav-item"><a class="nav-link text-600" href="#places">Destinations</a></li>
        <li class="nav-item"><a class="nav-link text-600" href="#booking">Booking </a></li>
      </ul>


      @guest
        <div class="ps-lg-5">
          <a class="btn btn-lg btn-outline-primary order-0" href="{{ url('login') }}">Sign In</a>
        </div>
      @endguest

      @auth
        @can('admin')
          <div class="ps-lg-5">
            <a class="btn btn-lg btn-primary order-0" href="{{ url('dashboard') }}">Dashboard</a>
          </div>
        @endcan

        @can('admin')
          <form action="{{ url('logout') }}" method="POST" class="ps-lg-3">
          @endcan
          <form action="{{ url('logout') }}" method="POST" class="ps-lg-5">
            @csrf
            <button type="submit" class="btn btn-lg btn-outline-primary order-0">Logout</button>
          </form>
        @endauth
    </div>
  </div>
</nav>
