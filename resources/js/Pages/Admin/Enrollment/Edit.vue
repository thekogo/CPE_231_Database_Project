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
                แก้ไขการลงทะเบียนเรียน
              </h1>
              <jet-button :href="route('admin.enrollments.index')"
                >รายการการลงทะเบียนเรียน</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="user_id" value="ผู้เรียน" />
                  <jet-select v-model="form.user_id" required id="user_id">
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
                  <jet-select v-model="form.course_id" required id="course_id">
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
                  <jet-select
                    id="payment_method"
                    v-model="form.payment_method"
                    required
                  >
                    <option
                      v-for="option in method_options"
                      :key="option"
                      :value="option"
                    >
                      {{ option }}
                    </option>
                  </jet-select>
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="payment_date" value="วันที่ชำระเงิน" />
                  <jet-input
                    id="payment_date"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.payment_date"
                    required
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="payment_status" value="สถานะการชำระเงิน" />
                  <jet-select
                    id="payment_status"
                    v-model="form.payment_status"
                    required
                  >
                    <option
                      v-for="option in status_options"
                      :key="option"
                      :value="option"
                    >
                      {{ option }}
                    </option>
                  </jet-select>
                </div>
                <div class="flex justify-end">
                  <jet-button>บันทึก</jet-button>
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
import Swal from "sweetalert2";

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
      form: this.$inertia.form({
        user_id: this.enrollment.user_id,
        course_id: this.enrollment.course_id,
        payment_method: this.enrollment.payment_method,
        payment_date: this.enrollment.payment_date,
        payment_status: this.enrollment.payment_status,
      }),
      method_options: ["เงินสด", "ช่องทางออนไลน์"],
      status_options: ["ชำระเงินเรียบร้อย", "รอดำเนินการ", "ขอคืนเงิน"],
    };
  },

  methods: {
    submit() {
      console.log(this.form);
      this.form.put(
        this.route("admin.enrollments.update", {
          enrollment: this.enrollment.id,
        }),
        {
          onSuccess: () => {
            Swal.fire({
              title: "Suscess",
              html: `แก้ #${this.enrollment.id} เรียบร้อย`,
              icon: "success",
              timer: 3000,
              timerProgressBar: true,
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "กลับหน้าหลัก",
              cancelButtonColor: "#d33",
              cancelButtonText: "ปิด",
            }).then((result) => {
              if (result.isConfirmed) {
                this.$inertia.get(route("admin.enrollment.index"));
              }
            });
          },
        }
      );
    },
  },
};
</script>
