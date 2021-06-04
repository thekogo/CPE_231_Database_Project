<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        จัดการคอร์สเรียน : {{ course.name }}
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
                รายละเอียดบทเรียน : {{ lesson.name }}
              </h1>
              <div class="flex gap-2">
                <jet-button :href="route('tutor.courses.index')"
                  >นักเรียนในคอร์ส</jet-button
                >
                <jet-button
                  :href="
                    route('tutor.courses.lessons.index', { course: course.id })
                  "
                  >บทเรียนในคอร์ส</jet-button
                >
                <jet-button :href="route('tutor.courses.index')"
                  >รายการคอร์ส</jet-button
                >
              </div>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="ชื่อบทเรียน" />
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
                  <label-grid for="vdo" value="ลิ้งค์ Vdo" />
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
                  <label-grid for="user_id" value="ลำดับบทเรียน" />
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
                  <label-grid for="description" value="รายละเอียดคอร์ส" />
                  <jet-text-area
                    class="mt-1 block w-full col-span-3"
                    :value="lesson.description"
                    required
                    disabled
                  />
                </div>
              </form>
            </div>
            <div class="flex justify-between">
              <h1 class="text-2xl font-semibold mb-3 mt-2">
                คำถามที่ยังไม่ได้ตอบ
              </h1>
              <div class="flex items-center gap-4">
                <jet-button>สร้างคำถามที่พบบ่อย</jet-button>
                <jet-button
                  :href="
                    route('tutor.courses.lessons.questions.index', {
                      course: course.id,
                      lesson: lesson.id,
                    })
                  "
                  >คำถามทั้งหมด</jet-button
                >
              </div>
            </div>
            <box-content class="flex flex-col gap-4">
              <div class="flex justify-between gap-2">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Nihil quaerat sunt asperiores reiciendis perspiciatis?
                  Doloremque illum necessitatibus, molestiae, nobis corporis et
                  omnis nam expedita consequatur esse voluptatum reprehenderit
                  laboriosam enim?
                </p>
                <jet-button>test</jet-button>
              </div>
              <hr />
              <div class="flex justify-between gap-2">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Nihil quaerat sunt asperiores reiciendis perspiciatis?
                  Doloremque illum necessitatibus, molestiae, nobis corporis et
                  omnis nam expedita consequatur esse voluptatum reprehenderit
                  laboriosam enim? Lorem ipsum dolor sit amet, consectetur
                  adipisicing elit. Nihil quaerat sunt asperiores reiciendis
                  perspiciatis? Doloremque illum necessitatibus, molestiae,
                  nobis corporis et omnis nam expedita consequatur esse
                  voluptatum reprehenderit laboriosam enim?
                </p>
                <jet-button>test</jet-button>
              </div>
            </box-content>
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
import BoxContent from "@/Components/Common/BoxContent.vue";

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
};
</script>
