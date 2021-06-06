<template>
  <div>
    <navbar />
    <div class="pt-32">
      <img src="/images/tutors.png" class="mx-auto" />
      <h1 class="mx-auto text-4xl text-gray-400 mt-5 block text-center">
        ทั้งหมด
      </h1>
      <div class="container mx-auto mt-10">
        <div class="grid grid-cols-4 gap-y-14">
          <a
            :href="route('tutor.detail', { tutor: tutor.id })"
            v-for="tutor in tutors"
            :key="tutor.id"
          >
            <div class="col-span-1 items-center">
              <img
                class="
                  bg-red-300
                  h-48
                  w-48
                  rounded-full
                  mx-auto
                  hover:bg-pink-300
                  cursor-pointer
                  shadow-xl
                "
                :src="tutor.profileImgUrl"
              />
              <h1 class="mx-auto text-3xl text-gray-600 text-center">
                {{ tutor.fullName }}
              </h1>
              <h1 class="mx-auto text-3xl text-gray-600 text-center">
                P'{{ tutor.nickName }}
              </h1>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  <br />
  <br />
  <br />
  <br />
  <img src="/images/bottom2.png" />
  <Copyright />
</template>
<script>
import Navbar from "@/Components/Common/Navbar.vue";
import Copyright from "@/Components/Common/Copyright.vue";

export default {
  components: {
    Navbar,
    Copyright,
  },

  props: ["tutors"],
};
</script>
