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
              <table class="table-auto">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="text-center"
                    v-for="enrollment in enrollments"
                    :key="enrollment.id"
                  >
                    <td>{{ enrollment.id }}</td>
                    <td>{{ enrollment.course.name }}</td>
                    <td>{{ enrollment.payment_date }}</td>
                    <td>{{ enrollment.payment_status }}</td>
                    <td class="flex gap-2 justify-center">
                      <jet-button
                        :href="
                          route('student.enrollments.show', {
                            id: enrollment.id,
                          })
                        "
                        ><i class="far fa-eye"></i
                      ></jet-button>
                      <jet-button
                        v-if="payment_status != 'รอดำเนินการ'"
                        color="warning"
                        :href="
                          route('student.enrollments.edit', {
                            id: enrollment.id,
                          })
                        "
                        ><i class="far fa-edit"></i
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
  props: ["enrollments"],
};
</script>
