<template>
  <div class="bg-red-100 p-3 relative">
    <transition name="fade">
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
    </transition>
    <transition name="fade">
      <div v-if="isShow">
        <div class="grid grid-cols-12">
          <i
            class="fas fa-caret-square-down cursor-pointer col-start-12"
            @click="showDetial"
          ></i>
        </div>
        <div class="grid lg:grid-cols-3 grid-cols-1 gap-4">
          <div class="col-span-1">
            <img
              :src="$page.props.user.profileImgUrl"
              alt="Slip"
              class="max-h-48"
            />
          </div>
          <div class="col-span-2 text-xl">
            <p>ชื่อนักเรียน :</p>
          </div>
        </div>
      </div>
    </transition>
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

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
