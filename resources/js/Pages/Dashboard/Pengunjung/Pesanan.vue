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
                <td>{{ order.tour_place_id }}</td>
                <td>{{ order.total_payment }}</td>
                <td>
                  <span
                    class="badge bg-label-warning me-1"
                    v-if="order.status == 'pending'"
                    >Pending</span
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
                  <button class="btn btn-sm btn-primary">Lihat</button>
                  <button
                    v-if="order.status == 'selesai' || order.status == 'gagal'"
                    class="btn btn-sm btn-danger ms-1"
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
    return {};
  },

  props: {
    orders: Object,
  },
};
</script>
