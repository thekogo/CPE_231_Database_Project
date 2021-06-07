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
            <div class="flex justify-between mb-2">
              <h1 class="text-2xl font-semibold mb-3">คอร์สที่เรียนล่าสุด</h1>
            </div>
            <div class="bg-white shadow-lg rounded-md">
              <div class="grid grid-cols-3 p-5 gap-20" v-if="last_lesson">
                <div class="col-span-1">
                  <img
                    class="bg-red-900 h-60 rounded-lg"
                    :src="last_lesson.lesson.course.course_img"
                  />
                </div>
                <div class="col-span-2">
                  <h1 class="text-xl">
                    ชื่อคอร์ส : {{ last_lesson.lesson.course.name }}
                  </h1>
                  <p class="mb-5">
                    รายละเอียดคอร์ส :
                    {{ last_lesson.lesson.course.description }}
                  </p>
                  <jet-button
                    :href="
                      route('student.courses.lessons.show', {
                        course: last_lesson.lesson.course.id,
                        lesson: last_lesson.lesson.id,
                      })
                    "
                    >continues</jet-button
                  >
                </div>
              </div>
            </div>
            <h1 class="text-2xl font-semibold mt-10 mb-3">
              คอร์สที่กำลังเรียน
            </h1>
            <div class="bg-white shadow-lg rounded-md">
              <div class="grid grid-cols-3 p-5 gap-12">
                <a
                  :href="
                    route('student.courses.show', {
                      course: enrollment.course.id,
                    })
                  "
                  v-for="enrollment in enrollments"
                  :key="enrollment.course.id"
                >
                  <course-col1
                    :src="enrollment.course.course_img"
                    :title="enrollment.course.name"
                  />
                </a>
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
import CourseCol1 from "@/Components/Common/CourseCol1";

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

  props: ["last_lesson", "enrollments"],
};
</script>
