<template>
  <Head title="SultraSpot | Detail Wisata" />
  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Transaksi / Pesanan / </span>
        Detail
      </h4>

      <div class="row px-md-4 px-1">
        <div class="col-md-7 mb-md-0 mb-4">
          <div class="card">
            <h5 class="card-header">No. Pesanan : {{ order.no_order }}</h5>
            <div class="card-body">
              <img
                :src="`${base}/assets/img/wisata/${order.tour_place.image}`"
                alt="Image"
                class="img-fluid"
              />

              <div class="row mt-4">
                <div class="col-md-6 col-6">
                  <div>
                    <h6 class="fw-bold">Nama Pemesan</h6>
                    <p>{{ order.user.name }}</p>
                  </div>
                  <div>
                    <h6 class="fw-bold">Harga Tiket</h6>
                    <p>Rp {{ order.tour_place.price }}</p>
                  </div>
                  <div>
                    <h6 class="fw-bold">Total</h6>
                    <p>Rp {{ order.total_payment }}</p>
                  </div>
                </div>

                <div class="col-md-6 col-6">
                  <div>
                    <h6 class="fw-bold">Tujuan Wisata</h6>
                    <p>{{ order.tour_place.name }}</p>
                  </div>
                  <div>
                    <h6 class="fw-bold">Jumlah Tiket</h6>
                    <p>{{ order.quantity }}</p>
                  </div>
                  <div>
                    <h6 class="fw-bold">Tanggal Pemesanan</h6>
                    <p>{{ date_order }}</p>
                  </div>
                </div>
              </div>

              <hr class="mb-4" />

              <form
                @submit.prevent="uploadImage(order.id)"
                v-if="order.image_tf == 'nota.jpg'"
              >
                <h6 class="fw-bold">Upload Bukti Transfer</h6>
                <div class="input-group mt-3">
                  <input
                    type="file"
                    class="form-control"
                    :class="{ 'is-invalid': errors.image }"
                    @input="form.image = $event.target.files[0]"
                    accept="image/jpg, image/jpeg, image/png"
                  />
                  <button class="btn btn-outline-primary" type="submit">
                    Kirim
                  </button>

                  <div class="invalid-feedback">
                    {{ errors.image }}
                  </div>
                </div>
              </form>

              <div v-else>
                <h6 class="fw-bold">Bukti Transfer</h6>
                <button
                  data-bs-toggle="modal"
                  :data-bs-target="`#basicModal${order.id}`"
                  class="btn btn-primary"
                >
                  Lihat
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-5" />

      <!-- Modal Form Edit -->
      <div
        class="modal fade"
        :id="`basicModal${order.id}`"
        tabindex="-1"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-basic" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2"></h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div class="row g-2">
                <div class="col mb-0">
                  <img :src="order.image_tf" class="img-fluid" />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-outline-secondary"
                data-bs-dismiss="modal"
              >
                Kembali
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import Layout from "../Shared/Template.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";
// https://source.unsplash.com/900x500?nature

export default {
  setup() {
    const data_global = computed(() => usePage().props.value.data_global);
    return { data_global };
  },

  data() {
    return {
      base: window.location.origin,
      loading: false,
      disabled: false,
      form: useForm({
        image: null,
      }),
    };
  },

  components: {
    Layout,
    Link,
    Head,
  },

  props: {
    order: Object,
    errors: Object,
    date_order: String,
  },

  methods: {
    uploadImage(id_order) {
      Inertia.post(route("upload.bukti.tf", id_order), this.form, {
        onSuccess: () => Swal.fire("Sukses!", `Upload berhasil.`, "success"),
      });
    },
  },
};
</script>
