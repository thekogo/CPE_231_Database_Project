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
                เพิ่มบทเรียน
              </h1>
              <jet-button :href="route('admin.enrollments.index')"
                >รายการบทเรียน</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="lesson_order" value="ลำดับที่" />
                  <jet-input
                    id="lesson_order"
                    type="number"
                    class="mt-1 block w-full col-span-1"
                    required
                    autofocus
                    autocomplete="lesson_order"
                    v-model="lesson.lesson_order"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="lesson_name" value="ชื่อบทเรียน" />
                  <jet-input
                    id="lesson_name"
                    type="text"
                    class="mt-1 block w-full col-span-2"
                    required
                    autofocus
                    autocomplete="lesson_name"
                    v-model="lesson.lesson_name"
                    disabled
                  />
                </div>                
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="lesson_vdo" value="ลิงค์วิดีโอ" />
                  <jet-input
                    id="lesson_vdo"
                    type="text"
                    class="mt-1 block w-full col-span-2"
                    autofocus
                    autocomplete="lesson_vdo"
                    v-model="lesson.lesson_vdo"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid
                    for="course_description"
                    value="รายละเอียดคอร์ส"
                  />
                  <jet-text-area
                    class="mt-1 block w-full col-span-3"
                    v-model="lesson.course_description"
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
import JetTextArea from "@/Jetstream/TextArea.vue";

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

  props: ['lesson'],

  data() {
    return {
    };
  },
};
</script>
