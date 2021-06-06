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
              <h1 class="text-2xl font-semibold mb-3">
                รายละเอียด : {{ lesson.name }}
              </h1>
              <div class="flex gap-2">
                <jet-button :href="route('admin.courses.index')"
                  >นักเรียนในคอร์ส</jet-button
                >
                <jet-button
                  :href="
                    route('admin.courses.lessons.index', { course: course.id })
                  "
                  >บทเรียนในคอร์ส</jet-button
                >
                <jet-button :href="route('admin.courses.index')"
                  >รายการคอร์ส</jet-button
                >
              </div>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
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
                    :value="lesson.name"
                    disabled
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
                    :value="lesson.vdo"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="user_id" value="ลำดับ" />
                  <jet-input
                    id="user_id"
                    type="number"
                    class="mt-1 block w-full col-span-1"
                    :value="lesson.order"
                    min="0"
                    required
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="description" value="รายละเอียด" />
                  <jet-text-area
                    class="mt-1 block w-full col-span-3"
                    :value="lesson.description"
                    required
                    disabled
                  />
                </div>
              </form>
            </div>
            <div class="flex justify-between mb-2 mt-3">
              <h1 class="text-2xl font-semibold mb-3">คำถามจากผู้เรียน</h1>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
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
                  <div>
                    <jet-button @click="AnswerQuestion(question.id)"
                      >ตอบ</jet-button
                    >
                  </div>
                </div>
                <hr />
              </div>
            </div>
            <div class="flex justify-end">
              <div class="flex items-center gap-4 mt-2">
                <jet-button
                  :href="
                    route('admin.courses.lessons.faqs.index', {
                      lesson: lesson.id,
                      course: course.id,
                    })
                  "
                  >คำถามที่พบบ่อย</jet-button
                >
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
import BoxContent from "@/Components/Common/BoxContent.vue";
import Swal from "sweetalert2";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    JetButton,
    JetInput,
    LabelGrid,
    JetTextArea,
    BoxContent,
  },
  props: ["lesson", "course"],

  data() {
    return {
      form: this.$inertia.form(),
    };
  },

  methods: {
    async AnswerQuestion(id) {
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
            this.route("admin.courses.lessons.questions.answers.store", {
              course: this.course.id,
              lesson: this.lesson.id,
              question: id,
            }),
            {
              onSuccess: () => {
                Swal.fire("ตอบคำถามนักเรียนสำเร็จ", "", "success");
              },
              onError: () => {
                Swal.fire("ตอบคำถามนักเรียนไม่สำเร็จ", "", "error");
              },
            }
          );
      }
    },
  },
};
</script>
