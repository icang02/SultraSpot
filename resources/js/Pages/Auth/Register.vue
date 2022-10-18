<template>
  <Head title="SultraSpot | Register" />

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
          <div class="card-body">
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
            <h4 class="mb-2">Adventure starts here 🚀</h4>
            <p class="mb-4">Make your app management easy and fun!</p>

            <form @submit.prevent="register" class="mb-3">
              <div class="mb-3">
                <label for="username" class="form-label">Full Name</label>
                <input
                  v-model="form.name"
                  type="text"
                  class="form-control"
                  :class="errors.name ? 'is-invalid' : ''"
                  id="name"
                  name="name"
                  placeholder="Enter your name"
                />
                <div class="invalid-feedback">{{ errors.name }}</div>
              </div>

              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                  v-model="form.username"
                  type="text"
                  class="form-control"
                  :class="errors.username ? 'is-invalid' : ''"
                  id="username"
                  name="username"
                  placeholder="Enter your username"
                />
                <div class="invalid-feedback">{{ errors.username }}</div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  v-model="form.email"
                  type="text"
                  class="form-control"
                  :class="errors.email ? 'is-invalid' : ''"
                  id="email"
                  name="email"
                  placeholder="Enter your email"
                />
                <div class="invalid-feedback">{{ errors.email }}</div>
              </div>

              <div class="mb-3">
                <label for="role_id" class="form-label">Jenis User</label>
                <select
                  class="form-select"
                  :class="errors.role_id ? 'is-invalid' : ''"
                  name="role_id"
                  id="role_id"
                  v-model="form.role_id"
                >
                  <option
                    v-for="(role, index) in roles"
                    :key="index"
                    :value="role.id"
                  >
                    {{ role.name.toUpperCase() }}
                  </option>
                </select>

                <div class="invalid-feedback">{{ errors.role_id }}</div>
              </div>

              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
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
                  <div class="invalid-feedback">{{ errors.password }}</div>
                </div>
              </div>

              <div class="mb-3">
                <div class="form-check">
                  <input
                    v-model="form.terms"
                    class="form-check-input"
                    :class="errors.terms ? 'is-invalid' : ''"
                    type="checkbox"
                    id="terms-conditions"
                    name="terms"
                  />
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <Link :href="route('register')">
                      privacy policy & terms
                    </Link>
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary d-grid w-100">
                Sign up
              </button>
            </form>

            <p class="text-center">
              <span>Already have an account? </span>
              <Link :href="route('login')">
                <span>Sign in instead</span>
              </Link>
            </p>
          </div>
        </div>
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
    Head,
    Link,
  },

  props: {
    errors: Object,
    roles: Object,
  },

  setup() {
    const form = reactive({
      name: null,
      username: null,
      email: null,
      password: null,
      role_id: null,
      terms: null,
    });

    function register() {
      Inertia.post("/register", form);
    }

    return { form, register };
  },
};
</script>
