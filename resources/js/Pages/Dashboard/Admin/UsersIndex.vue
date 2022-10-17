<template>
  <Head title="SultraSpot | User" />

  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Daftar User /</span>
        {{ title }}
      </h4>

      <div class="card">
        <h5 class="card-header">Tabel User {{ title }}</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <caption class="ms-4">
              List of
              {{
                title
              }}
            </caption>
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
                <th>Foto Profil</th>
                <th>Alamat Email</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, index) in roles" :key="index">
                <td>
                  <i class="fab fa-bootstrap fa-lg text-primary me-3"></i>
                  <strong>{{ index + 1 }}</strong>
                </td>
                <td>{{ user.name }}</td>
                <td>
                  <ul
                    class="
                      list-unstyled
                      users-list
                      m-0
                      avatar-group
                      d-flex
                      align-items-center
                    "
                  >
                    <li
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up"
                      :title="user.name"
                    >
                      <img
                        :src="`${base}/assets/img/avatars/5.png`"
                        alt="Avatar"
                        class="rounded-circle"
                      />
                    </li>
                  </ul>
                </td>
                <td>{{ user.email }}</td>
                <td>
                  <Link
                    :href="`${base}/users/${title.toLowerCase()}/${
                      user.username
                    }`"
                    class="btn btn-sm btn-primary me-1"
                    >Edit</Link
                  >
                  <button
                    @click="deleteUser(user.username, user.name)"
                    as="button"
                    class="btn btn-sm btn-danger"
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- {{ data[0][0] }} -->
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
    roles: Object,
    title: String,
    data: Array,
  },
};
</script>
