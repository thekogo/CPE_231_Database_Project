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
              <h1 class="text-2xl font-semibold mb-3">เพิ่มบทเรียน</h1>
              <jet-button :href="route('admin.lessons.index')"
                >รายการบทเรียน</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
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
                  <label-grid for="order" value="ลำดับที่" />
                  <jet-input
                    id="order"
                    type="number"
                    class="mt-1 block w-full col-span-1"
                    required
                    autofocus
                    autocomplete="order"
                    v-model="form.order"
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="ชื่อบทเรียน" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-2"
                    required
                    autofocus
                    autocomplete="name"
                    v-model="form.name"
                  />
                </div>                
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="vdo_url" value="ลิงค์วิดีโอ" />
                  <jet-input
                    id="vdo_url"
                    type="text"
                    class="mt-1 block w-full col-span-2"
                    autofocus
                    autocomplete="vdo_url"
                    v-model="form.vdo_url"
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid
                    for="description"
                    value="รายละเอียดคอร์ส"
                  />
                  <jet-text-area
                    class="mt-1 block w-full col-span-3"
                    v-model="form.description"
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
import SideMenu from "@/Components/Admin/SideMenu.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetTextArea from "@/Jetstream/TextArea.vue";
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
    JetTextArea,
    LabelGrid,
    JetSelect,
    JetValidationErrors,

  },

  props: ["lesson", "courses"],

  data() {
    return {
      form: this.$inertia.form({
        name: this.lesson.name,
        order: this.lesson.order,
        vdo_url: this.lesson.vdo_url,
        desciption: this.lesson.desciption,
        course_id: this.lesson.course_id,
      })
    };
  },

  methods: {
    submit() {
      this.form.put(
        this.route("admin.lessons.update", { enroll: this.lesson.id }),
        {
          onSuccess: () => {
            Swal.fire({
              title: "Suscess",
              html: `แก้ไข บทที่ ${this.lesson.order} ${this.lesson.name} เรียบร้อย`,
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
                this.$inertia.get(route("admin.enrollment.index"));
              }
            });
            this.form.reset();
          },
        }
      );
    },
  },
};
</script>
