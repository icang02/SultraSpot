<template>
  <div class="container-xxl container-p-y d-flex justify-content-center">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2">Page Not Found :(</h2>
      <p class="mb-4 mx-2">
        Oops! 😖 The requested URL was not found on this server.
      </p>

      <a :href="route('dashboard')" class="btn btn-primary"
        >Back to dashboard</a
      >

      <div class="mt-3">
        <img
          :src="`${base}/assets/img/illustrations/page-misc-error-light.png`"
          alt="page-misc-error-light"
          width="500"
          class="img-fluid"
          data-app-dark-img="illustrations/page-misc-error-dark.png"
          data-app-light-img="illustrations/page-misc-error-light.png"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
// import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    Link,
  },

  data() {
    return {
      base: window.location.origin,
    };
  },
};
</script>
