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
              <div class="flex gap-2">
                <jet-button :href="route('student.enrollments.index')"
                  >ประวัติการลงทะเบียนทั้งหมด</jet-button
                >
              </div>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <table class="table-auto">
                <thead>
                  <tr>
                    <th>เลขที่จอง</th>
                    <th>คอร์ส</th>
                    <th>นักเรียน</th>
                    <th>วันที่จอง</th>
                    <th>จำนวนชั่วโมงที่จอง</th>
                    <th>สถานะ</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="text-center"
                    v-for="reserve in reserves"
                    :key="reserve.id"
                  >
                    <td>{{ reserve.id }}</td>
                    <td>{{ reserve.enrollment.course.name }}</td>
                    <td>{{ reserve.enrollment.user.fullName }}</td>
                    <td>{{ reserve.start_time }}</td>
                    <td>{{ reserve.hours_reserved }}</td>
                    <td>{{ reserve.status }}</td>
                    <td class="flex gap-2 justify-center">
                      <!-- <jet-button
                        :href="
                          route('admin.categories.show', { id: category.id })
                        "
                        ><i class="far fa-eye"></i
                      ></jet-button> -->
                      <jet-button
                        color="warning"
                        :href="route('admin.reserves.edit', { id: reserve.id })"
                        ><i class="far fa-edit"></i
                      ></jet-button>
                      <jet-button color="danger" @click="openDelete(reserve)"
                        ><i class="far fa-trash-alt"></i
                      ></jet-button>
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
  props: ["reserves"],

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
              "admin.reserves.destroy",
              { reserf: id },
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
            html: `ลบ ${enrollments.name} เรียบร้อย`,
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
