<template>
  <div class="bg-red-100 p-3 relative">
    <div class="grid grid-cols-12" v-if="!isShow">
      <div class="col-span-3">{{ paymentId }}</div>
      <div class="col-span-4">{{ paymentDate }}</div>
      <div class="col-span-4">{{ paymentTotal }} บาท</div>
      <div class="col-span-1">
        <i
          class="fas fa-caret-square-down cursor-pointer"
          @click="showDetial"
        ></i>
      </div>
    </div>
    <div v-if="isShow">
      <div class="grid lg:grid-cols-3 grid-cols-2 gap-4">
        <i
          class="fas fa-caret-square-down cursor-pointer absolute right-10"
          @click="showDetial"
        ></i>
        <div class="col-span-1 bg-white h-96"></div>
        <div class="col-span-2 text-xl">
          <p>ชื่อนักเรียน :</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    paymentId: {
      type: Number,
      required: true,
    },
    paymentDate: {
      type: Date,
      required: true,
    },
    paymentTotal: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      isShow: false,
    };
  },
  methods: {
    showDetial() {
      this.isShow = !this.isShow;
    },
  },
};
</script>

<style>
</style>
