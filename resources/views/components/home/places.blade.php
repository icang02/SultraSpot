<section id="places">

  <div class="container">
    <div class="row flex-md-center">
      <div class="col-md-11 col-lg-4 py-md-3 px-4 px-md-3 px-lg-0 px-xl-2 order-lg-1">
        <h1 class="fw-bold fs-md-3 fs-xl-5">Amazing places to enjoy your travel</h1>
        <hr class="text-primary my-4 my-lg-3 my-xl-4" style="height:3px; width:70px;" />
        <p class="lh-lg">Etiam facilisis, sapien quis porta dignissim, orci nisi pharetra dui, varius vehicula
          ligula nulla sit amet lorem. Aenean in vestibulum quam. Cras commodo varius neque, non gravida diam
          ultrices nec. Cras nulla mauris, fermentum nec libero in.</p>

        @auth
          <a class="btn btn-lg btn-primary hover-top" href="{{ url('dashboard') }}">Explore</a>
        @endauth

        @guest
          <a class="btn btn-lg btn-primary hover-top" href="{{ url('login') }}">Explore</a>
        @endguest

      </div>
      <div class="col-lg-8 order-lg-0 order-1 px-4 px-md-3 py-8 py-md-3">
        <div class="carousel slide" id="carouselExampleControlsNoTouching" data-bs-touch="false"
          data-bs-interval="false">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row h-100">
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="card h-100 text-white hover-top"><img class="img-fluid h-100"
                      src="{{ url('frontend') }}/assets/img/gallery/maldives.png" alt="" />
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">$860</span></div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">Maldives</h5>
                        <h6 class="text-600">3 days</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="card h-100 text-white hover-top"><img class="img-fluid h-100"
                      src="{{ url('frontend') }}/assets/img/gallery/indonesia.png" alt="" />
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">$860</span></div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">Indonesia</h5>
                        <h6 class="text-600">7 days</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="card h-100 text-white hover-top"><img class="img-fluid h-100"
                      src="{{ url('frontend') }}/assets/img/gallery/kathmandu.png" alt="" />
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">$340</span></div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">Kathmandu</h5>
                        <h6 class="text-600">5 days</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row h-100">
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="card h-100 text-white hover-top"><img class="img-fluid h-100"
                      src="{{ url('frontend') }}/assets/img/gallery/maldives.png" alt="" />
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">$340</span></div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">Maldives</h5>
                        <h6 class="text-600">5 days</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="card h-100 text-white hover-top"><img class="img-fluid h-100"
                      src="{{ url('frontend') }}/assets/img/gallery/indonesia.png" alt="" />
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">$540</span></div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">Indonesia</h5>
                        <h6 class="text-600">5 days</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="card h-100 text-white hover-top"><img class="img-fluid h-100"
                      src="{{ url('frontend') }}/assets/img/gallery/kathmandu.png" alt="" />
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">$640</span></div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">Kathmandu</h5>
                        <h6 class="text-600">6 days</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row h-100">
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="card h-100 text-white hover-top"><img class="img-fluid h-100"
                      src="{{ url('frontend') }}/assets/img/gallery/kathmandu.png" alt="" />
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">$540</span></div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">Kathmandu</h5>
                        <h6 class="text-600">5 days</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="card h-100 text-white hover-top"><img class="img-fluid h-100"
                      src="{{ url('frontend') }}/assets/img/gallery/maldives.png" alt="" />
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">$860</span></div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">Maldives</h5>
                        <h6 class="text-600">3 days</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="card h-100 text-white hover-top"><img class="img-fluid h-100"
                      src="{{ url('frontend') }}/assets/img/gallery/indonesia.png" alt="" />
                    <div class="card-img-overlay ps-0 d-flex flex-column justify-content-between bg-dark-gradient">
                      <div class="pt-3"><span class="badge bg-primary">$860</span></div>
                      <div class="ps-3 d-flex justify-content-between align-items-center">
                        <h5 class="text-white">Indonesia</h5>
                        <h6 class="text-600">7 days</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="position-relative mt-5"><a class="carousel-control-prev carousel-icon z-index-2"
              href="#carouselExampleControlsNoTouching" role="button" data-bs-slide="prev"><span
                class="carousel-control-prev-icon" aria-hidden="true"></span><span
                class="visually-hidden">Previous</span></a><a class="carousel-control-next carousel-icon z-index-2"
              href="#carouselExampleControlsNoTouching" role="button" data-bs-slide="next"><span
                class="carousel-control-next-icon" aria-hidden="true"></span><span
                class="visually-hidden">Next</span></a></div>
        </div>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>
