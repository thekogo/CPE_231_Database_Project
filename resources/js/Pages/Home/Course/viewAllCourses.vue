<template>
  <div>
    <navbar />
    <div class="pt-32">
      <img src="/images/head.png" class="mx-auto" />
      <div class="container mx-auto mt-10">
        <div class="grid grid-cols-4 gap-y-14">
          <a
            class="col-span-1 items-center"
            v-for="course in courses"
            :key="course.id"
            :href="route('course.detail', { course: course.id })"
          >
            <img
              :src="course.course_img"
              alt=""
              class="
                mx-auto
                rounded-course
                cursor-pointer
                shadow-2xl
                hover:bg-red-200
                transform
                hover:scale-105
                duration-200
              "
            />
            <h1 class="text-xl text-center">{{ course.name }}</h1>
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
  props: ["courses"],
};
</script>
