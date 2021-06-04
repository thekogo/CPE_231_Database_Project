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
              <h1 class="text-2xl font-semibold mb-3">สร้างบทเรียน</h1>
              <div class="flex gap-2">
                <jet-button
                  :href="route('tutor.courses.show', { course: course.id })"
                  >กลับไปหน้าคอร์ส</jet-button
                >
                <jet-button
                  :href="
                    route('tutor.courses.lessons.index', { course: course.id })
                  "
                  >รายการบทเรียน</jet-button
                >
              </div>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="ชื่อ" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-3"
                    required
                    autofocus
                    autocomplete="name"
                    v-model="form.name"
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="vdo" value="ลิงค์วิดีโอ" />
                  <jet-input
                    id="vdo"
                    type="text"
                    class="mt-1 block w-full col-span-3"
                    required
                    autofocus
                    autocomplete="vdo"
                    v-model="form.vdo"
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="user_id" value="ลำดับ" />
                  <jet-input
                    id="user_id"
                    type="number"
                    class="mt-1 block w-full col-span-1"
                    v-model="form.order"
                    min="0"
                    :max="lessons.length"
                    required
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="description" value="รายละเอียด" />
                  <jet-text-area
                    class="mt-1 block w-full col-span-3"
                    v-model="form.description"
                    required
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
import SideMenu from "@/Components/Tutor/SideMenu.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetTextArea from "@/Jetstream/TextArea.vue";
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
    JetTextArea,
    JetSecondaryButton,
  },
  props: ["course", "lessons"],
  data() {
    return {
      form: this.$inertia.form({
        name: "",
        description: "",
        vdo: "",
        order: this.lessons.length,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(
        this.route("tutor.courses.lessons.store", { course: this.course.id }),
        {
          onSuccess: () => {
            Swal.fire({
              title: "Suscess",
              html: `เพิ่มบทเรียน <b>${this.form.name}</b> เรียบร้อย`,
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
                  route("tutor.courses.lessons.index", {
                    course: this.course.id,
                  })
                );
              }
            });
            this.form.reset();
            this.photoPreview = null;
          },
        }
      );
    },
  },
};
</script>
