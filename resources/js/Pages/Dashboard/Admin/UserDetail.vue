<template>
  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Daftar User / {{ title }} / </span>
        Edit
      </h4>

      <div class="row">
        <div class="col-md-7">
          <div class="card mb-4">
            <h5 class="card-header">Form Profil</h5>
            <div class="card-body">
              <form>
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Lengkap</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="name"
                    placeholder="Sultraspot"
                    :value="user.name"
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Alamat Email</label>
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="email"
                    placeholder="sultraspot@gmail.com"
                    :value="user.email"
                  />
                </div>
                <div class="mb-3">
                  <label for="role_id" class="form-label">Role</label>
                  <select class="form-select" name="role_id" id="role_id">
                    <option
                      v-for="role in roles"
                      :key="role.id"
                      :selected="role.id == user.role_id"
                    >
                      {{ titleCase(role.name) }}
                    </option>
                  </select>
                </div>
                <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-1">
                    Ubah
                  </button>
                  <button type="reset" class="btn btn-danger">Reset</button>
                </div>
              </form>
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
import { Link, useForm } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Layout,
    Link,
  },

  data() {
    return {
      form: useForm({
        name: "",
        email: "",
        role_id: "",
      }),
    };
  },

  methods: {
    titleCase(phrase) {
      return phrase
        .toLowerCase()
        .split(" ")
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(" ");
    },
  },

  props: {
    title: String,
    user: Object,
    roles: Object,
  },
};
</script>


