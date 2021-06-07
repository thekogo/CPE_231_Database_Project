<template>
  <div>
    <navbar />
    <div class="pt-32">
      <img src="/images/tutor.png" class="mx-auto" />
      <h1 class="mx-auto text-4xl text-gray-400 mt-5 block text-center">
        {{ tutor.fullName }}
      </h1>
      <div class="container mx-auto mt-10">
        <div class="col-span-1 items-center">
          <img
            class="
              bg-red-300
              h-48
              w-48
              rounded-3xl
              mx-auto
              hover:bg-pink-300
              cursor-pointer
              shadow-xl
            "
            :src="tutor.profileImgUrl"
          />
          <div class="container mx-auto mt-1">
            <h1 class="mx-auto text-3xl text-bluen text-center mt-5">
              Owner of study course
            </h1>
            <h1
              class="
                mx-auto
                text-3xl text-gray-400 text-center
                grid grid-cols-5
                pt-3
              "
            >
              <a
                class="col-span-1 transform hover:scale-105 duration-200"
                v-for="course in tutor.courses"
                :key="course.id"
                :href="route('course.detail', { course: course.id })"
              >
                <img
                  class="bg-pink-300 h-48 w-48 rounded-3xl mx-auto"
                  :src="course.course_img"
                />
                <h1 class="text-3xl">{{ course.id }}</h1>
              </a>
            </h1>
            <div class="grid-cols-3 mx-auto"></div>
          </div>
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

  props: ["tutor"],
};
</script>
