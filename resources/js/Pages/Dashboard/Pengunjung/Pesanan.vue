<template>
  <Head title="SultraSpot | Pesanan" />

  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Transaksi /</span>
        Pesanan
      </h4>

      <div class="card" v-if="orders.length != 0">
        <h5 class="card-header">Tabel Pesanan</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>No. Pesanan</th>
                <th>Tempat Wisata</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <tr v-for="order in orders" :key="order.id">
                <td>
                  <i class="fab fa-angular fa-lg text-danger me-3"></i>
                  <strong>{{ order.no_order }}</strong>
                </td>
                <td>{{ order.tour_place.name }}</td>
                <td>Rp {{ order.total_payment }}</td>
                <td>
                  <span
                    class="badge bg-label-warning me-1"
                    v-if="order.status == 'pending'"
                    >Proses</span
                  >
                  <span
                    class="badge bg-label-success me-1"
                    v-if="order.status == 'selesai'"
                    >Selesai</span
                  >
                  <span
                    class="badge bg-label-danger me-1"
                    v-if="order.status == 'gagal'"
                    >Gagal</span
                  >
                </td>
                <td>
                  <Link
                    :href="route('pesanan.show', order.id)"
                    v-if="
                      data_global[2] == 'pengunjung' ||
                      data_global[2] == 'pengelola'
                    "
                    class="btn btn-sm btn-primary me-1"
                  >
                    Detail
                  </Link>

                  <button
                    @click="OrderConfirm(order.id)"
                    class="btn btn-sm btn-success me-1"
                    v-if="
                      data_global[2] == 'pengelola' && order.status == 'pending'
                    "
                  >
                    Konfirmasi
                  </button>
                  <button
                    @click="OrderConfirmCancel(order.id)"
                    class="btn btn-sm btn-warning me-1"
                    v-if="
                      data_global[2] == 'pengelola' && order.status == 'pending'
                    "
                  >
                    Batalkan
                  </button>

                  <button
                    v-if="order.image_tf"
                    data-bs-toggle="modal"
                    :data-bs-target="`#basicModal${order.id}`"
                    class="btn btn-sm btn-info me-1"
                  >
                    Bukti Transfer
                  </button>

                  <button
                    @click="orderDelete(order.id)"
                    class="btn btn-sm btn-danger"
                    v-if="
                      (data_global[2] == 'pengelola' ||
                        data_global[2] == 'pengunjung') &&
                      (order.status == 'selesai' || order.status == 'gagal')
                    "
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div v-else>
        <h4 class="text-light text-center">Belum ada transaksi</h4>
      </div>

      <hr class="my-5" />
    </div>

    <!-- Modal Form Edit -->
    <div
      class="modal fade"
      :id="`basicModal${order.id}`"
      tabindex="-1"
      aria-hidden="true"
      v-for="order in orders"
      :key="order.id"
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
                <img
                  :src="`img/bukti-tf/${order.image_tf}`"
                  class="img-fluid"
                />
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
  </Layout>
</template>

<script>
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import Layout from "../Shared/Template.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { useToast } from "vue-toastification";

export default {
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
    OrderConfirm(id_order) {
      console.log("id order : " + id_order);
      const data = {
        status: "selesai",
      };

      Inertia.post(`order-confirmation/${id_order}`, data, {
        preserveScroll: true,
        onSuccess: () =>
          this.toast("success", "Pesanan berhasil dikonfirmasi."),
      });
    },

    OrderConfirmCancel(id_order) {
      console.log("id order : " + id_order);
      const data = {
        status: "gagal",
      };

      Inertia.post(`order-confirmation/${id_order}`, data, {
        preserveScroll: true,
        onSuccess: () => this.toast("error", "Pesanan dibatalkan."),
      });
    },

    orderDelete(id_order) {
      console.log(id_order);

      Inertia.delete(`order-delete/${id_order}`, {
        preserveScroll: true,
        onSuccess: () => this.toast("error", "Pesanan dihapus."),
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

  components: {
    Layout,
    Link,
    Head,
  },

  data() {
    return {};
  },

  props: {
    orders: Object,
  },
};
</script>
