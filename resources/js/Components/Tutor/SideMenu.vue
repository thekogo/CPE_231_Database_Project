<template>
  <div class="bg-white shadow-xl sm:rounded-lg p-5 flex flex-col gap-2 text-lg">
    <jet-nav-link
      class="text-xl h-10"
      :href="route('tutor.courses.index')"
      :active="route().current('tutor.courses.*')"
    >
      จัดการคอร์สเรียน
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
