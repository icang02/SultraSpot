<template>
  <Head title="SultraSpot | Tambah Wisata" />

  <Layout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Wisata & Event / My Wisata / </span>
        Tambah
      </h4>

      <div class="row">
        <div class="col-md-10">
          <div class="card mb-4">
            <h5 class="card-header">Form Tambah Wisata</h5>
            <div class="card-body">
              <form @submit.prevent="addStore()">
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label for="name" class="form-label">Nama Wisata</label>
                      <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        placeholder="Sultraspot"
                        v-model="form.name"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label for="email" class="form-label">Kota</label>
                      <input
                        type="text"
                        class="form-control"
                        id="city"
                        placeholder="Kendari"
                        v-model="form.city"
                      />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label for="email" class="form-label">Alamat</label>
                      <input
                        type="text"
                        class="form-control"
                        id="address"
                        placeholder="Jl. 123 No. 1"
                        v-model="form.address"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label for="email" class="form-label">Telepon</label>
                      <input
                        type="text"
                        class="form-control"
                        id="telp"
                        placeholder="+62 8xx xxx xxx"
                        v-model="form.telp"
                      />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label for="email" class="form-label">Harga Tiket</label>
                      <input
                        type="number"
                        class="form-control"
                        id="price"
                        placeholder="50000"
                        v-model="form.price"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label for="email" class="form-label">Stok</label>
                      <input
                        type="number"
                        class="form-control"
                        id="ticket_stock"
                        placeholder="100"
                        v-model="form.ticket_stock"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label for="email" class="form-label"
                        >Rental Kamera</label
                      >
                      <select
                        class="form-select"
                        id="rental"
                        v-model="form.rental"
                      >
                        <option :value="1">Ada</option>
                        <option :value="0">Tidak ada</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label for="email" class="form-label"
                        >Upload Foto Wisata</label
                      >
                      <input
                        class="form-control"
                        type="file"
                        id="image"
                        accept="image/*"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label for="email" class="form-label">Alamat Maps</label>
                      <input
                        class="form-control"
                        type="url"
                        id="maps"
                        placeholder="https://maps.app.goo.gl"
                        v-model="form.maps"
                      />
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Deskripsi</label>
                  <textarea
                    type="text"
                    class="form-control"
                    id="address"
                    placeholder="Deskripsi mengenai tempat wisata.."
                    rows="5"
                    v-model="form.description"
                  />
                </div>

                <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-1">
                    Tambah
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
import { Link, Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { useToast } from "vue-toastification";

export default {
  components: {
    Layout,
    Link,
    Head,
  },

  data() {
    return {
      form: useForm({
        name: "",
        city: "",
        address: "",
        description: "",
        ticket_stock: "",
        price: "",
        telp: "",
        image: "default.jpg",
        maps: "",
        rental: "",
      }),
    };
  },

  methods: {
    addStore() {
      // const data = {
      //   name: this.form.name,
      //   city: this.form.city,
      //   description: this.form.description,
      //   ticket_stock: this.form.ticket_stock,
      //   price: this.form.price,
      //   telp: this.form.telp,
      //   image: this.form.image,
      //   rental: this.form.rental,
      // };

      Inertia.post("add-wisata", this.form, {
        onSuccess: () => this.toast("success", "Datai wisata ditambahkan."),
      });
    },

    titleCase(phrase) {
      return phrase
        .toLowerCase()
        .split(" ")
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(" ");
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

  props: {},
};
</script>


