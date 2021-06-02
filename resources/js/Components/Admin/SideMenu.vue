<template>
  <div class="bg-white shadow-xl sm:rounded-lg p-5 flex flex-col gap-2 text-lg">
    <jet-nav-link
      class="text-xl h-10"
      :href="route('student.home')"
      :active="route().current('student.home')"
    >
      หน้าแรก
    </jet-nav-link>
    <jet-nav-link
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
    <jet-nav-link
      class="text-xl h-10"
      :href="route('dashboard')"
      :active="route().current('dashboard')"
    >
      ถาม-ตอบปัญหาการเรียน
    </jet-nav-link>
    <jet-nav-link
      class="text-xl h-10"
      :href="route('dashboard')"
      :active="route().current('dashboard')"
    >
      เกี่ยวกับเรา
    </jet-nav-link>
    <jet-nav-link
      class="text-xl h-10"
      :href="route('dashboard')"
      :active="route().current('dashboard')"
    >
      แจ้งชำระเงิน
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
