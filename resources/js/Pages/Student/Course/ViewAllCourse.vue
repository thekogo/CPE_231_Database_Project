<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Dashboard 2
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-12 gap-4">
          <div class="col-span-3">
            <side-menu />
          </div>
          <div class="col-span-9">
            <h1 class="text-2xl font-semibold mt-10 mb-3">
              คอร์สที่กำลังเรียน
            </h1>
            <div class="bg-white shadow-lg rounded-md">
              <div class="grid grid-cols-3 p-5 gap-x-12 gap-y-10">
                <course-col1 title="test" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <copyright />
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import CardCourse from "@/Components/CardCourse";
import JetNavLink from "@/Jetstream/NavLink";
import SideMenu from "@/Components/Student/SideMenu.vue";
import JetButton from "@/Jetstream/Button.vue";
import Copyright from "@/Components/Common/Copyright.vue";
import CourseCol1 from "@/Components/Common/CourseCol1.vue";

export default {
  components: {
    AppLayout,
    CardCourse,
    JetNavLink,
    SideMenu,
    JetButton,
    Copyright,
    CourseCol1,
  },
};
</script>
