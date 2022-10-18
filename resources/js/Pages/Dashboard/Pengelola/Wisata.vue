<template>
  <Head title="SultraSpot | User" />

  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Wisata & Event /</span>
        {{ data_global[2] == "pengelola" ? "My Wisata" : title }}
      </h4>

      <div class="row px-md-4 px-1">
        <div class="col" v-if="allWisata == null">
          <Link :href="route('wisata.add')" class="btn btn-primary mb-3"
            >Tambah</Link
          >
        </div>

        <div class="col" v-else>
          <Link :href="route('wisata.add')" class="btn btn-primary mb-3"
            >Edit</Link
          >
        </div>
      </div>

      <div v-if="allWisata == null">
        <h4 class="text-light text-center">Belum ada data wisata :)</h4>
      </div>

      <div class="row px-md-4 px-1" v-else>
        <div class="col-md-7 mb-md-0 mb-4">
          <div class="card">
            <h5 class="card-header">{{ allWisata.name }}</h5>
            <div class="card-body">
              <h6 class="text-light">
                <i class="bx bx-map me-2"></i> {{ allWisata.address }}
              </h6>
              <hr class="my-3" />
              <img
                class="img-fluid"
                :src="`${base}/assets/img/wisata/${allWisata.image}`"
                alt="Image"
              />
              <div class="mt-3">
                {{ allWisata.description }}
              </div>
              <hr class="my-4" />
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <h5><i class="bx bxs-map-pin me-1"></i> MAPS</h5>
              <hr />
              <img
                class="img-fluid"
                :src="`${base}/assets/img/maps/maps.png`"
                alt="Image"
              />
              <div class="d-grid mt-2">
                <a
                  href="https://maps.app.goo.gl/5EaJD4pvZyY81AfS6"
                  target="_blank"
                  class="btn btn-primary"
                  ><i class="bx bx-paper-plane me-1"></i> Open Direction</a
                >
              </div>
              <hr class="my-3" />
              <div class="row mb-3">
                <div class="col-md-1 col-1">
                  <i class="bx bxs-map"></i>
                </div>
                <div class="col-md-11 col-11">
                  <div class="fw-bold">ALAMAT</div>
                  {{ allWisata.address }}
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-1 col-1">
                  <i class="bx bxs-phone"></i>
                </div>
                <div class="col-md-11 col-11">
                  <div class="fw-bold">TELEPON</div>
                  {{ allWisata.telp }}
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-1 col-1">
                  <i class="bx bxs-purchase-tag-alt"></i>
                </div>
                <div class="col-md-11 col-11">
                  <div class="fw-bold">HARGA TIKET</div>
                  {{ allWisata.price }}
                </div>
              </div>
              <div class="row">
                <div class="col-md-1 col-1">
                  <i class="bx bxs-plane-take-off"></i>
                </div>
                <div class="col-md-11 col-11">
                  <div class="fw-bold">STOK</div>
                  <span v-if="allWisata.ticket_stock > 0">
                    {{ allWisata.ticket_stock }}
                  </span>
                  <span v-else class="text-danger">Kosong</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-5" />
    </div>
  </Layout>
</template>

<script>
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import Layout from "../Shared/Template.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { useToast } from "vue-toastification";
import Swal from "sweetalert2";

export default {
  components: {
    Layout,
    Link,
    Head,
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

  methods: {
    deleteUser(username, name) {
      Swal.fire({
        title: "Hapus user?",
        text: `Akun tidak dapat dikembalikan setelah dihapus!`,
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Tidak",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.delete(`${this.base}/users/${username}`, {
            preserveScroll: true,
            onSuccess: () =>
              Swal.fire("Sukses!", `Akun ${name} berhasil dihapus.`, "success"),
          });
        }
      });
    },

    toast(color, msg) {
      const toast = useToast();

      if (color == "success") {
        toast.success(msg);
      } else if (color == "error") {
        toast.error(msg);
      } else if (color == "info") {
        toast.info(msg);
      }
    },
  },

  props: {
    title: String,
    allWisata: Object,
  },
};
</script>
