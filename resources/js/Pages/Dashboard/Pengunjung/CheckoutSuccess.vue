<template>
  <Head title="SultraSpot | Checkout Success" />
  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y text-center mt-3">
      <div class="misc-wrapper">
        <h2 class="mb-2 mx-2">Pesanan berhasil dibuat!</h2>
        <p class="mb-4 mx-2">
          Silahkan menunggu. Pesanan Anda sementara diproses.
        </p>
        <Link :href="route('pesanan')" class="btn btn-primary">
          Lihat pesanan
        </Link>
        <div class="mt-4">
          <img
            :src="illustrations"
            alt="girl-doing-yoga-light"
            width="500"
            class="img-fluid"
            data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
            data-app-light-img="illustrations/girl-doing-yoga-light.png"
          />
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import Layout from "../Shared/Template.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import illustrations from "../../../../img/illustrations/girl-doing-yoga-light.png";

export default {
  components: {
    Layout,
    Link,
    Head,
  },

  data() {
    return {
      illustrations,
    };
  },
};
</script>