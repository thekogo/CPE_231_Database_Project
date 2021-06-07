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
      :href="route('student.courses.index')"
      :active="route().current('student.courses.*')"
    >
      คอร์สเรียนทั้งหมด
    </jet-nav-link>
    <jet-nav-link
      class="text-xl h-10"
      :href="route('student.reserves.index')"
      :active="route().current('student.reserves.index')"
    >
      จองเวลาเรียน
    </jet-nav-link>

    <jet-nav-link
      class="text-xl h-10"
      :href="route('student.enrollments.index')"
      :active="route().current('student.enrollments.*')"
    >
      ประวัติการลงทะเบียน
    </jet-nav-link>
  </div>
</template>

<script>
import JetNavLink from "@/Jetstream/NavLink";
export default {
  components: { JetNavLink },
};
</script>

<style>
</style>
