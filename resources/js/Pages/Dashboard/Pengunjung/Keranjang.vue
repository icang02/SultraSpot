<template>
  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Transaksi /</span>
        Keranjang
      </h4>

      <div v-if="carts.length > 0" class="card">
        <h5 class="card-header">Tabel Keranjang</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>No.</th>
                <th>Nama Tempat</th>
                <th>Jumlah Tiket</th>
                <th>Harga</th>
                <th class="text-center">Sewa Kamera</th>
                <th class="text-center">Total</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <tr v-for="(cart, index) in carts" :key="index">
                <td>
                  <input
                    type="checkbox"
                    class="form-check-input checkboxone"
                    :value="cart.id"
                    @click="onlyOne(this)"
                  />
                </td>
                <td>
                  <i class="fab fa-angular fa-lg text-danger me-3"></i>
                  <strong>{{ index + 1 }}.</strong>
                </td>
                <td>{{ cart.tour_place.name }}</td>
                <td>
                  <input
                    style="width: 50px; text-align: center"
                    type="text"
                    readonly
                    :value="cart.quantity"
                    class="form-control"
                  />
                </td>
                <td>{{ cart.tour_place.price }}</td>
                <td class="text-center">
                  {{ cart.price_kamera != 0 ? cart.price_kamera : "-" }}
                </td>
                <td class="text-end">{{ cart.total_payment }}</td>
                <td>
                  <button
                    @click="getEdit(index)"
                    class="btn btn-sm btn-primary me-1"
                    data-bs-toggle="modal"
                    data-bs-target="#smallModal"
                  >
                    <i class="bx bx-edit"></i>
                  </button>

                  <Link
                    @click="deleteCart(cart.id)"
                    as="button"
                    class="btn btn-sm btn-danger"
                  >
                    <i class="bx bx-message-square-x"></i>
                  </Link>
                </td>
              </tr>
              <tr>
                <td colspan="7"></td>
                <td>
                  <form @submit.prevent="checkout()" class="d-inline">
                    <button type="submit" class="btn btn-info">Continue</button>
                  </form>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <h4 v-else class="text-light text-center">Keranjang masih kosong</h4>

      <hr class="my-5" />
    </div>

    <!-- Modal Form Edit -->
    <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <form @submit.prevent="updateCart(cart_edit.id)">
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
                  <label class="form-label" for="quantity"
                    >Atur Jumlah Tiket</label
                  >
                  <input
                    type="number"
                    min="1"
                    :max="cart_edit.tour_place.ticket_stock"
                    class="form-control"
                    name="quantity"
                    id="quantity"
                    v-model="cart_edit.quantity"
                  />

                  <div
                    class="form-check mt-2"
                    v-if="cart_edit.tour_place.rental"
                  >
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="rental"
                      id="checkbox"
                      :checked="cart_edit.price_kamera != 0"
                    />
                    <label class="form-check-label" for="checkbox">
                      Tambah <span class="fw-bold">Rp 50.000</span> untuk sewa
                      kamera
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-outline-secondary"
                data-bs-dismiss="modal"
                @click="test()"
              >
                Kembali
              </button>

              <button
                type="submit"
                class="btn btn-primary"
                :disabled="disabled"
              >
                <div
                  v-show="loading"
                  class="spinner-border spinner-border-sm text-light me-1"
                  role="status"
                >
                  <span class="visually-hidden">Loading...</span>
                </div>
                Ubah
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </Layout>
</template>


<script>
import Layout from "../Shared/Template.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    Layout,
    Link,
  },

  props: {
    carts: Object,
  },

  data() {
    return {
      loading: false,
      disabled: false,
      cart_edit: useForm({
        quantity: null,
        tour_place: {},
      }),
    };
  },

  methods: {
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

    updateCart(id) {
      this.loading = true;
      this.disabled = true;
      const data = {
        id: id,
        quantity: this.cart_edit.quantity,
        sewaKamera: null,
      };

      let checkbox = document.getElementById("checkbox");
      if (checkbox) {
        if (checkbox.checked == true) {
          data.sewaKamera = true;
        } else {
          data.sewaKamera = false;
        }
      }

      // console.log(data);

      Inertia.patch("update-carts/" + id, data, {
        preserveScroll: true,
        onSuccess: () => (
          (this.disabled = false),
          (this.loading = false),
          this.toast("success", "Keranjang updated")
        ),
      });
    },

    deleteCart(cart_id) {
      Inertia.delete("destroy-carts/" + cart_id, {
        preserveScroll: true,
        onSuccess: () => this.toast("error", "Item dihapus dari keranjang."),
      });
    },

    sumTotalCarts() {
      let total = 0;
      for (let i = 0; i < this.carts.length; i++) {
        total += this.carts[i].total_payment;
      }
      return total;
    },

    allQyt() {
      let qyt = [];
      for (let i = 0; i < this.carts.length; i++) {
        qyt.push(this.carts[i].quantity);
      }
      return qyt;
    },

    getEdit(index) {
      this.cart_edit = this.carts[index];
    },

    onlyOne() {
      $(".checkboxone").on("change", function () {
        $(".checkboxone").not(this).prop("checked", false);
      });
    },

    checkout() {
      const btn = document.querySelectorAll(".checkboxone");

      let itemsAvailable = false;
      let id_cart = null;

      btn.forEach((item) => {
        if (item.checked == true) {
          itemsAvailable = true;
          id_cart = item.value;
        }
      });

      if (itemsAvailable) {
        Inertia.get("checkout/" + id_cart);
      } else {
        this.toast("info", "Pilih salah satu item.");
      }
    },
  },
};
</script>
