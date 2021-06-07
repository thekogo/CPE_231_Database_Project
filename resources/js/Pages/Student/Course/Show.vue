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
              <h1 class="text-2xl font-semibold mb-3 flex gap-2 items-center">
                คอร์ส : {{ course.name }}
                <jet-button v-show="!is_reviewed" @click="reviewCourse"
                  >Review</jet-button
                >
                <div
                  class="
                    rounded-full
                    h-7
                    w-7
                    flex
                    items-center
                    justify-center
                    bg-yellow-300
                  "
                  v-show="is_reviewed"
                >
                  <i class="fas fa-check"></i>
                </div>
              </h1>
              <div class="flex gap-2">
                <jet-button :href="route('student.reserves.index')"
                  >จองเวลาเรียน</jet-button
                >
                <jet-button :href="route('student.enrollments.index')"
                  >ประวัติการลงทะเบียนทั้งหมด</jet-button
                >
              </div>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <div>
                <img :src="course.course_img" class="mx-auto" />
              </div>
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="เลขที่คอร์ส" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    autocomplete="name"
                    :value="course.id"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="ชื่อคอร์ส" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    autocomplete="name"
                    :value="course.name"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="ชื่อผู้สอน" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    autocomplete="name"
                    :value="course.user.fullName"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="วันหมดอายุ" />
                  <jet-input
                    id="name"
                    type="date"
                    class="mt-1 block w-full col-span-1"
                    autocomplete="name"
                    :value="course.expire_date"
                    disabled
                  />
                </div>
              </form>
            </div>
            <div class="flex justify-between mb-2 mt-3">
              <h1 class="text-2xl font-semibold mb-3">บทเรียน</h1>
              <jet-button :href="route('student.enrollments.index')"
                >ประวัติการลงทะเบียนทั้งหมด</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <div v-for="lesson in course.lessons" :key="lesson.id">
                <div class="flex justify-between gap-2">
                  <div>
                    <h1 class="text-2xl flex gap-2 items-center">
                      #{{ lesson.order }} {{ lesson.name }}
                      <div
                        class="
                          rounded-full
                          h-7
                          w-7
                          flex
                          items-center
                          justify-center
                          bg-yellow-300
                        "
                        v-if="lesson.is_learned"
                      >
                        <i class="fas fa-check"></i>
                      </div>
                    </h1>
                    <p>{{ lesson.description }}</p>
                  </div>
                  <div class="flex items-center">
                    <jet-button
                      :href="
                        route('student.courses.lessons.show', {
                          course: course.id,
                          lesson: lesson.id,
                        })
                      "
                      >Go</jet-button
                    >
                  </div>
                </div>
                <hr />
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

  props: ["course", "is_reviewed"],

  data() {
    return {
      form: this.$inertia.form({
        course_id: this.course.id,
      }),
    };
  },

  methods: {
    async reviewCourse() {
      const { value: formValues } = await Swal.fire({
        title: "Multiple inputs",
        html:
          "ข้อความรีวิว" +
          '<textarea id="swal-input1" class="swal2-input"></textarea><br />' +
          'คะแนน <input id="swal-input2" class="swal2-input" type="number" value="3" min="0" max="5">',
        focusConfirm: false,
        preConfirm: () => {
          return [
            document.getElementById("swal-input1").value,
            document.getElementById("swal-input2").value,
          ];
        },
      });

      if (formValues) {
        const descriptionData = formValues[0];
        const scoreData = formValues[1];
        console.log(formValues);
        this.form
          .transform((data) => ({
            ...data,
            description: descriptionData,
            rating: scoreData,
          }))
          .post(
            this.route("student.courses.reviews.store", {
              course: this.course.id,
            }),
            {
              onSuccess: () => {
                Swal.fire("บันทึกสำเร็จ", "", "success");
              },
              onError: () => {
                Swal.fire("บันทึกไม่สำเร็จ", "", "error");
              },
            }
          );
      }
    },
  },
};
</script>
