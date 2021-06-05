<template>
  <div>
    <navbar />
    <div class="pt-32">
      <img src="/images/tutors.png" class="mx-auto" />
      <h1 class="mx-auto text-4xl text-gray-400 mt-5 block text-center">
        ทั้งหมด
      </h1>
      <div class="container mx-auto mt-10">
        <div class="grid grid-cols-4 gap-y-14">
          <div class="col-span-1 items-center">
            <div
              class="
                bg-red-300
                h-48
                w-48
                rounded-full
                mx-auto
                hover:bg-pink-300
                cursor-pointer
                shadow-xl
              "
            ></div>
            <h1 class="mx-auto text-3xl text-gray-600 text-center">Beymah</h1>
            <h1 class="mx-auto text-3xl text-gray-600 text-center">Beymah</h1>
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
