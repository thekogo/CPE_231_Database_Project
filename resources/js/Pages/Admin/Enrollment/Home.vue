<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        จัดการหมวดหมู่
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
              <h1 class="text-2xl font-semibold mb-3">รายการการลงทะเบียนเรียน</h1>
              <jet-button :href="route('admin.enrolls.create')"
                >สร้างการลงทะเบียนเรียน</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <table class="table-auto">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>คอร์ส</th>
                    <th>ช่องทางการชำระเงิน</th>
                    <th>วันที่ชำระเงิน</th>          
                    <th>สถานะการจ่ายเงิน</th>
                    <th>จัดการ</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="text-center"
                    v-for="enrollment in enrollments"
                    :key="enrollment.id"
                  >
                    <td>{{ enrollment.id }}</td>
                    <td>{{ enrollment.user_id }}</td>
                    <td>{{ enrollment.course_id }}</td>
                    <td>{{ enrollment.payment_method }}</td>
                    <td>{{ enrollment.payment_date }}</td>
                    <td>{{ enrollment.payment_status }}</td>
                    <td class="flex gap-2 justify-center">
                      <jet-button
                        :href="
                          route('admin.categories.show', { id: enrollment.id })
                        "
                        >View</jet-button
                      >
                      <jet-button
                        color="warning"
                        :href="
                          route('admin.categories.edit', { id: enrollment.id })
                        "
                        >Edit</jet-button
                      >
                      <jet-button color="danger" @click="openDelete(enrollment)"
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
  props: ["enrollments"],

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
              "admin.enrolls.destroy",
              { enroll: id },
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
            html: `ลบ ${enrollment_name} เรียบร้อย`,
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
