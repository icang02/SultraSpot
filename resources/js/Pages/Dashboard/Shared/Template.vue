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

          <!-- Muncul ditampilan Mobile -->
          <NavbarMobile />

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
import NavbarMobile from "../../Components/NavbarMobile.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Sidebar,
    Navbar,
    Footer,
    Link,
    NavbarMobile,
  },
};
</script>