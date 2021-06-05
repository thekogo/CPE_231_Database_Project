<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ประวัติการลงทะเบียน
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-12 gap-4">
          <div class="col-span-3">
            <side-menu />
          </div>
          <div class="col-span-9">
            <div class="flex justify-between mb-2">
              <h1 class="text-2xl font-semibold mb-3">รายการลงทะเบียน</h1>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <div class="grid grid-cols-4 gap-4">
                <a
                  class="
                    col-span-1
                    h-64
                    rounded-md
                    border border-gray-400
                    p-5
                    hover:shadow-lg
                    hover:scale-105
                    transform
                    duration-300
                  "
                  v-for="enrollment in enrollments"
                  :key="enrollment.id"
                  :href="
                    route('student.courses.show', { course: enrollment.id })
                  "
                >
                  <img :src="enrollment.course.course_img" class="" />
                  <span class="text-2xl">{{ enrollment.course.name }}</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetNavLink from "@/Jetstream/NavLink";
import SideMenu from "@/Components/Student/SideMenu.vue";
import JetButton from "@/Jetstream/Button.vue";
import Swal from "sweetalert2";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    JetButton,
  },
  props: ["enrollments"],
};
</script>
