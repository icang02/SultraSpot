<template>
  <nav
    id="nav-mobile"
    class="navbar navbar-example navbar-expand-lg navbar-light shadow"
  >
    <div class="container-fluid">
      <Link :href="route('dashboard')" class="navbar-brand">SultraSpot</Link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbar-ex-2"
        aria-controls="navbar-ex-2"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar-ex-2">
        <div class="navbar-nav me-auto">
          <hr />
          <!-- ADMIN MENU -->
          <div v-if="data_global[2] == 'admin'">
            <Link
              v-for="role in data_global[3]"
              :key="role.id"
              class="nav-item nav-link"
              :class="{ active: $page.url.startsWith(`/users/${role.name}`) }"
              :href="`${base}/users/${role.name}`"
              >{{ titleCase(role.name) }}
            </Link>
          </div>

          <!-- PENGUNJUNG MENU -->
          <div
            v-if="
              data_global[2] == 'pengunjung' || data_global[2] == 'pengelola'
            "
          >
            <Link
              class="nav-item nav-link"
              :class="{ active: $page.url.startsWith('/list-wisata') }"
              :href="route('list-wisata')"
            >
              <span v-if="data_global[2] == 'pengelola'">My Wisata</span>
              <span v-else>Wisata</span>
            </Link>
            <Link class="nav-item nav-link" :href="route('dashboard')">
              <span v-if="data_global[2] == 'pengelola'">My Event</span>
              <span v-else>Event</span>
            </Link>
          </div>

          <hr />

          <!-- ADMIN MENU -->
          <div v-if="data_global[2] == 'admin'">
            <Link
              class="nav-item nav-link"
              :class="{ active: $page.url.startsWith('/list-wisata') }"
              :href="route('list-wisata')"
              >Wisata
            </Link>
            <Link
              class="nav-item nav-link"
              :class="{ active: $page.url.startsWith('/pesanan') }"
              :href="route('dashboard')"
              >Event
            </Link>
          </div>

          <!-- PENGUNJUNG MENU -->
          <Link
            v-if="data_global[2] == 'pengunjung'"
            class="nav-item nav-link"
            :class="{ active: $page.url.startsWith('/carts') }"
            :href="route('carts')"
            >Keranjang
          </Link>

          <Link
            v-if="
              data_global[2] == 'pengelola' || data_global[2] == 'pengunjung'
            "
            class="nav-item nav-link"
            :class="{ active: $page.url.startsWith('/pesanan') }"
            :href="route('pesanan')"
            >Pesanan
          </Link>
          <hr />
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

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
    titleCase(phrase) {
      return phrase
        .toLowerCase()
        .split(" ")
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(" ");
    },
  },

  components: { Link },
};
</script>
