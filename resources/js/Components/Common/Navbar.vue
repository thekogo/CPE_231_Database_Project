<template>
  <div class="w-full fixed top-0 pt-2 bg-white z-50">
    <div class="container mx-auto">
      <div class="flex justify-between">
        <img src="/images/logo1.png" alt="" />
        <div class="inline-flex gap-4 items-center">
          <span class="inline-flex items-center">FAQ</span>
          <span class="inline-flex items-center">ติดต่อเรา</span>
          <input-pill />
          <a :href="route('register')">
            <button-pill>ลงทะเบียน</button-pill>
          </a>
        </div>
      </div>
      <div class="flex justify-center gap-16 mt-4 pb-4">
        <a
          class="border-b-2 border-transparent hover:border-greenn"
          :href="route('home')"
          >หน้าแรก</a
        >
        <a
          :href="route('contact')"
          class="border-b-2 border-transparent hover:border-greenn"
          >ช่องทางการติดต่อ</a
        >
        <a
          class="border-b-2 border-transparent hover:border-greenn"
          :href="route('faq')"
          >ถาม-ตอบ ปัญหา</a
        >
        <a
          class="border-b-2 border-transparent hover:border-greenn"
          :href="route('profile.show')"
          >โปรไฟล์</a
        >
        <a
          class="border-b-2 border-transparent hover:border-greenn"
          :href="route('course.all')"
          >คอร์สทั้งหมด</a
        >
      </div>
    </div>
  </div>
</template>

<script>
import ButtonPill from "@/Components/Common/ButtonPill.vue";
import InputPill from "@/Components/Common/InputPill.vue";
export default {
  components: {
    ButtonPill,
    InputPill,
  },

  methods: {
    jumpTo() {
      var container = this.$el.querySelector("#container");
      container.scrollTop = container.scrollHeight;
    },
  },
};
</script>
