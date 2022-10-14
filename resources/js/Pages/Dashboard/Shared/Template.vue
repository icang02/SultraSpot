<template>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <Sidebar />
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page pb-md-0" id="pembungkus-nav">
        <!-- Navbar -->
        <Navbar />
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper" style="position: relative">
          <!-- Content -->
          <slot />
          <!-- / Content -->

          <!-- Footer -->
          <Footer />
          <!-- / Footer -->

          <nav
            id="nav-mobile"
            class="navbar navbar-example navbar-expand-lg navbar-light shadow"
          >
            <div class="container-fluid">
              <Link :href="route('dashboard')" class="navbar-brand"
                >SultraSpot</Link
              >
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbar-ex-2"
                aria-controls="navbar-ex-2"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbar-ex-2">
                <div class="navbar-nav me-auto">
                  <hr />
                  <Link
                    class="nav-item nav-link"
                    :class="{ active: $page.url.startsWith('/list-wisata') }"
                    :href="route('list-wisata')"
                    >Wisata
                  </Link>
                  <Link class="nav-item nav-link" :href="route('dashboard')"
                    >Event
                  </Link>
                  <hr />
                  <Link
                    class="nav-item nav-link"
                    :class="{ active: $page.url.startsWith('/carts') }"
                    :href="route('carts')"
                    >Keranjang
                  </Link>
                  <Link
                    class="nav-item nav-link"
                    :class="{ active: $page.url.startsWith('/pesanan') }"
                    :href="route('pesanan')"
                    >Pesanan
                  </Link>
                  <Link class="nav-item nav-link" href="#">Riwayat</Link>
                  <hr />
                </div>
              </div>
            </div>
          </nav>

          <div class="content-backdrop fade"></div>
        </div>

        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
</template>

<script>
import Sidebar from "../../Components/Sidebar.vue";
import Navbar from "../../Components/Navbar.vue";
import Footer from "../../Components/Footer.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Sidebar,
    Navbar,
    Footer,
    Link,
  },
};
</script>