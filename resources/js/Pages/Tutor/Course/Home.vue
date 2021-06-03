<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        จัดการคอร์สเรียน
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
              <h1 class="text-2xl font-semibold mb-3">คอร์สเรียนทั้งหมด</h1>
              <jet-button :href="route('tutor.courses.create')"
                >สร้างคอร์สเรียน</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <table class="table-auto">
                <thead>
                  <tr>
                    <th>รหัส</th>
                    <th>ชื่อคอร์ส</th>
                    <th>สถานะ</th>
                    <th>ราคา</th>
                    <th>ผู้สอน</th>
                    <th>แก้ไข</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="text-center"
                    v-for="course in courses"
                    :key="course.name"
                  >
                    <td>#{{ course.id }}</td>
                    <td>{{ course.name }}</td>
                    <td>{{ course.status }}</td>
                    <td>{{ course.price }} บาท</td>
                    <td>{{ course.user.fullName }}</td>
                    <td class="flex gap-2 justify-center">
                      <jet-button
                        :href="route('tutor.courses.show', { id: course.id })"
                        >View</jet-button
                      >
                      <jet-button
                        color="warning"
                        :href="route('tutor.courses.edit', { id: course.id })"
                        >Edit</jet-button
                      >
                      <jet-button color="danger" @click="openDelete(course)"
                        >Delete</jet-button
                      >
                    </td>
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
import Swal from "sweetalert2";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    JetButton,
  },
  props: ["courses"],

  methods: {
    openDelete({ id, name }) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        showLoaderOnConfirm: true,
        preConfirm: () => {
          return this.$inertia.delete(
            route("tutor.courses.destroy", { course: id }),
            {
              onSuccess: () => {
                return;
              },
              onError: () => {
                Swal.showValidationMessage(`Request failed: ${error}`);
              },
            }
          );
        },
        allowOutsideClick: () => !Swal.isLoading(),
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Suscess",
            html: `ลบคอร์ส  ${name}  เรียบร้อย`,
            icon: "success",
            timer: 2000,
            timerProgressBar: true,
          });
        }
      });
    },
  },
};
</script>
