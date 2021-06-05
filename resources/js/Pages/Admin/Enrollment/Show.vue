<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        จัดการการลงทะเบียนเรียน
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
                สร้างการลงทะเบียนเรียน
              </h1>
              <jet-button :href="route('admin.enrollments.index')"
                >รายการการลงทะเบียนเรียน</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="id" value="รหัส" />
                  <jet-input
                    id="id"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    required
                    v-model="enrollment.id"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="id" value="หลักฐานการชำระเงิน" />
                </div>
                <hr />
                <img :src="enrollment.receipt_img" class="my-2 mx-auto" />
                <hr />
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="user_id" value="ผู้เรียน" />
                  <jet-select
                    v-model="enrollment.user_id"
                    required
                    id="user_id"
                    disabled
                  >
                    <option
                      v-for="student in students"
                      :key="student.id"
                      :value="student.id"
                    >
                      {{ student.fullName }}
                    </option>
                  </jet-select>
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="course_id" value="คอร์สเรียน" />
                  <jet-select
                    v-model="enrollment.course_id"
                    required
                    id="course_id"
                    disabled
                  >
                    <option
                      v-for="course in courses"
                      :key="course.id"
                      :value="course.id"
                    >
                      {{ course.name }}
                    </option>
                  </jet-select>
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="payment_method" value="ช่องทางการชำระเงิน" />
                  <jet-input
                    id="payment_method"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="enrollment.payment_method"
                    required
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="payment_date" value="วันที่ชำระเงิน" />
                  <jet-input
                    id="payment_date"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="enrollment.payment_date"
                    required
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="payment_status" value="สถานะการชำระเงิน" />
                  <jet-input
                    id="payment_status"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="enrollment.payment_status"
                    required
                    disabled
                  />
                </div>
              </form>
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
import JetInput from "@/Jetstream/Input.vue";
import LabelGrid from "@/Components/Common/LabelGrid.vue";
import JetSelect from "@/Jetstream/Select.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    JetButton,
    JetInput,
    LabelGrid,
    JetSelect,
    JetValidationErrors,
  },

  props: ["enrollment", "students", "courses"],

  data() {
    return {
      method_options: ["เงินสด", "ช่องทางออนไลน์"],
      status_options: ["ชำระเงินเรียบร้อย", "รอดำเนินการ", "ขอคืนเงิน"],
    };
  },
};
</script>
