<template>
  <section class="py-0">
    <div
      class="bg-holder d-none d-md-block"
      :style="`background-image:url(${base}/frontend/assets/img/illustrations/hero.png);background-position:right bottom;background-size:contain;`"
    ></div>
    <!--/.bg-holder-->

    <div class="container position-relative">
      <div class="row align-items-center min-vh-75 my-lg-8">
        <div class="col-md-7 col-lg-6 text-center text-md-start py-8">
          <h1 class="mb-4 display-1 lh-sm">
            Travel around <br class="d-block d-lg-none d-xl-block" />the world
          </h1>
          <p class="mt-4 mb-5 fs-1 lh-base">
            Plan and book your perfect trip with expert advice,
            <br class="d-none d-lg-block" />travel tips, destination information
            and <br class="d-none d-lg-block" />inspiration from us.
          </p>

          <a
            v-if="data_global"
            class="btn btn-lg btn-primary hover-top"
            href="#places"
          >
            Get Started
          </a>

          <Link
            v-else
            class="btn btn-lg btn-primary hover-top"
            :href="route('register')"
            role="button"
          >
            Sign Up Now
          </Link>
        </div>
      </div>
    </div>
  </section>
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
