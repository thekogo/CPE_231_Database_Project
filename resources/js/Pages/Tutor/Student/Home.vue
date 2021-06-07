<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        นักเรียนใน {{ course.name }}
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
              <h1 class="text-2xl font-semibold mb-3">
                นักเรียนทั้งหมดใน {{ course.name }}
              </h1>  
              <jet-button
                  :href="route('tutor.courses.show', { course: course.id })"
                  >กลับหน้าคอร์ส</jet-button
                >            
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <table class="table-auto">
                <thead>
                  <tr>
                    <th>รหัสนักเรียน</th>
                    <th>ชื่อ - นามสกุล</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="text-center"
                    v-for="enrollment in enrollments"
                    :key="enrollment.id"
                  >
                    <td>#{{ enrollment.user.id }}</td>
                    <td>{{ enrollment.user.fullName }}</td>                    
                  </tr>
                </tbody>
              </table>
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
import SideMenu from "@/Components/Tutor/SideMenu.vue";
import JetButton from "@/Jetstream/Button.vue";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    JetButton,
  },
  props: ["course", "enrollments"],  
};
</script>
