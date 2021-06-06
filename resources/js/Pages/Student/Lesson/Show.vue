<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        คอร์สของฉัน
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
                บทเรียน : {{ lesson.name }}
              </h1>
              <jet-button
                color="warning"
                :href="route('student.enrollments.index')"
                >เรียนจบแล้ว</jet-button
              >
              <jet-button
                :href="route('student.courses.show', { course: course.id })"
                >กลับไปหน้าคอร์ส</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="ลำดับบทเรียน" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    autocomplete="name"
                    :value="lesson.order"
                    disabled
                  />
                </div>
                <hr />
                <iframe
                  class="mx-auto my-2 h-64 w-96"
                  src="https://www.youtube.com/embed/IQw-4JABPCM"
                  title="YouTube video player"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
                <hr />
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="คำอธิบาย" />
                  <jet-text-area
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-3"
                    autocomplete="name"
                    :value="lesson.description"
                    disabled
                  />
                </div>
              </form>
            </div>
            <div class="flex justify-between mb-2 mt-3">
              <h1 class="text-2xl font-semibold mb-3">คำถามที่พบบ่อย</h1>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <div v-for="faq in lesson.faqs" :key="faq.id">
                <div class="flex justify-between gap-2">
                  <div class="flex-grow">
                    <h1 class="text-2xl">#{{ faq.id }}</h1>                    
                    <p>
                      <b>{{ faq.question }}</b>
                    </p>
                    <hr />
                    <p> 
                      {{ faq.answer }}
                    </p>
                  </div>                  
                </div>
              </div>
            </div>
            <div class="flex justify-between mb-2 mt-3">
              <h1 class="text-2xl font-semibold mb-3">สอบถาม</h1>
              <div>
                <jet-button @click="openCreate">สอบถามผู้สอน</jet-button>
              </div>
            </div>
            <div
              class="
                bg-white
                shadow-lg
                rounded-md
                p-5
                flex flex-col
                gap-4
                divide-y-2 divide-yellow-500
              "
            >
              <div v-for="question in lesson.questions" :key="question.id">
                <div class="flex justify-between gap-2">
                  <div class="flex-grow">
                    <h1 class="text-2xl">#{{ question.id }}</h1>
                    <p>
                      {{ question.description }}
                    </p>
                    <hr />
                    <b>คำตอบ</b>
                    <p v-if="question.answers.length == 0">ยังไม่มีคำตอบ</p>
                    <p v-for="answer in question.answers" :key="answer.id">
                      {{ answer.description }}
                    </p>
                  </div>
                </div>
              </div>
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
    LabelGrid,
    JetSelect,
    JetValidationErrors,
    JetTextArea,
  },

  props: ["lesson", "course", "questions"],

  data() {
    return {
      form: this.$inertia.form(),
    };
  },

  methods: {
    async openCreate() {
      const { value: text } = await Swal.fire({
        input: "textarea",
        inputLabel: "Message",
        inputPlaceholder: "Type your message here...",
        inputAttributes: {
          "aria-label": "Type your message here",
        },
        showCancelButton: true,
      });

      if (text) {
        console.log(text);
        this.form
          .transform((data) => ({
            ...data,
            description: text,
          }))
          .post(
            this.route("student.courses.lessons.questions.store", {
              course: this.course.id,
              lesson: this.lesson.id,
            }),
            {
              onSuccess: () => {
                Swal.fire("ส่งคำถามไปยังติวเตอร์เสร็จสิ้น", "", "success");
              },
              onError: () => {
                Swal.fire("ส่งคำถามไปยังติวเตอร์ไม่สำเร็จ", "", "error");
              },
            }
          );
      }
    },
  },
};
</script>
