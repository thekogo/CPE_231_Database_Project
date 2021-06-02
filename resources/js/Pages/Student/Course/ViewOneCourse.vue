<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Dashboard 2
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-center text-4xl">คอร์สเรียน</h1>
        <div class="grid grid-cols-12 gap-4">
          <div class="col-span-9">
            <h1 class="text-2xl">ชื่อคอร์ส</h1>
            <div class="bg-pinkn h-72"></div>
            <br />
            <div class="bg-pinkn h-60"></div>
            <h1 class="text-center text-2xl mt-5">Lecture</h1>
            <div
              class="font-sans flex items-center justify-center bg-blue-darker w-full py-8"
            >
              <div
                class="overflow-hidden bg-white rounded max-w-xs w-full shadow-lg leading-normal"
              >
                <a href="#" class="block group hover:bg-blue p-4 border-b">
                  <p
                    class="font-bold text-lg mb-1 text-black group-hover:text-white"
                  >
                    Create from scratch
                  </p>
                  <p class="text-grey-darker mb-2 group-hover:text-white">
                    Create a repository without any source code
                  </p>
                </a>
                <a href="#" class="block group hover:bg-blue p-4">
                  <p
                    class="font-bold text-lg mb-1 text-black group-hover:text-white"
                  >
                    Fork
                  </p>
                  <p class="text-grey-darker mb-2 group-hover:text-white">
                    Start a project base on the source of an existing one.
                  </p>
                </a>
              </div>
            </div>
          </div>

          <div class="col-span-3">
            <button
              class="bg-purplen text-white w-full p-1 rounded-lg hover:bg-bluen shadow-xl"
            >
              <i class="fas fa-cart-plus"></i> สั่งซื้อ
            </button>
            <div class="bg-white shadow-lg rounded-md p-5 mt-3">
              <div
                class="rounded-full w-20 h-20 bg-bluen mx-auto border-purplen border-4"
              ></div>
              <h1 class="mt-3">ชื่อผู้สอน :</h1>
              <h1 class="mt-3">ประวัติการศึกษา :</h1>
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
