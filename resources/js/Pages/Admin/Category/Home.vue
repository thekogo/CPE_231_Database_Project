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
              <h1 class="text-2xl font-semibold mb-3">รายการหมวดหมู่</h1>
              <jet-button :href="route('admin.categories.create')"
                >สร้างหมวดหมู่</jet-button
              >
            </div>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <table class="table-auto">
                <thead>
                  <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Category Status</th>
                    <th>Course Count</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="text-center"
                    v-for="category in categories"
                    :key="category.category_name"
                  >
                    <td>{{ category.id }}</td>
                    <td>{{ category.category_name }}</td>
                    <td>{{ category.category_display }}</td>
                    <td>{{ category.course_categories_count }}</td>
                    <td class="flex gap-2 justify-center">
                      <jet-button
                        :href="
                          route('admin.categories.show', { id: category.id })
                        "
                        >View</jet-button
                      >
                      <jet-button color="warning">Edit</jet-button>
                      <jet-button color="danger">Delete</jet-button>
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
import SideMenu from "@/Components/Student/SideMenu.vue";
import JetButton from "@/Jetstream/Button.vue";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    JetButton,
  },
  props: ["categories"],
};
</script>
