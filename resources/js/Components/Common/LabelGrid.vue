<template>
  <label class="col-span-1 flex flex-col justify-center text-xl" :for="for">
    <span>{{ value }}</span>
  </label>
</template>
<script>
export default {
  props: {
    for: {
      type: String,
      required: true,
    },
    value: {
      type: String,
      required: true,
    },
  },
};
</script>
