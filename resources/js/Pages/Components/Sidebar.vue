<template>
  <!-- Sidebar Pengunjung -->
  <aside
    id="layout-menu"
    class="layout-menu menu-vertical menu bg-menu-theme"
    style="position: relative"
  >
    <div class="app-brand demo">
      <a href="" class="app-brand-link">
        <span class="app-brand-logo demo">
          <img width="32" src="assets/img/favicon/logo.png" alt="Logo" />
        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2"
          >SultraSpot</span
        >
      </a>

      <a
        href=""
        class="
          layout-menu-toggle
          menu-link
          text-large
          ms-auto
          d-block d-xl-none
        "
      >
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li
        class="menu-item"
        :class="{ active: $page.url.startsWith('/dashboard') }"
      >
        <Link :href="route('dashboard')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </Link>
      </li>

      <li class="menu-item">
        <a :href="'ddd'" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-user-account"></i>
          <div data-i18n="Analytics">Profile</div>
        </a>
      </li>

      <li
        class="menu-header small text-uppercase"
        v-if="data_global[2] == 'admin'"
      >
        <span class="menu-header-text">Daftar User</span>
      </li>
      <li
        class="menu-item"
        :class="{ active: $page.url.startsWith('/users/' + role.name) }"
        v-for="role in data_global[3]"
        :key="role.id"
      >
        <Link
          v-if="data_global[2] == 'admin'"
          :href="`${base}/users/${role.name}`"
          class="menu-link"
        >
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Analytics">{{ titleCase(role.name) }}</div>
        </Link>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Wisata &amp; Event</span>
      </li>
      <li
        class="menu-item"
        :class="{
          active:
            $page.url.startsWith('/list-wisata') ||
            $page.url.startsWith('/add-wisata'),
        }"
      >
        <Link :href="route('list-wisata')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Basic">
            <span v-if="data_global[2] == 'pengelola'">My Wisata</span>
            <span v-else>Wisata</span>
          </div>
        </Link>
      </li>

      <li class="menu-item">
        <a href="icons-boxicons.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-crown"></i>
          <div data-i18n="Boxicons">
            <span v-if="data_global[2] == 'pengelola'">My Event</span>
            <span v-else>Event</span>
          </div>
        </a>
      </li>

      <!-- Tables -->
      <li
        class="menu-header small text-uppercase"
        v-if="data_global[2] == 'pengunjung'"
      >
        <span
          class="menu-header-text"
          :class="{
            'text-primary':
              $page.url.startsWith('/order') ||
              $page.url.startsWith('/checkout'),
          }"
          >Transaksi</span
        >
      </li>
      <li
        v-if="data_global[2] == 'pengunjung'"
        class="menu-item"
        :class="{ active: $page.url.startsWith('/carts') }"
      >
        <Link :href="route('carts')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cart"></i>
          <div data-i18n="Tables">Keranjang</div>
        </Link>
      </li>
      <li
        v-if="data_global[2] == 'pengunjung'"
        class="menu-item"
        :class="{ active: $page.url.startsWith('/pesanan') }"
      >
        <Link :href="route('pesanan')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Tables">Pesanan</div>
        </Link>
      </li>

      <!-- SIDEBAR PENGELOLA -->
      <li
        class="menu-header small text-uppercase"
        v-if="data_global[2] == 'pengelola'"
      >
        <span class="menu-header-text">Transaksi</span>
      </li>
      <li
        v-if="data_global[2] == 'pengelola'"
        class="menu-item"
        :class="{ active: $page.url.startsWith('/pesanan') }"
      >
        <Link :href="route('pesanan')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Tables">Pesanan</div>
        </Link>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text"></span>
      </li>
    </ul>
  </aside>
</template>


<script>
import { Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
  setup() {
    const base = window.location.origin;
    const data_global = computed(() => usePage().props.value.data_global);
    return {
      data_global,
      base,
    };
  },

  components: {
    Link,
  },

  methods: {
    titleCase(str) {
      var splitStr = str.toLowerCase().split(" ");
      for (var i = 0; i < splitStr.length; i++) {
        // You do not need to check if i is larger than splitStr length, as your for does that for you
        // Assign it back to the array
        splitStr[i] =
          splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
      }
      // Directly return the joined string
      return splitStr.join(" ");
    },
  },
};
</script>
