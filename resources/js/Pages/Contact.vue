<template>
  <div>
    <navbar />
    <div class="pt-32">
      <img src="/images/countact.png" class="mx-auto" />
      <h1 class="mx-auto text-4xl text-gray-100 mt-5 block text-center"></h1>
      <div class="container mx-auto mt-10">
        <div class="bg-gray-100 h-96 rounded-xl mx-auto shadow-xl p-12">
          <div class="grid grid-cols-2">
            <div class="col-span-1">
              <h1>
                <i class="fas fa-map-marked-alt text-3xl text-greenn">​</i>
                <span class="text-lg">
                  บริษัท เน็กซ์เลเวล เอ็ดดูเคชั่น จำกัด (สำนักงานใหญ่) ที่อยู่
                  444 ชั้น 14 อาคารเอ็ม บี เค ทาวเวอร์ ถนนพญาไท แขวงวังใหม่
                  เขตปทุมวัน กรุงเทพมหานคร 10330​
                </span>
              </h1>
              <br />
              <i class="far fa-clock text-3xl text-pinkn"></i>
              <span class="text-lg"> 8:30-19:00 </span>
              <h1>
                <br />
                <i class="fas fa-phone-alt text-3xl text-bluen"></i>
                <span class="text-lg"> 02-345-4355</span>
              </h1>
            </div>
            <div class="col-span-1">
              <h1>
                <br /><br /><br /><br /><br />
                <i
                  class="
                    fab
                    fa-facebook-square
                    text-3xl text-blue-900
                    cursor-pointer
                  "
                ></i
                ><span class="text-lg cursor-pointer">
                  Next Level Academy Official</span
                >
              </h1>
              <h1>
                <i
                  class="
                    fab
                    fa-twitter-square
                    text-3xl
                    cursor-pointer
                    text-bluen
                  "
                ></i
                ><span class="text-lg cursor-pointer">
                  Next Level Academy Official</span
                >
              </h1>
              <h1>
                <i
                  class="
                    fab
                    fa-instagram-square
                    text-3xl
                    cursor-pointer
                    text-purple-700
                  "
                ></i
                ><span class="text-lg cursor-pointer"> NextLevelstagram</span>
              </h1>
              <h1>
                <i
                  class="fab fa-line text-3xl cursor-pointer text-green-600"
                ></i>
                <span class="text-lg cursor-pointer"> NextlevellineOf</span>
              </h1>
              <h1>
                <i
                  class="
                    fab
                    fa-youtube-square
                    text-3xl
                    cursor-pointer
                    text-red-600
                  "
                ></i
                ><span class="text-lg cursor-pointer">
                  Next Level Official</span
                >
              </h1>
            </div>
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
