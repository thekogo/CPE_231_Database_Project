<template>
  <div>
    <navbar />
    <div class="pt-32">
      <img src="/images/coursedescription.png" class="mx-auto" />
      <div class="container mx-auto mt-10">
        <div class="grid grid-cols-3">
          <h2
            class="col-start-3 text-2xl text-gray-600 flex gap-4 items-center"
          >
            <i class="fas fa-cart-plus cursor-pointer text-md"></i> ขายได้
            {{ enrollment_count }}
            ครั้ง
          </h2>
        </div>
      </div>
      <div class="container mx-auto grid grid-cols-3 mt-8 gap-20">
        <a
          class="col-span-1 pl-12"
          :href="route('tutor.detail', { tutor: course.user.id })"
        >
          <img
            :src="course.course_img"
            alt=""
            srcset=""
            class="rounded-course mx-auto"
          />
          <img
            class="bg-pinkn h-36 w-36 mx-auto rounded-full mt-5"
            :src="course.user.profileImgUrl"
          />
          <span class="text-2xl block text-center text-purplen"
            >ผู้สอน {{ course.user.fullName }}</span
          >
        </a>
        <div class="col-span-2">
          <h1 class="text-5xl text-bluen">{{ course.name }}</h1>
          <br />
          <div class="grid grid-cols-12 gap-1">
            <h1 class="text-2xl text-gray-600 col-span-3 py-2">รายละเอียด</h1>
            <p
              class="
                col-span-9
                text-2xl text-gray-600
                bg-gray-200
                rounded-md
                p-2
              "
            >
              {{ course.description }}
            </p>
            <h1 class="text-2xl text-gray-600 col-span-3 py-2">ราคา</h1>
            <p
              class="
                col-span-9
                text-2xl text-gray-600
                bg-gray-200
                rounded-md
                p-2
              "
            >
              {{ course.price }}
              บาท
            </p>
            <h1 class="text-2xl text-gray-600 col-span-3 py-2">
              ชั่วโมงในการจอง
            </h1>
            <p
              class="
                col-span-9
                text-2xl text-gray-600
                bg-gray-200
                rounded-md
                p-2
              "
            >
              {{ course.hours_left }}
              ชั่วโมง
            </p>
            <h1 class="text-2xl text-gray-600 col-span-3 py-2">ผู้สอน</h1>
            <p
              class="
                col-span-9
                text-2xl text-gray-600
                bg-gray-200
                rounded-md
                p-2
              "
            >
              {{ course.user.fullName }}
            </p>
            <h1 class="text-2xl text-gray-600 col-span-3 py-2">หมวดหมู่</h1>
            <p
              class="
                col-span-9
                text-2xl text-gray-600
                bg-gray-200
                rounded-md
                p-2
              "
            >
              <span
                v-for="collection in course.course_categories"
                :key="collection.id"
                class="text-2xl text-gray-600 mr-2"
              >
                {{ collection.category.name }}
              </span>
            </p>
          </div>

          <button-pill
            class="w-20 cursor-pointer block mx-auto mt-8"
            v-if="$page.props.user?.role == 'student' || !$page.props.user"
            ><a :href="route('student.buycourse', { course: course.id })"
              >สั่งซื้อ</a
            ></button-pill
          >
        </div>
      </div>
    </div>
  </div>
  <img src="/images/bottom2.png" class="w-full" />
  <copyright />
</template>

<script>
import Navbar from "@/Components/Common/Navbar.vue";
import ButtonPill from "@/Components/Common/ButtonPill.vue";
import InputPill from "@/Components/Common/InputPill.vue";
import Copyright from "@/Components/Common/Copyright.vue";
export default {
  props: ["course", "enrollment_count"],
  components: {
    Navbar,
    ButtonPill,
    InputPill,
    Copyright,
  },
};
</script>
