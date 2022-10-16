<template>
  <Head title="SultraSpot | Detail Wisata" />
  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Wisata & Event /</span>
        Wisata
      </h4>

      <div class="row px-md-4 px-1">
        <div class="col-md-7 mb-md-0 mb-4">
          <div class="card">
            <h5 class="card-header">{{ wisata.name }}</h5>
            <div class="card-body">
              <h6 class="text-light">
                <i class="bx bx-map me-2"></i> {{ wisata.address }}
              </h6>
              <hr class="my-3" />
              <img
                class="img-fluid"
                src="https://source.unsplash.com/900x500?nature"
                alt="Image"
              />
              <div class="mt-3">
                {{ wisata.description }}
              </div>
              <hr class="my-4" />

              <form @submit.prevent="addCart(wisata.id)">
                <div class="mb-3">
                  <div class="form-label">Jumlah Tiket</div>
                  <input
                    v-model="form.quantity"
                    min="1"
                    :max="wisata.ticket_stock"
                    type="number"
                    class="form-control"
                    name="qty"
                    id="quantity"
                    :disabled="wisata.ticket_stock == 0"
                    required
                  />
                </div>

                <div class="form-check" v-if="wisata.rental">
                  <input
                    v-model="form.rental"
                    class="form-check-input"
                    type="checkbox"
                    name="rental"
                    id="rental"
                    :disabled="wisata.ticket_stock == 0"
                  />
                  <label class="form-check-label" for="rental">
                    Tambah <span class="fw-bold">Rp 50.000</span> untuk sewa
                    kamera
                  </label>
                </div>

                <div class="mt-4">
                  <div
                    as="button"
                    @click="orderNow(wisata.id, form.quantity)"
                    class="btn btn-info me-1"
                    :class="{ disabled: wisata.ticket_stock == 0 }"
                  >
                    <i class="bx bx-right-arrow me-1"></i> Pesan
                  </div>
                  <button
                    class="btn btn-warning"
                    :disabled="disabled || wisata.ticket_stock == 0"
                  >
                    <i class="bx bxs-cart-add me-1"></i> Simpan
                  </button>
                </div>
              </form>
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
                src="https://source.unsplash.com/900x550?road-map"
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
                <div class="col-md-1">
                  <i class="bx bxs-map"></i>
                </div>
                <div class="col-md-11">
                  <div class="fw-bold">ALAMAT</div>
                  {{ wisata.address }}
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-1">
                  <i class="bx bxs-phone"></i>
                </div>
                <div class="col-md-11">
                  <div class="fw-bold">TELEPON</div>
                  {{ wisata.telp }}
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-1">
                  <i class="bx bxs-purchase-tag-alt"></i>
                </div>
                <div class="col-md-11">
                  <div class="fw-bold">HARGA TIKET</div>
                  {{ wisata.price }}
                </div>
              </div>
              <div class="row">
                <div class="col-md-1">
                  <i class="bx bxs-plane-take-off"></i>
                </div>
                <div class="col-md-11">
                  <div class="fw-bold">STOK</div>
                  <span v-if="wisata.ticket_stock > 0">
                    {{ wisata.ticket_stock }}
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
import Layout from "../Shared/Template.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import { Inertia } from "@inertiajs/inertia";

export default {
  data() {
    return {
      loading: false,
      disabled: false,
      form: useForm({
        id: null,
        quantity: null,
        rental: null,
      }),
    };
  },

  components: {
    Layout,
    Link,
    Head,
  },

  props: {
    wisata: Object,
  },

  methods: {
    addCart(id_place) {
      console.log(id_place);

      this.disabled = true;
      this.loading = true;

      this.form.id = id_place;
      Inertia.post("/add-carts/" + id_place, this.form, {
        preserveScroll: true,
        onSuccess: () => (
          (this.disabled = false),
          (this.loading = false),
          this.toast("success", "Item ditambahkan ke keranjang.")
        ),
      });
    },

    orderNow(id_place, qty) {
      console.log(id_place);

      const data = {
        qty: qty,
        sewaKamera: this.form.rental,
      };

      if (qty == null || qty < 1) {
        return this.toast("error", "Jumlah tiket tidak boleh kosong.");
      } else if (qty > this.wisata.ticket_stock) {
        return this.toast("error", "Jumlah tiket melebihi stok.");
      }

      Inertia.get(route("order", id_place), data);
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
};
</script>
