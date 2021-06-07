<template>
  <div class="bg-white shadow-xl sm:rounded-lg p-5 flex flex-col gap-2 text-lg">
    <jet-nav-link
      class="text-xl h-10"
      :href="route('admin.home')"
      :active="route().current('admin.home')"
    >
      หน้าแรก
    </jet-nav-link>
    <jet-nav-link
      class="text-xl h-10"
      :href="route('admin.users.index')"
      :active="route().current('admin.users.*')"
    >
      จัดการผู้ใช้
    </jet-nav-link><jet-nav-link
      class="text-xl h-10"
      :href="route('admin.courses.index')"
      :active="route().current('admin.courses.*')"
    >
      จัดการคอร์สเรียน
    </jet-nav-link>
    <jet-nav-link
      class="text-xl h-10"
      :href="route('admin.categories.index')"
      :active="route().current('admin.categories.*')"
    >
      จัดการหมวดหมู่
    </jet-nav-link>
    <jet-nav-link
      class="text-xl h-10"
      :href="route('admin.enrollments.index')"
      :active="route().current('admin.enrollments.*')"
    >
      จัดการการลงทะเบียนเรียน
    </jet-nav-link>
  </div>
</template>

<script>
import JetNavLink from "@/Jetstream/NavLink";
export default {
  components: { JetNavLink },
};
</script>

<style></style>
