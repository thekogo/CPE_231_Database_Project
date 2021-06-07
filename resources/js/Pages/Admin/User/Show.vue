<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        จัดการผู้ใช้
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
              <h1 class="text-2xl font-semibold mb-3">รายละเอียด</h1>
              <jet-button :href="route('admin.users.index')"
                >กลับไปหน้าจัดการ</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <jet-validation-errors class="mb-4" />
              <form @submit.prevent="submit">
                <div class="grid grid-cols-5 mb-2 gap-4">
                  <div class="col-span-2">
                    <jet-label for="firstName" value="First Name" />
                    <jet-input
                      id="firstName"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.firstName"
                      required
                      autofocus
                      autocomplete="firstName"
                      disabled
                    />
                  </div>

                  <div class="col-span-2">
                    <jet-label for="lastName" value="Last Name" />
                    <jet-input
                      id="lastName"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.lastName"
                      required
                      autofocus
                      autocomplete="lastName"
                      disabled
                    />
                  </div>
                </div>

                <div>
                  <jet-label for="address" value="Address" />
                  <jet-text-area
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    required
                    autofocus
                    autocomplete="address"
                    disabled
                  />
                </div>

                <div class="grid grid-cols-2 gap-5">
                  <div>
                    <jet-label for="birthday" value="Birth Day" />
                    <jet-input
                      id="birthday"
                      type="date"
                      class="mt-1 block w-full"
                      v-model="form.birthday"
                      required
                      autofocus
                      autocomplete="birthday"
                      disabled
                    />
                  </div>

                  <div>
                    <jet-label for="phoneNumber" value="Phone Number" />
                    <jet-input
                      id="phoneNumber"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.phoneNumber"
                      required
                      autofocus
                      autocomplete="phoneNumber"
                      disabled
                    />
                  </div>
                </div>

                <div class="mt-4">
                  <jet-label for="facebook" value="Facebook" />
                  <jet-input
                    id="facebook"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.facebook"
                    required
                    disabled
                  />
                </div>

                <div class="mt-4">
                  <jet-label for="email" value="Email" />
                  <jet-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    disabled
                  />
                </div>
                <div class="mt-4">
                  <jet-label for="email" value="Role" />
                  <jet-select v-model="form.role" required id="role" disabled>
                    <option v-for="role in roles" :key="role">
                      {{ role }}
                    </option>
                  </jet-select>
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
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetTextArea from "@/Jetstream/TextArea";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
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
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetTextArea,
    JetCheckbox,
    JetLabel,
  },

  props: ["user"],

  data() {
    return {
      options: ["Active", "Draft"],
      form: this.$inertia.form({
        ...this.user,
      }),
      roles: ["admin", "tutor", "student"],
    };
  },

  methods: {
    submit() {
      // console.log(this.form);
      this.form.put(this.route("admin.users.update", { user: this.user.id }), {
        onSuccess: () => {
          Swal.fire({
            title: "Suscess",
            html: `แก้ไขข้อมูลเรียบร้อย`,
            icon: "success",
            timer: 3000,
            timerProgressBar: true,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "กลับไปหน้าจัดการทั้งหมด",
            cancelButtonColor: "#d33",
            cancelButtonText: "ปิด",
          }).then((result) => {
            if (result.isConfirmed) {
              this.$inertia.get(route("admin.categories.index"));
            }
          });
        },
      });
    },
  },
};
</script>
