<template>
  <div class="col-span-1 border-2 p-4 hover:shadow-2xl cursor-pointer">
    <img class="bg-pinkn h-60 rounded-lg" :src="src" />
    <h1 class="mt-3">{{ title }}</h1>
  </div>
</template>

<script>
export default {
  props: ["title", "src"],
};
</script>
