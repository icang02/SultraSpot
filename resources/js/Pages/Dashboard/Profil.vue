<template>
  <Head title="SultraSpot | Profile" />

  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Profil User</h4>

      <form @submit.prevent="updateProfile(user.id)">
        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <!-- Account -->
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img
                :src="`${base}/assets/img/avatars/${data_global[6]}`"
                alt="user-avatar"
                class="d-block rounded"
                height="100"
                width="100"
                id="uploadedAvatar"
              />
              <div class="button-wrapper">
                <label class="btn btn-primary me-2 mb-4" tabindex="0">
                  <span class="d-none d-sm-block">Upload new photo</span>
                  <i class="bx bx-upload d-block d-sm-none"></i>
                  <input
                    type="file"
                    class="account-file-input"
                    :class="{ 'is-invalid': errors.image_profil }"
                    hidden=""
                    @input="form.image_profil = $event.target.files[0]"
                    accept="image/*"
                  />
                </label>
                <button
                  type="button"
                  class="btn btn-outline-secondary account-image-reset mb-4"
                >
                  <i class="bx bx-reset d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Reset</span>
                </button>

                <p class="text-muted mb-0">
                  Allowed JPG, JPEG or PNG. Max size of 1MB
                </p>
              </div>
            </div>
            <div v-if="errors.image_profil" class="text-muted mt-2">
              {{ errors.image_profil }}
            </div>
          </div>
          <hr class="my-0" />
          <div class="card-body">
            <!-- <form @submit.prevent="updateProfile(user.id)"> -->
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input
                  v-model="form.name"
                  class="form-control"
                  :class="{ 'is-invalid': errors.name }"
                  type="text"
                  id="name"
                  name="name"
                  autocomplete="off"
                />
                <div v-if="errors.name" class="invalid-feedback">
                  {{ errors.name }}
                </div>
              </div>
              <div class="mb-3 col-md-6">
                <label for="lastName" class="form-label">Username</label>
                <input
                  class="form-control"
                  type="text"
                  v-model="form.username"
                  readonly
                />
              </div>
              <div class="mb-3 col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input
                  class="form-control"
                  :class="{ 'is-invalid': errors.email }"
                  type="email"
                  id="email"
                  name="email"
                  v-model="form.email"
                  autocomplete="off"
                />
                <div v-if="errors.email" class="invalid-feedback">
                  {{ errors.email }}
                </div>
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label">Jenis User</label>
                <input
                  type="text"
                  class="form-control"
                  :value="titleCase(data_global[2])"
                  readonly
                />
              </div>
            </div>

            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">
                Save changes
              </button>
              <button @click="resetForm()" class="btn btn-outline-secondary">
                Cancel
              </button>
            </div>
            <!-- </form> -->
          </div>
          <!-- /Account -->
        </div>
      </form>

      <hr class="my-5" />
    </div>
  </Layout>
</template>

<script>
import Layout from "../Dashboard/Shared/Template.vue";
import { Link, Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

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
      form: useForm({
        name: this.user.name,
        username: this.user.username,
        email: this.user.email,
        image_profil: this.user.image_profil,
      }),
    };
  },

  props: {
    user: Object,
    errors: Object,
  },

  methods: {
    titleCase(str) {
      var splitStr = str.toLowerCase().split(" ");
      for (var i = 0; i < splitStr.length; i++) {
        splitStr[i] =
          splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
      }
      return splitStr.join(" ");
    },

    resetForm() {
      this.form.name = this.user.name;
      this.form.email = this.user.email;
    },

    updateProfile(id_user) {
      Inertia.post(`${this.base}/update-profile/${id_user}`, this.form, {
        onSuccess: () => Swal.fire("Sukses!", `Profil diupdate.`, "success"),
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
};
</script>
