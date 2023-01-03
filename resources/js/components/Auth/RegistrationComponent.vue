<template>
  <form method="post" class="registration" :class="{'show': show}">
    <div class="input">
      <label class="s-control" for="email">Email</label>
      <input class="s-control"
             type="email"
             name="email"
             id="email"
             placeholder="example@mail.com"
      >
    </div>
    <div class="input">
      <label class="s-control" for="username">Username</label>
      <input class="s-control"
             type="text"
             name="username"
             id="username"
             placeholder="Skiff"
      >
    </div>
    <div class="input">
      <label class="s-control" for="password">Password</label>
      <input class="s-control"
             type="password"
             name="password"
             id="password"
             placeholder="********"
      >
    </div>

    <button v-on:click.prevent="registration"
            type="button"
            class="btn btn-lg primary upper goto-login"
    >
      Sign Up
    </button>

    <button v-on:click.prevent="loginFlow"
            type="button"
            class="btn btn-lg secondary-outline upper goto-login"
    >
      Go to login
    </button>
  </form>
</template>

<script>
import axios from "axios";

export default {
  name: "RegistrationComponent",
  data() {
    return {
      show: false,
      email: null,
      password: null,
    }
  },
  methods: {
    registration: function (event) {
      axios.post('/registration', {
        email: this.email,
        password: this.password
      }, {
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        xsrfCookieName: 'XSRF-TOKEN',
      });
      event.preventDefault();
      event.target.disabled = true;
      event.target.classList.toggle('loading');
    },
    loginFlow() {
      this.show = false;
      this.$emit('login');
    }
  },
  mounted() {
    this.show = true;
  }
}
</script>