<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        จัดการ FAQ ใน {{ lesson.name }}
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
              <h1 class="text-2xl font-semibold mb-3">เพิ่ม FAQ</h1>
              <jet-button
                :href="
                  route('admin.courses.lessons.faqs.index', {
                    lesson: lesson.id,
                    course: course.id,
                  })
                "
                >FAQ ทั้งหมดใน {{ lesson.name }}</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="question" value="คำถาม" />
                  <jet-input
                    id="question"
                    type="text"
                    class="mt-1 block w-full col-span-3"
                    required
                    autofocus
                    autocomplete="question"
                    v-model="form.question"
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="answer" value="คำตอบ" />
                  <jet-text-area
                    class="mt-1 block w-full col-span-3"
                    v-model="form.answer"
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
import SideMenu from "@/Components/Admin/SideMenu.vue";
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
  props: ["course", "lesson"],
  data() {
    return {
      form: this.$inertia.form({
        question: "",
        answer: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(
        this.route("admin.courses.lessons.faqs.store", {
          lesson: this.lesson.id,
          course: this.course.id,
        }),
        {
          onSuccess: () => {
            Swal.fire({
              title: "Suscess",
              html: `เพิ่ม FAQ เรียบร้อย`,
              icon: "success",
              timer: 3000,
              timerProgressBar: true,
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "กลับไปหน้าหลัก",
              cancelButtonColor: "#d33",
              cancelButtonText: "ปิด",
            }).then((result) => {
              if (result.isConfirmed) {
                this.$inertia.get(
                  route("admin.courses.lessons.faqs.index", {
                    lesson: this.lesson.id,
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
