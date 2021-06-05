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
              <h1 class="text-2xl font-semibold mb-3">
                FAQ ทั้งหมดใน {{ lesson.name }}
              </h1>
              <jet-button
                :href="
                  route('admin.courses.lessons.faqs.create', {
                    lesson: lesson.id,
                    course: course.id,
                  })
                "
                >เพิ่ม FAQ</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <table class="table-auto">
                <thead>
                  <tr>
                    <th>รหัส</th>
                    <th>คำถาม</th>
                    <th>คำตอบ</th>
                    <th>วันที่ถาม</th>
                    <th>แก้ไข</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="text-center"
                    v-for="faq in faqs"
                    :key="faq.id"
                  >
                    <td>#{{ faq.id }}</td>
                    <td>{{ faq.question }}</td>
                    <td>{{ faq.answer }}</td>
                    <td>{{ faq.create_date }}</td>
                    <td class="flex gap-2 justify-center">                      
                      <jet-button
                        color="warning"
                        :href="
                          route('admin.courses.lessons.faqs.edit', {
                            lesson: lesson.id,
                            course: course.id,
                            faq: faq.id,
                          })
                        "
                        ><i class="far fa-edit"></i></jet-button
                      >
                      <jet-button color="danger" @click="openDelete(faqs)"
                        ><i class="far fa-trash-alt"></i></jet-button
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
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
import Swal from "sweetalert2";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    JetButton,
  },
  props: ["lesson", "course", "faqs"],

  methods: {
    openDelete({ id, name }) {
      console.log(id);
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this! " + id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        showLoaderOnConfirm: true,
        preConfirm: () => {
          return this.$inertia.delete(
            route("admin.courses.lessons.faqs.destroy", {
              course: this.course.id,
              lesson: this.lesson.id,
              faq: id,
            }),
            {
              onSuccess: () => {
                return;
              },
              onError: () => {
                Swal.showValidationMessage(`Request failed: ${error}`);
              },
            }
          );
        },
        allowOutsideClick: () => !Swal.isLoading(),
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Suscess",
            html: `ลบ FAQ เรียบร้อย`,
            icon: "success",
            timer: 2000,
            timerProgressBar: true,
          });
        }
      });
    },
  },
};
</script>
