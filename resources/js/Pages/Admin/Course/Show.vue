<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        จัดการคอร์สเรียน
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
                รายละเอียดของ {{ course.name }}
              </h1>
              <div class="flex gap-2">
                <jet-button
                  :href="
                    route('admin.courses.students.index', { course: course.id })
                  "
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
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="id" value="รหัสคอร์ส" />
                  <jet-input
                    id="id"
                    type="text"
                    class="mt-1 block w-full col-span-3"
                    required
                    autofocus
                    autocomplete="id"
                    v-model="course.id"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="name" value="ชื่อคอร์ส" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full col-span-3"
                    required
                    autofocus
                    autocomplete="name"
                    :value="course.name"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="course_img" value="รูปปก" />
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
                  <label-grid for="user_id" value="ผู้สอน" />
                  <jet-input
                    id="status"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    :value="course.user.fullName"
                    required
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="description" value="รายละเอียดคอร์ส" />
                  <jet-text-area
                    class="mt-1 block w-full col-span-3"
                    :value="course.description"
                    required
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="price" value="ราคาคอร์ส" />
                  <jet-input
                    id="price"
                    type="number"
                    class="mt-1 block w-full col-span-1"
                    required
                    autofocus
                    autocomplete="price"
                    :value="course.price"
                    disabled
                  />
                  <label-grid for="price" class="ml-4" value="บาท" />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="hours_left" value="จำนวนชั่วโมง" />
                  <jet-input
                    id="hours_left"
                    type="number"
                    class="mt-1 block w-4/5 col-span-1"
                    required
                    autofocus
                    autocomplete="hours_left"
                    :value="course.hours_left"
                    disabled
                  />
                  <label-grid for="price" value="ชั่วโมง" />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="expire_date" value="วันหมดอายุ" />
                  <jet-input
                    id="birthday"
                    type="date"
                    class="mt-1 block w-full"
                    :value="course.expire_date"
                    required
                    disabled
                  />
                </div>

                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="selected_categories" value="หมวดหมู่" />
                  <multiselect
                    v-model="selected_categories"
                    :options="options_categories"
                    mode="tags"
                    :searchable="true"
                    class="col-span-3 w-full"
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="status" value="สถานะ" />
                  <jet-input
                    id="status"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    :value="course.status"
                    required
                    disabled
                  />
                </div>                
              </form>
            </div>
            <div class="flex justify-between mb-2 mt-3">
              <h1 class="text-2xl font-semibold mb-3">รีวิว</h1>
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <div v-for="review in reviews" :key="review.id">
                <div class="flex justify-between gap-2">
                  <div class="flex-grow">
                    <h1 class="text-2xl">
                      <b class="text-3xl">{{ review.rating }}</b> | {{ review.description }}
                    </h1>
                    <hr />
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
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Multiselect from "@vueform/multiselect";

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
    Multiselect,
  },
  props: ["reviews", "course", "categories"],
  data() {
    return {
      options: ["เผยแพร่", "ปิดการมองเห็น"],
      photoPreview: this.course.course_img,
      options_categories: this.categories.map((category) => category.name),
      selected_categories: this.course.course_categories.map(
        (item) => item.category.name
      ),
    };
  },

  mounted() {
    console.log(this.course);
  },

  methods: {
    submit() {
      this.form.post(this.route("admin.courses.store"), {
        onSuccess: () => {
          Swal.fire({
            title: "Suscess",
            html: `เพิ่ม ${this.form.name} เรียบร้อย`,
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
              this.$inertia.get(route("admin.courses.index"));
            }
          });
          this.form.reset();
          this.photoPreview = null;
        },
      });
    },
    selectNewPhoto() {
      this.$refs.photo.click();
    },
    updatePhotoPreview(event) {
      const reader = new FileReader();

      this.form.course_img = event.target.files[0];
      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.photo.files[0]);
    },
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
