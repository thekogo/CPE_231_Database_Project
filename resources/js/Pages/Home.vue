<template>
  <div class="container mx-auto">
    <div class="flex justify-between">
      <img src="/images/logo1.png" alt="" />
      <div class="inline-flex gap-4 items-center">
        <span class="inline-flex items-center">FAQ</span>
        <span class="inline-flex items-center">ติดต่อเรา</span>
        <input-pill />
        <button-pill>ลงทะเบียน</button-pill>
      </div>
    </div>
    <div class="flex justify-center gap-16 mt-4">
      <span class="border-b-2 border-transparent hover:border-greenn"
        >กหฟกหฟหก</span
      >
      <span class="border-b-2 border-transparent hover:border-greenn"
        >กหฟกหฟหก</span
      >
      <span class="border-b-2 border-transparent hover:border-greenn"
        >กหฟกหฟหก</span
      >
      <span class="border-b-2 border-transparent hover:border-greenn"
        >กหฟกหฟหก</span
      >
    </div>
  </div>
  <div class="grid grid-cols-2 bg-blue-400 mt-4">
    <div class="col-span-1 flex flex-col justify-center align-middle">
      <div class="w-9/12 ml-auto">
        <img src="/images/lightup.png" draggable="false" class="mb-8" />
        <transition name="fade" mode="out-in">
          <img
            :src="loginBtnPath"
            alt=""
            class="cursor-pointer mx-auto w-24"
            @mouseover="loginBtn = true"
            draggable="false"
            @mouseleave="loginBtn = false"
          />
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
  <div class="container mx-auto">test</div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>


<script>
import "@lottiefiles/lottie-player";
import JetButton from "@/Jetstream/Button.vue";
import ButtonPill from "@/Components/Common/ButtonPill.vue";
import InputPill from "@/Components/Common/InputPill.vue";

export default {
  components: { JetButton, ButtonPill, InputPill },
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
