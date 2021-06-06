<template>
  <div>
    <navbar />
    <div class="pt-32">
      <img src="/images/tutor.png" class="mx-auto" />
      <h1 class="mx-auto text-4xl text-gray-400 mt-5 block text-center">
        นวกานต์ ลี้รัตนโชติ
      </h1>
      <div class="container mx-auto mt-10">
        <div class="col-span-1 items-center">
          <div
            class="
              bg-red-300
              h-48
              w-48
              rounded-3xl
              mx-auto
              hover:bg-pink-300
              cursor-pointer
              shadow-xl
            "
          ></div>
          <div class="container mx-auto mt-1">
            <h1 class="mx-auto text-3xl text-bluen text-center mt-5">
              Owner of study course
            </h1>
            <h1
              class="
                mx-auto
                text-3xl text-gray-400 text-center
                grid grid-cols-5
              "
            >
              <div class="col-span-1">
                <div class="bg-pink-300 h-48 w-48 rounded-3xl mx-auto"></div>
              </div>
              <div class="col-span-1">
                <div class="bg-pink-300 h-48 w-48 rounded-3xl mx-auto"></div>
              </div>
              <div class="col-span-1">
                <div class="bg-pink-300 h-48 w-48 rounded-3xl mx-auto"></div>
              </div>
              <div class="col-span-1">
                <div class="bg-pink-300 h-48 w-48 rounded-3xl mx-auto"></div>
              </div>
              <div class="col-span-1">
                <div class="bg-pink-300 h-48 w-48 rounded-3xl mx-auto"></div>
              </div>
            </h1>
            <div class="grid-cols-3 mx-auto"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br />
  <br />
  <br />
  <br />
  <img src="/images/bottom2.png" />
  <Copyright />
</template>
<script>
import Navbar from "@/Components/Common/Navbar.vue";
import Copyright from "@/Components/Common/Copyright.vue";

export default {
  components: {
    Navbar,
    Copyright,
  },
};
</script>
