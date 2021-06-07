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
              <h1 class="text-2xl font-semibold mb-3">จองเวลาเรียน</h1>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="คอร์สที่ต้องการจอง" />
                  <jet-select v-model="form.course_id" required>
                    <option
                      v-for="enrollment in enrollments"
                      :key="enrollment.id"
                      :value="enrollment.course.id"
                    >
                      {{ enrollment.course.name }}
                    </option>
                  </jet-select>
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="เวลาที่จอง" />
                  <jet-input
                    type="datetime-local"
                    class="mt-1 block w-full col-span-1"
                    required
                    autofocus
                    v-model="form.start_time"
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="จำนวนชั่วโมงที่จอง" />
                  <jet-input
                    id="name"
                    type="number"
                    class="mt-1 block w-full col-span-1"
                    required
                    v-model="form.hours_reserved"
                  />
                </div>

                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="ตำแหน่งที่นั่ง" />
                  <jet-select v-model="form.position" required>
                    <option v-for="option in positions" :key="option">
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
  props: ["enrollments", "course"],

  data() {
    return {
      form: this.$inertia.form({
        course_id: null,
        start_time: null,
        hours_reserved: null,
        position: null,
      }),
      positions: [
        "A01",
        "A02",
        "A03",
        "A04",
        "A05",
        "A06",
        "A07",
        "A08",
        "A09",
        "A10",
      ],
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("student.reserves.store"), {
        onSuccess: () => {
          Swal.fire({
            title: "Suscess",
            html: `จองเวลาเรียบร้อย`,
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
              this.$inertia.get(
                route("student.courses.reserves.index", {
                  course: this.course.id,
                })
              );
            }
          });
          this.form.reset();
        },
      });
    },
  },
};
</script>
