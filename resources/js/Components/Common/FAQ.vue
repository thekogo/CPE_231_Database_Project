<template>
  <h1 class="bg-gray-300 px-5 rounded-2xl mb-5 cursor-pointer">
    <div class="flex justify-between items-center">
      <span class="text-2xl">{{ header }}</span>
      <i class="fas fa-plus" v-show="!isOpen" @click="isOpen = !isOpen"></i>
      <i class="fas fa-minus" v-show="isOpen" @click="isOpen = !isOpen"></i>
    </div>
    <div v-show="isOpen">
      <hr />
      <p class="text-xl">{{ description }}</p>
    </div>
  </h1>
</template>

<script>
export default {
  props: ["header", "description"],
  data() {
    return {
      isOpen: false,
    };
  },
};
</script>
