<template>
    <div id="preloder">
        <div class="preloder-container">
            <div class="dot-container">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            <div class="dot-container">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            <div class="dot-container">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
        <div class="static-container">
            <div class="dot"></div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            const preloader = document.getElementById('preloder');
            setTimeout(() => {
                preloader.style.opacity = '0';
                preloader.addEventListener('transitionend', () => preloader.remove());
            }, 1);
        }
    }
</script>

<style lang="scss">
    @import "../../sass/includes/preloader";
</style>
