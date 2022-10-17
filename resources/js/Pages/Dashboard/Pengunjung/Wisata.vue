<template>
  <Head title="SultraSpot | Wisata" />
  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Wisata & Event /</span>
        Wisata
      </h4>

      <div
        class="row mb-4 px-md-4 px-1 justify-content-center"
        v-if="allWisata.length != 0"
      >
        <div class="col-md-6 mb-2" v-for="wisata in allWisata" :key="wisata.id">
          <Link
            :href="`list-wisata/${wisata.id}`"
            class="card mb-3 cursor-pointer shadow"
          >
            <div class="row g-0">
              <div class="col-md-4">
                <img
                  class="card-img card-img-left"
                  :src="`${base}/assets/img/wisata/thumb/${wisata.image}`"
                  alt="Card image"
                  width="1000"
                />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ wisata.name }}</h5>
                  <p class="card-text">
                    <i class="bx bxs-map"></i> {{ wisata.address }}
                  </p>
                  <p class="card-text">
                    <small class="text-muted"> {{ wisata.city }} </small>
                  </p>
                </div>
              </div>
            </div>
          </Link>
        </div>
      </div>

      <div v-else>
        <h4 class="text-light text-center">Belum ada daftar wisata</h4>
      </div>

      <hr class="my-5" />
    </div>
  </Layout>
</template>

<script>
import Layout from "../Shared/Template.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Layout,
    Link,
    Head,
  },

  data() {
    return {
      base: window.location.origin,
    };
  },

  props: {
    allWisata: Object,
  },
};
</script>
