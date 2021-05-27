<template>
  <inertia-link v-if="href" :href="href">
    <button
      :type="type"
      class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition"
      :class="classes"
    >
      <slot></slot>
    </button>
  </inertia-link>
  <button
    :type="type"
    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition"
    :class="classes"
    v-else
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: "submit",
    },
    color: {
      type: String,
      default: "default",
      validator: function (value) {
        return ["default", "warning", "danger"].indexOf(value) !== -1;
      },
    },
    href: {
      type: String,
    },
  },
  computed: {
    classes: function () {
      return {
        "bg-gray-800 hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 focus:ring-gray-300":
          this.color === "default",
        "bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-600 focus:border-yellow-600 focus:ring-yellow-100":
          this.color === "warning",
        "bg-red-500 hover:bg-red-400 active:bg-red-600 focus:border-red-600 focus:ring-red-100":
          this.color === "danger",
      };
    },
  },
};
</script>
