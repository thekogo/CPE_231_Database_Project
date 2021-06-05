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
              <h1 class="text-2xl font-semibold mb-3">ประวัติการลงทะเบียน</h1>
              <jet-button :href="route('student.enrollments.index')"
                >ประวัติการลงทะเบียนทั้งหมด</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="เลขที่อ้างอิง" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    autocomplete="name"
                    :value="enrollment.id"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="หลังฐานการโอนเงิน" />
                  <!-- <img
                    id="name"
                    type="text"
                    class="mt-1 block mx-auto"
                    autocomplete="name"
                    :src="enrollment.receipt_img"
                    disabled
                  /> -->
                </div>
                <hr />
                <img class="mx-auto my-2" :src="enrollment.receipt_img" />
                <hr />

                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="ชื่อคอร์ส" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-3"
                    autocomplete="name"
                    :value="enrollment.course.name"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="วันที่ชำระเงิน" />
                  <jet-input
                    id="name"
                    type="date"
                    class="mt-1 block w-full col-span-1"
                    autocomplete="name"
                    :value="enrollment.payment_date"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="สถานะการชำระเงิน" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    :value="enrollment.payment_status"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="Enroll Date" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    :value="enrollment.enroll_date"
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

  props: ["enrollment"],

  data() {
    return {
      options: ["Active", "Draft"],
    };
  },
};
</script>
