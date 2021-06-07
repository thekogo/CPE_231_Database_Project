<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        สรุปภาพรวม
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-12 gap-4">
          <div class="col-span-3">
            <side-menu />
          </div>
          <div class="col-span-9">
            <div class="flex justify-between mb-2">
              <h1 class="text-2xl font-semibold mb-3">สรุปภาพรวม</h1>
            </div>
            <div
              class="
                bg-white
                shadow-lg
                rounded-md
                p-5
                flex flex-col
                gap-4
                divide-y-2 divide-gray-300
              "
            >
              <div>
                <h1 class="text-2xl">จำนวนคำถามของแต่ละรายวิชา</h1>
                <table class="table-fixed w-full">
                  <thead>
                    <tr>
                      <th>รายวิชา</th>
                      <th>ครั้ง</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center"
                      v-for="questionCourse in questionCourses"
                      :key="questionCourse.id"
                    >
                      <td>{{ questionCourse.id }}</td>
                      <td>{{ questionCourse.count_id }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <h1 class="text-2xl">จำนวนนักเรียนที่ลงทะเบียนในปีนี้</h1>
                <table class="table-fixed w-full">
                  <thead>
                    <tr>
                      <th>รายวิชา</th>
                      <th>ครั้ง</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center"
                      v-for="enrollmentCourseCurrentYear in enrollmentCourseCurrentYears"
                      :key="enrollmentCourseCurrentYear.course_id"
                    >
                      <td>{{ enrollmentCourseCurrentYear.course_id }}</td>
                      <td>{{ enrollmentCourseCurrentYear.total }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <h1 class="text-2xl">การจองที่นั่งในแต่ละปี</h1>
                <table class="table-fixed w-full">
                  <thead>
                    <tr>
                      <th>ปี</th>
                      <th>การจอง</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center"
                      v-for="reserveGroupByYear in reserveGroupByYears"
                      :key="reserveGroupByYear.year"
                    >
                      <td>{{ reserveGroupByYear.year }}</td>
                      <td>{{ reserveGroupByYear.total_reserves }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <h1 class="text-2xl">รายได้จากรายวิชาต่าง ๆ</h1>
                <table class="table-fixed w-full">
                  <thead>
                    <tr>
                      <th>รายวิชา</th>
                      <th>รายได้</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center"
                      v-for="totalCoursePay in totalCoursePays"
                      :key="totalCoursePay.id"
                    >
                      <td>{{ totalCoursePay.id }}</td>
                      <td>{{ totalCoursePay.total }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <h1 class="text-2xl">จำนวนการขอคืนเงินจากรายวิชาต่าง ๆ</h1>
                <table class="table-fixed w-full">
                  <thead>
                    <tr>
                      <th>รายวิชา</th>
                      <th>ครั้ง</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center"
                      v-for="totalRefund in totalRefunds"
                      :key="totalRefund.id"
                    >
                      <td>{{ totalRefund.id }}</td>
                      <td>{{ totalRefund.total }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <h1 class="text-2xl">คะแนนความพึงพอใจในวิชาต่าง ๆ</h1>
                <table class="table-fixed w-full">
                  <thead>
                    <tr>
                      <th>รายวิชา</th>
                      <th>rating เฉลี่ย</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center"
                      v-for="totalReview in totalReviews"
                      :key="totalReview.id"
                    >
                      <td>{{ totalReview.id }}</td>
                      <td>{{ totalReview.avg_rating }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <h1 class="text-2xl">
                  5 อันดับสูงสุดที่มีการลงทะเบียนคิดเป็นร้อยละ
                </h1>
                <table class="table-fixed w-full">
                  <thead>
                    <tr>
                      <th>รายวิชา</th>
                      <th>ร้อยละ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center"
                      v-for="top5Enrollment in top5Enrollments"
                      :key="top5Enrollment.course_id"
                    >
                      <td>{{ top5Enrollment.course_id }}</td>
                      <td>{{ top5Enrollment.total }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <h1 class="text-2xl">
                  5 อันดับนักเรียน เรียนจบบทเรียนมากที่สุด
                </h1>
                <table class="table-fixed w-full">
                  <thead>
                    <tr>
                      <th>ชื่อ</th>
                      <th>เรียนจบแล้ว (บทเรียน)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center"
                      v-for="top5studentLearned in top5studentLearneds"
                      :key="top5studentLearned.course_id"
                    >
                      <td>
                        {{ top5studentLearned.firstName }}
                        {{ top5studentLearned.lastName }}
                      </td>
                      <td>{{ top5studentLearned.total_learned }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <h1 class="text-2xl">
                  5 อันดับนักเรียน ลงทะเบียนเรียนมากที่สุด
                </h1>
                <table class="table-fixed w-full">
                  <thead>
                    <tr>
                      <th>ชื่อ</th>
                      <th>ลงทะเบียนเรียนทั้งสิ้น (คอร์ส)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center"
                      v-for="top5Enrollment in top5Enrollments"
                      :key="top5Enrollment.course_id"
                    >
                      <td>
                        {{ top5Enrollment.firstName }}
                        {{ top5Enrollment.lastName }}
                      </td>
                      <td>{{ top5Enrollment.count }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetNavLink from "@/Jetstream/NavLink";
import SideMenu from "@/Components/Admin/SideMenu.vue";
import JetButton from "@/Jetstream/Button.vue";
import Swal from "sweetalert2";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    JetButton,
  },
  props: [
    "questionCourses",
    "enrollmentCourseCurrentYears",
    "reserveGroupByYears",
    "totalCoursePays",
    "totalRefunds",
    "totalReviews",
    "top5Enrollments",
    "top5studentLearneds",
  ],

  mounted() {
    console.log(this.top5Enrollments);
  },
};
</script>
