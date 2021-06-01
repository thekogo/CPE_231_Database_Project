<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        จัดการบทเรียน
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
              <h1 class="text-2xl font-semibold mb-3">รายการบทเรียน</h1>
              <jet-button :href="route('admin.enrollments.create')"
                >เพิ่มบทเรียน</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <table class="table-auto">
                <thead>
                  <tr>
                    <th>ลำดับที่</th>
                    <th>ชื่อบทเรียน</th>
                    <th>จัดการ</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="text-center"
                    v-for="lesson in lessons"
                    :key="lesson.id"
                  >
                    <td>{{ lesson.lesson_order }}</td>
                    <td>{{ lesson.lesson_name }}</td>
                    <td class="flex gap-2 justify-center">
                      <jet-button
                        :href="
                          route('admin.lessons.show', { id: lesson.id })
                        "
                        >View</jet-button
                      >
                      <jet-button
                        color="warning"
                        :href="
                          route('admin.lessons.edit', { id: lesson.id })
                        "
                        >Edit</jet-button
                      >
                      <jet-button color="danger" @click="openDelete(lesson)"
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
import SideMenu from "@/Components/Admin/SideMenu.vue";
import JetButton from "@/Jetstream/Button.vue";
import Swal from "sweetalert2";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    JetButton,
  },
  props: ["lessons"],

  methods: {
    openDelete({ id }) {
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
            route(
              "admin.lessons.destroy",
              { lesson: id },
              {
                onSuccess: () => {
                  return;
                },
                onError: () => {
                  Swal.showValidationMessage(`Request failed: ${error}`);
                },
              }
            )
          );
        },
        allowOutsideClick: () => !Swal.isLoading(),
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Suscess",
            html: `ลบ ${lesson_name} เรียบร้อย`,
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
