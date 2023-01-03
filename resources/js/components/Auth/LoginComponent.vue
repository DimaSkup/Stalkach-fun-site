<template>
  <form method="post" class="login" :class="{'show': show}">
    <b class="title">Enter the zone!</b>
    <span v-if="responseError" class="s-invalid">{{ responseError }}</span>
    <div class="input">
      <label class="s-control" for="email">Email</label>
      <input type="email"
             id="email"
             name="email"
             class="s-control"
             :class="{
                'valid': !emailError && emailError !== undefined,
                'invalid': emailError
             }"
             placeholder="skiff@email.com"
             v-model="email"
             required
      >
      <span v-if="emailError" class="s-invalid">{{ emailError }}</span>
    </div>
    <div class="input">
      <label class="s-control" for="password">Password</label>
      <input type="password"
             id="password"
             name="password"
             class="s-control"
             v-bind:class="{
                'valid': !passwordError && passwordError !== undefined,
                'invalid': passwordError
             }"
             placeholder="•••••••••••••"
             v-on:input="passwordEvent"
             v-model="password"
             required
      >
      <span v-if="passwordError" class="s-invalid">{{ passwordError }}</span>
    </div>
    <button type="button" class="forgot-password">Forgot password?</button>
    <button type="button"
            id="login-button"
            class="btn btn-lg primary submit"
            v-bind:loading="isLoading"
            v-bind:disabled="isLoading"
            v-on:click.prevent="loading"
    >Login</button>

    <div class="social-signup">
      <a v-on:click.prevent=""
         href="#"
         class="btn btn-lg upper google-login"
      >
        <span class="socicon-google"></span>
        <span>Google</span>
      </a>
      <a v-on:click.prevent=""
         href="#"
         class="btn btn-lg upper steam-login"
      >
        <span class="socicon-steam"></span>
        <span>Steam</span>
      </a>
    </div>

    <button type="button"
            class="btn btn-lg secondary-outline create"
            v-on:click.prevent="createAccountFlow">
      Create an account
    </button>
  </form>
</template>

<script>
  import axios from 'axios';

  export default {
    name: 'LoginComponent',
    data() {
      return {
        // imageUrl: '/images/bloodsucker.jpeg',
        show: false,
        email: null,
        emailError: undefined,
        password: null,
        passwordError: undefined,
        imageBlock: undefined,
        overlay: undefined,
        authImg: undefined,
        isLoading: false,
        responseError: false,
        securityLevelClasses: {
          0: null,
          1: 'security_minimum',
          2: 'security_lite',
          3: 'security_medium',
          4: 'security_strong',
          5: 'security_safe',
        }
      }
    },
    methods: {
      loading: function (event) {
        this.responseError = false;
        if(!this.validation()) {
          return;
        }

        this.isLoading = true;
        axios.post('/login', {
          email: this.email,
          password: this.password
        }, {
          headers: {'X-Requested-With': 'XMLHttpRequest'},
          xsrfCookieName: 'XSRF-TOKEN',
        }).then(function(response) {
          console.log(response);
        }).catch((error) => {
          this.responseError = error.response.data.message || 'Unhandled error';
        })
        .then(() => {
          this.isLoading = false;
          this.clearValidation();
        });
      },
      passwordEvent: function (event) {
        const value = event.target.value;
        let securityLevel = Math.floor((value.length <= 10 ? value.length : 10) / 2);

        // if(value.length >= 8) {
        //     securityLevel = 1;
        // }
        //
        // if (securityLevel >= 1 && /[A-Z]/.test(value)) {
        //     securityLevel = 2;
        // }
        //
        // if (securityLevel >= 2 && /[0-9]/.test(value)) {
        //     securityLevel = 3;
        // }
        //
        // if(securityLevel >= 3 && /[!@#$%^&*()-+\/\\]/.test(value)) {
        //     securityLevel = 4;
        // }
        // console.log(value, securityLevel);
        this.imageBlock.classList = `left-side ${this.securityLevelClasses[securityLevel]}`;
      },
      createAccountFlow() {
        this.show = false;
        this.$emit('create-account')
      },
      validation() {
        console.log(this.email, this.password);
        const requiredError = 'This field must be filled';
        this.emailError = !this.email ? requiredError : false;
        this.passwordError = !this.password ? requiredError : false;

        return !this.emailError && !this.passwordError;
      },
      clearValidation() {
        this.emailError = undefined;
        this.passwordError = undefined;
      }
    },
    mounted() {
      this.show = true;
      this.authImg = document.getElementById('auth-image');
      this.imageBlock = document.getElementById('left-side');
    }
  }
</script>