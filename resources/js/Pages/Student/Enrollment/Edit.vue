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
              <h1 class="text-2xl font-semibold mb-3">สร้างหมวดหมู่</h1>
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
                  <input
                    type="file"
                    class="hidden"
                    ref="receipt"
                    @change="updatePhotoPreview"
                  />
                  <label-grid for="receipt_img" value="หลักฐานการโอนเงิน" />
                  <jet-secondary-button
                    id="receipt_img"
                    class="col-span-1"
                    type="button"
                    @click.prevent="selectNewPhoto"
                  >
                    Edit Receipt
                  </jet-secondary-button>
                </div>
                <div class="my-2" v-show="photoPreview">
                  <hr />
                  <img
                    :src="photoPreview"
                    class="h-64 w-80 object-cover mx-auto my-1 rounded-md"
                  />
                  <hr />
                </div>

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
import SideMenu from "@/Components/Student/SideMenu.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import LabelGrid from "@/Components/Common/LabelGrid.vue";
import JetSelect from "@/Jetstream/Select.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import Swal from "sweetalert2";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

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
    JetSecondaryButton,
  },

  props: ["enrollment"],

  data() {
    return {
      options: ["Active", "Draft"],
      form: this.$inertia.form({
        _method: "put",
        receipt_img: null,
      }),
      photoPreview: this.enrollment.receipt_img,
    };
  },

  methods: {
    submit() {
      if (this.$refs.receipt) {
        this.form.receipt_img = this.$refs.receipt.files[0];
      }
      this.form.post(
        this.route("student.enrollments.update", {
          enrollment: this.enrollment.id,
        }),
        {
          onSuccess: () => {
            Swal.fire({
              title: "Suscess",
              html: `แก้ form เรียบร้อย`,
              icon: "success",
              timer: 3000,
              timerProgressBar: true,
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "กลับไปหน้าจัดการทั้งหมด",
              cancelButtonColor: "#d33",
              cancelButtonText: "ปิด",
            }).then((result) => {
              if (result.isConfirmed) {
                this.$inertia.get(route("student.enrollments.index"));
              }
            });
            this.form.reset();
          },
        }
      );
    },
    selectNewPhoto() {
      this.$refs.receipt.click();
    },
    updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.receipt.files[0]);
    },
  },
};
</script>
