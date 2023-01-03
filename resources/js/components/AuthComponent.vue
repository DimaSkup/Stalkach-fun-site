<template>
  <div>
    <button class="auth-button" v-on:click="open">
      <span class="material-icons">double_arrow</span>
      <b>Enter the zone</b>
    </button>

    <div id="auth" :class="{
    'active': active,
    'registration-flow': registrationFlowClass,
  }">
      <div class="left-side" id="left-side">
        <svg>
          <filter id="pixelate_safe" x="0" y="0">
            <feFlood x="4"  y="4" height="1" width="1" />
            <feComposite id="pixelate_medium_composite" width="40" height="40" />
            <feTile result="a" />
            <feComposite in="SourceGraphic" in2="a" operator="in" />
            <feMorphology id="pixelate_medium_morphology" operator="dilate" radius="20" />
          </filter>

          <filter id="pixelate_strong" x="0" y="0">
            <feFlood x="4" y="4" height="1" width="1" />
            <feComposite id="pixelate_strong_composite" width="32" height="32" />
            <feTile result="a" />
            <feComposite in="SourceGraphic" in2="a" operator="in" />
            <feMorphology id="pixelate_strong_morphology" operator="dilate" radius="18" />
          </filter>

          <filter id="pixelate_medium" x="0" y="0">
            <feFlood x="4" y="4" height="1" width="1" />
            <feComposite id="pixelate_medium_composite" width="24" height="24" />
            <feTile result="a" />
            <feComposite in="SourceGraphic" in2="a" operator="in" />
            <feMorphology id="pixelate_medium_morphology" operator="dilate" radius="12" />
          </filter>

          <filter id="pixelate_lite" x="0" y="0">
            <feFlood x="4" y="4" height="1" width="1" />
            <feComposite id="pixelate_lite_composite" width="16" height="16" />
            <feTile result="a" />
            <feComposite in="SourceGraphic" in2="a" operator="in" />
            <feMorphology id="pixelate_lite_morphology" operator="dilate" radius="8" />
          </filter>

          <filter id="pixelate_minimum" x="0" y="0">
            <feFlood x="4" y="4" height="1" width="1" />
            <feComposite id="pixelate_minimum_composite1" width="8" height="8" />
            <feTile result="a" />
            <feComposite in="SourceGraphic" in2="a" operator="in" />
            <feMorphology id="pixelate_minimum_morphology" operator="dilate" radius="4" />
          </filter>
        </svg>
      </div>
      <div class="right-side">
        <login-component
            v-if="template === 'login'"
            v-on:create-account="createAccountFlow"
        ></login-component>

        <registration-component
            v-else-if="template === 'registration'"
            v-on:login="loginFlow"
        ></registration-component>

        <forgot-password-component v-else-if="template === 'forgotPassword'"></forgot-password-component>
      </div>

      <div class="close-wrapper">
        <button class="close" v-on:click="close">
          <span class="material-icons">close</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
    import axios from 'axios';
    import LoginComponent from "./Auth/LoginComponent";
    import RegistrationComponent from "./Auth/RegistrationComponent";
    import ForgotPasswordComponent from "./Auth/ForgotPasswordComponent";

    export default {
      name: 'AuthComponent',
      components: {ForgotPasswordComponent, RegistrationComponent, LoginComponent},
      data() {
          return {
            active: false,
            template: 'login',
            registrationFlowClass: false,
          }
        },
        methods: {
          open: function(event) {
            this.active = true;
          },
          close: function (event) {
            this.active = false;
          },
          createAccountFlow() {
            this.registrationFlowClass = true;
            setTimeout(() => this.template = 'registration', 1000);
          },
          loginFlow() {
            this.registrationFlowClass = false;
            setTimeout(() => this.template = 'login', 1000);
          }
        },
        watch: {
          active: function (val) {
            document.body.style.overflowY = val ? 'hidden' : 'auto'
          }
        },
    }
</script>
