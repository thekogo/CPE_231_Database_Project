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
              <h1 class="text-2xl font-semibold mb-3">สร้างคอร์สเรียน</h1>
              <jet-button :href="route('tutor.courses.index')"
                >รายการคอร์ส</jet-button
              >
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
                    v-model="form.id"
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
                    v-model="form.name"
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <input
                    type="file"
                    class="hidden"
                    ref="photo"
                    @change="updatePhotoPreview"
                  />
                  <label-grid for="course_img" value="รูปปก" />
                  <jet-secondary-button
                    id="course_img"
                    class="col-span-1"
                    type="button"
                    @click.prevent="selectNewPhoto"
                  >
                    Select A New Photo
                  </jet-secondary-button>
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
                    id="user_id"
                    type="text"
                    class="mt-1 block w-full col-span-1"
                    :value="tutor.fullName"
                    required
                    disabled
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="description" value="รายละเอียดคอร์ส" />
                  <jet-text-area
                    class="mt-1 block w-full col-span-3"
                    v-model="form.description"
                    required
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
                    v-model="form.price"
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
                    v-model="form.hours_left"
                  />
                  <label-grid for="price" value="ชั่วโมง" />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="expire_date" value="วันหมดอายุ" />
                  <jet-input
                    id="birthday"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.expire_date"
                    required
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="selected_categories" value="หมวดหมู่" />
                  <multiselect
                    v-model="form.selected_categories"
                    :options="options_categories"
                    mode="tags"
                    :searchable="true"
                    :createTag="true"
                    class="col-span-3 w-full"
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

<style src="@vueform/multiselect/themes/default.css"></style>

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
  props: ["tutor", "categories"],
  data() {
    return {
      form: this.$inertia.form({
        id:"",
        name: "",
        description: "",
        price: null,
        status: "",
        expire_date: "",
        hours_left: null,
        course_img: null,
        selected_categories: [],
      }),
      photoPreview: null,
      options: this.categories.map((category) => category.name),
      options_categories: this.categories.map((category) => category.name),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("tutor.courses.store"), {
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
              this.$inertia.get(route("tutor.courses.index"));
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

