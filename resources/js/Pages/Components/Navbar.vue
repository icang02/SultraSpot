<template>
  <nav
    class="
      layout-navbar
      container-xxl
      navbar navbar-expand-xl navbar-detached
      align-items-center
      bg-navbar-theme
    "
    id="layout-navbar"
  >
    <!-- <div
      class="
        layout-menu-toggle
        navbar-nav
        align-items-xl-center
        me-3 me-xl-0
        d-xl-none
      "
    >
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
      </a>
    </div> -->

    <div
      class="navbar-nav-right d-flex align-items-center"
      id="navbar-collapse"
    >
      <!-- Search -->
      <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
          <i class="bx bx-search fs-4 lh-0"></i>
          <input
            type="text"
            class="form-control border-0 shadow-none"
            placeholder="Search..."
            aria-label="Search..."
          />
        </div>
      </div>
      <!-- /Search -->

      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Ul Keranjang -->
        <li class="nav-item lh-1 me-3" v-if="data_global[2] == 'pengunjung'">
          <Link
            :href="route('carts')"
            class="github-button d-flex align-items-center"
          >
            Carts
            <span class="badge badge-center rounded-pill bg-success ms-2">
              {{ data_global[0] }}
            </span>
          </Link>
        </li>
        <!-- Pesanan Pengelola -->
        <li class="nav-item lh-1 me-3" v-if="data_global[2] == 'pengelola'">
          <Link
            :href="route('pesanan')"
            class="github-button d-flex align-items-center"
          >
            Orders
            <span class="badge badge-center rounded-pill bg-success ms-2">
              {{ data_global[5] }}
            </span>
          </Link>
        </li>

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <Link
            class="nav-link dropdown-toggle hide-arrow"
            :href="route('dashboard')"
            data-bs-toggle="dropdown"
          >
            <div class="avatar avatar-online">
              <img
                :src="`${base}/assets/img/avatars/${data_global[6]}`"
                alt="Avatar"
                class="w-px-40 h-auto rounded-circle"
              />
            </div>
          </Link>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <Link class="dropdown-item" :href="route('dashboard')">
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                      <img
                        :src="`${base}/assets/img/avatars/${data_global[6]}`"
                        alt="Avatar Detail"
                        class="w-px-40 h-auto rounded-circle"
                      />
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <span class="fw-semibold d-block">
                      {{ data_global[1] }}
                    </span>
                    <small class="text-muted">
                      {{ titleCase(data_global[2]) }}
                    </small>
                  </div>
                </div>
              </Link>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <Link class="dropdown-item" :href="route('dashboard')">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">My Profile</span>
              </Link>
            </li>
            <li>
              <Link class="dropdown-item" :href="route('dashboard')">
                <i class="bx bx-cog me-2"></i>
                <span class="align-middle">Settings</span>
              </Link>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <Link
                href="/logout"
                method="post"
                as="button"
                class="dropdown-item"
              >
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span>
              </Link>
            </li>
          </ul>
        </li>
        <!--/ User -->
      </ul>
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

  methods: {
    titleCase(phrase) {
      return phrase
        .toLowerCase()
        .split(" ")
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(" ");
    },
  },

  components: {
    Link,
  },

  data() {
    return {
      base: window.location.origin,
    };
  },
};
</script>

<style>
</style>
