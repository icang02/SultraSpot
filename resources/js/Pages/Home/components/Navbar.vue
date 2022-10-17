<template>
  <nav
    class="navbar navbar-expand-lg fixed-top py-3 backdrop nav-home"
    data-navbar-on-scroll="data-navbar-on-scroll"
  >
    <div class="container">
      <a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="#">
        <img
          class="d-inline-block align-top img-fluid"
          :src="`${base}/frontend/assets/img/gallery/logo-icon.png`"
          alt=""
          width="50"
        /><span class="text-primary fs-4 ps-2">SultraSpot</span></a
      >
      <button
        class="navbar-toggler collapsed"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0"
        id="navbarSupportedContent"
      >
        <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-600" href="#featuresVideos">Video</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-600" href="#places">Destinations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-600" href="#booking">Booking </a>
          </li>
        </ul>

        <div v-if="!data_global" class="ps-lg-5">
          <Link
            class="btn btn-lg btn-outline-primary order-0"
            :href="route('login')"
          >
            Sign In
          </Link>
        </div>

        <div v-if="data_global" class="ps-lg-5 me-3">
          <Link
            class="btn btn-lg btn-primary order-0"
            :href="route('dashboard')"
            >Dashboard
          </Link>
        </div>

        <Link
          v-if="data_global"
          as="button"
          method="post"
          :href="route('logout')"
          class="btn btn-lg btn-outline-primary order-0"
          >Logout</Link
        >
      </div>
    </div>
  </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },

  setup() {
    const data_global = computed(() => usePage().props.value.data_global);
    return { data_global };
  },

  data() {
    return {
      base: window.location.origin,
    };
  },
};
</script>
