<template>
  <navbar />
  <div class="grid grid-cols-2 bg-blue-400">
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

  <div class="container mx-auto grid grid-cols-5 gap-5 py-5">
    <carousel :items-to-show="1" class="col-span-4">
      <Slide v-for="slide in imgBanners" :key="slide">
        <div class="carousel__item">
          <div>
            <img :src="slide" class="h-80 object-cover w-full rounded-3xl" />
          </div>
        </div>
      </Slide>
      <!-- <Slide>
        <div class="carousel__item">
          <img
            src="/images/banner1.png"
            class="h-80 object-cover w-full rounded-3xl"
          />
        </div>
      </Slide> -->

      <template #addons>
        <navigation />
        <pagination />
      </template>
    </carousel>
    <div class="col-span-1 grid grid-cols-2 grid-rows-2 gap-2">
      <div
        class="
          col-span-1
          row-span-1
          border border-gray-200
          rounded-md
          bg-grey
          flex flex-col
          justify-center
          items-center
          gap-4
          cursor-pointer
          hover:bg-pink-200
          hover:shadow-xl
        "
      >
        <i class="fas fa-cart-plus text-6xl text-pinkn"></i>
        <span>PAYMENT</span>
      </div>
      <a
        :href="route('login')"
        class="
          col-span-1
          row-span-1
          border border-gray-200
          rounded-md
          bg-grey
          flex flex-col
          justify-center
          items-center
          gap-4
          cursor-pointer
          hover:bg-pink-200
          hover:shadow-xl
        "
      >
        <i class="fas fa-user text-6xl text-purplen"></i>
        <span>PROFILE</span>
      </a>
      <a
        class="
          col-span-1
          row-span-1
          border border-gray-200
          rounded-md
          bg-grey
          flex flex-col
          justify-center
          items-center
          gap-4
          cursor-pointer
          hover:bg-pink-200
          hover:shadow-xl
        "
        :href="route('tutor.all')"
      >
        <i class="fas fa-chalkboard-teacher text-6xl text-skyn"></i>
        <span>TUTOR</span>
      </a>
      <div
        class="
          col-span-1
          row-span-1
          border border-gray-200
          rounded-md
          bg-grey
          flex flex-col
          justify-center
          items-center
          gap-4
          cursor-pointer
          hover:bg-pink-200
          hover:shadow-xl
        "
      >
        <i class="far fa-question-circle text-6xl text-yellow-400"></i>
        <span>CONTACT</span>
      </div>
    </div>
  </div>
  <br />
  <br />

  <div class="container mx-auto">
    <div class="flex justify-end">
      <span class="ml-auto text-xl cursor-pointer">ดูเพิ่มเติม >></span>
    </div>
    <div class="grid grid-cols-5 gap-2 h-40 mx-auto">
      <a
        class="block col-span-1 row-span-1 cursor-pointer"
        v-for="course in courses"
        :key="course.id"
        :href="route('course.detail', { course: course.id })"
      >
        <img :src="course.course_img" alt="" class="h-40 mx-auto" />
        <h3 class="mx-auto text-center">{{ course.name }}</h3>
        <h4 class="mx-auto text-center">{{ course.user.fullName }}</h4>
      </a>
    </div>
  </div>
  <div class="grid grid-cols-2 mt-4">
    <div class="col-span-1">
      <lottie-player
        autoplay
        loop
        mode="normal"
        speed="0.5"
        src="https://assets1.lottiefiles.com/private_files/lf30_9ltfoN.json"
        class="w-11/12 mx-auto"
      >
      </lottie-player>
    </div>
    <div class="col-span-1 flex flex-col justify-center align-middle">
      <div class="w-9/12">
        <img src="/images/whatis.png" draggable="false" class="mb-2" />
        <img src="/images/nextlevel.png" />
        <img src="/images/learning.png" class="mt-2 mx-auto" />
        <span class="text-center block mt-3 text-5xl"
          >สามารถเรียนได้ทุกที่ทุกเวลา</span
        >
        <span class="text-center block mt-2 text-5xl"
          >เรียนได้ตลอด24ชั่วโมง</span
        >
        <span class="text-center block mt-2 text-5xl"
          >สะดวก สบาย เวลาเหลือเยอะขึ้น</span
        >
      </div>
    </div>
  </div>
  <br />
  <br />
  <br />
  <div class="container mx-auto items-center px-60">
    <img src="/images/faq.png" class="mx-auto" />
    <br /><br />

    <faq
      header="สนใจสมัครเรียนต้องทำอย่างไร"
      description="สามารถสมัครผ่านทางเว็บไซต์ หรือ สาขาใกล้บ้านได้เลยค่ะ"
    />
    <faq
      header="อยากเรียนคอร์สสดต้องทำอย่างไร"
      description="หลังจากซื้อคอร์สสามารถจองเวลาเรียนที่สาขาใกล้บ้านได้ค่ะ"
    />
    <faq
      header="ช่องทางการชำระเงิน"
      description="สามารถโอนผ่านช่องทางธนาคาร หรือเงินสดได้ที่สถาบัน"
    />
    <faq
      header="Next Level มีกี่สาขา"
      description="ในขณะนี้มีสาขาทั้งหมดเพียงสาขาเดียว กำลังเร่งดำเนินการเพิ่มสาขาเพื่อให้สามารถเข้าถึงได้ง่าย"
    />
    <faq
      header="สามารถเรียนที่ไหนได้บ้าง"
      description="สามารถเรียนผ่านช่องทางออนไลน์ หรือจองเวลามาเรียนที่สถาบันได้"
    />
  </div>

  <img src="/images/bottom2.png" class="w-full" />

  <copyright />
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.carousel__item,
carousel__slide {
  widows: 100%;
}
</style>


<script>
import "@lottiefiles/lottie-player";
import JetButton from "@/Jetstream/Button.vue";
import ButtonPill from "@/Components/Common/ButtonPill.vue";
import InputPill from "@/Components/Common/InputPill.vue";
import Copyright from "@/Components/Common/Copyright.vue";
import Navbar from "@/Components/Common/Navbar.vue";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
import Faq from "@/Components/Common/FAQ.vue";

export default {
  components: {
    JetButton,
    ButtonPill,
    InputPill,
    Copyright,
    Navbar,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Faq,
  },
  props: ["courses"],

  data() {
    return {
      imgBanners: [
        "/images/banner1.png",
        "/images/banner2.png",
        "/images/banner3.png",
      ],
    };
  },
};
</script>
