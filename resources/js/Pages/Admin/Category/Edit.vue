<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        จัดการหมวดหมู่
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
              <h1 class="text-2xl font-semibold mb-3">สร้างหมวดหมู่</h1>
              <jet-button :href="route('admin.categories.index')"
                >รายการหมวดหมู่</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="category_name" value="Category Name" />
                  <jet-input
                    id="category_name"
                    type="text"
                    class="mt-1 block w-full col-span-3"
                    required
                    autofocus
                    autocomplete="category_name"
                    v-model="form.category_name"
                  />
                </div>
                <div class="grid grid-cols-5 mb-2">
                  <label-grid for="category_display" value="Category Display" />
                  <jet-select
                    :options="options"
                    v-model="form.category_display"
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
import SideMenu from "@/Components/Student/SideMenu.vue";
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

  props: ["category"],

  data() {
    return {
      options: ["Active", "Draft"],
      form: this.$inertia.form({
        category_name: this.category.category_name,
        category_display: this.category.category_display,
      }),
    };
  },

  methods: {
    submit() {
      // console.log(this.form);
      this.form.put(
        this.route("admin.categories.update", { category: this.category.id }),
        {
          onSuccess: () => {
            Swal.fire({
              title: "Suscess",
              html: `แก้ไข ${this.form.category_name} เรียบร้อย`,
              icon: "success",
              timer: 2000,
              timerProgressBar: true,
            });
          },
        }
      );
    },
  },
};
</script>
