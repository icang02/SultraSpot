<template>
  <Head title="SultraSpot | Login" />

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a :href="route('home')" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img
                    width="32"
                    src="assets/img/favicon/logo.png"
                    alt="Logo"
                  />
                </span>
                <span class="app-brand-text demo text-body fw-bolder"
                  >SultraSpot</span
                >
              </a>
            </div>
            <!-- /Logo -->

            <!-- Alert Success -->
            <div
              v-if="$page.props.flash.success"
              class="alert alert-success alert-dismissible"
              role="alert"
            >
              {{ $page.props.flash.success }}
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
              ></button>
            </div>

            <!-- Alert Error -->
            <div
              v-if="$page.props.flash.error"
              class="alert alert-danger alert-dismissible"
              role="alert"
            >
              {{ $page.props.flash.error }}
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
              ></button>
            </div>

            <h4 class="mb-2">Welcome to SultraSpot! 👋</h4>
            <p class="mb-4">
              Please sign-in to your account and start the adventure
            </p>

            <form class="mb-3" @submit.prevent="authSend">
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input
                  v-model="form.email"
                  type="text"
                  class="form-control"
                  :class="errors.email ? 'is-invalid' : ''"
                  id="email"
                  name="email"
                  placeholder="Enter your email"
                />
                <div v-if="errors.email" class="invalid-feedback">
                  {{ errors.email }}
                </div>
              </div>

              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <Link :href="route('forgot')">
                    <small>Forgot Password?</small>
                  </Link>
                </div>

                <div class="input-group">
                  <input
                    v-model="form.password"
                    type="password"
                    id="password"
                    class="form-control"
                    :class="errors.password ? 'is-invalid' : ''"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  />
                  <div v-if="errors.password" class="invalid-feedback">
                    {{ errors.password }}
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="remember-me"
                    name="remember-me"
                    v-model="form.remember_me"
                  />
                  <label class="form-check-label" for="remember-me">
                    Remember Me
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">
                  Sign in
                </button>
              </div>
            </form>

            <p class="text-center">
              <span>New on our platform? </span>
              <Link :href="route('register')">
                <span>Create an account</span>
              </Link>
            </p>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
</template>

<script>
import { Link, Head } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    Link,
    Head,
  },

  props: {
    errors: Object,
  },

  setup() {
    const form = reactive({
      email: null,
      password: null,
      remember_me: false,
    });

    function authSend() {
      Inertia.post("/login", form);
    }

    return { form, authSend };
  },
};
</script>
