<template>
  <div class="bg-purplen h-full w-full">
    <nav class="flex justify-end">
      <img src="/images/navbar.png" draggable="false" class="absolute" />
      <div class="flex gap-20 z-10 mr-20 mt-5">
        <div class="">Home</div>
        <div class="">Question</div>
        <div class="">Contact</div>
      </div>
    </nav>
    <div class="grid grid-cols-2">
      <div class="col-span-1 flex flex-col justify-center align-middle">
        <div class="w-9/12 ml-auto">
          <img src="/images/lightup.png" draggable="false" class="mb-8" />
          <transition name="fade" mode="out-in">
            <a :href="route('home')">
              <img
                :src="loginBtnPath"
                alt=""
                class="cursor-pointer mx-auto w-24"
                @mouseover="loginBtn = true"
                draggable="false"
                @mouseleave="loginBtn = false"
              />
            </a>
          </transition>
        </div>
      </div>
      <div class="col-span-1">
        <lottie-player
          autoplay
          loop
          mode="normal"
          speed="0.5"
          src="https://assets2.lottiefiles.com/private_files/lf30_TBKozE.json"
          class="w-11/12 mx-auto"
        >
        </lottie-player>
      </div>
    </div>
    <img src="/images/bottom.png" draggable="false" class="absolute bottom-0" />
  </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.bg-nav {
  background-image: url("/images/navbar.png");
}
</style>

<script>
import "@lottiefiles/lottie-player";
export default {
  data() {
    return {
      loginBtn: false,
    };
  },
  computed: {
    loginBtnPath() {
      if (this.loginBtn) return "/images/login-hover.png";
      return "/images/login.png";
    },
  },
};
</script>
