<template>
  <Head>
    <title>SultraSpot | Landing Page</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap"
      rel="stylesheet"
    />

    <meta
      name="msapplication-TileImage"
      :content="`${base}/frontend/assets/img/favicons/mstile-150x150.png`"
    />

    <link :href="`${base}/frontend/vendors/plyr/plyr.css`" rel="stylesheet" />
    <link :href="`${base}/frontend/assets/css/theme.css`" rel="stylesheet" />
  </Head>

  <main class="main" id="top">
    <!-- Navbar -->
    <Navbar />

    <!-- Hero -->
    <Hero />

    <!-- Places -->
    <Places />

    <!-- Videos -->
    <Videos />

    <!-- Travel -->
    <Travel />

    <!-- Experiences -->
    <Experiences />

    <!-- Booking -->
    <Booking />

    <!-- Footer -->
    <Footer />
  </main>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navbar from "../Home/components/Navbar.vue";
import Hero from "../Home/components/Hero.vue";
import Places from "../Home/components/Places.vue";
import Videos from "../Home/components/Videos.vue";
import Travel from "../Home/components/Travel.vue";
import Experiences from "../Home/components/Experiences.vue";
import Booking from "../Home/components/Booking.vue";
import Footer from "../Home/components/Footer.vue";

export default {
  components: {
    Head,
    Link,
    Navbar,
    Hero,
    Places,
    Videos,
    Travel,
    Experiences,
    Booking,
    Footer,
  },

  data() {
    return {
      base: window.location.origin,
    };
  },
};
</script>
