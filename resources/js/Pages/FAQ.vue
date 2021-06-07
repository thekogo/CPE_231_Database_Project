<template>
  <navbar />
  <br />
  <br />
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
