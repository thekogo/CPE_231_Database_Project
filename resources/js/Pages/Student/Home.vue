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
          <div class="col-span-9 bg-white shadow-lg rounded-md">test</div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import CardCourse from "@/Components/CardCourse";
import JetNavLink from "@/Jetstream/NavLink";
import SideMenu from "@/Components/Student/SideMenu.vue";

export default {
  components: {
    AppLayout,
    CardCourse,
    JetNavLink,
    SideMenu,
  },
};
</script>
