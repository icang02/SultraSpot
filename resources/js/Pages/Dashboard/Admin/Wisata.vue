<template>
  <Head title="SultraSpot | User" />

  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Wisata & Event /</span>
        {{ title }}
      </h4>

      <div class="card">
        <h5 class="card-header">Tabel Daftar Wisata</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Wisata</th>
                  <th>Kota</th>
                  <th>Harga Tiket</th>
                  <th>Stok</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(wisata, index) in allWisata" :key="index">
                  <td>
                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                    <strong>{{ index + 1 }}</strong>
                  </td>
                  <td>{{ wisata.name }}</td>
                  <td>{{ wisata.city }}</td>
                  <td>Rp {{ wisata.price }}</td>
                  <td>
                    <span v-if="wisata.ticket_stock < 1" class="text-danger">
                      Kosong
                    </span>
                    <span v-else>
                      {{ wisata.ticket_stock }}
                    </span>
                  </td>
                  <td>
                    <div class="btn btn-sm btn-primary me-1">Edit</div>
                    <div class="btn btn-sm btn-danger">Hapus</div>
                  </td>
                </tr>
              </tbody>
            </table>
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
import { Inertia } from "@inertiajs/inertia";
import { useToast } from "vue-toastification";
import Swal from "sweetalert2";

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
