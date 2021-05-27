<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Dashboard 2
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-12 gap-4">
          <div class="col-span-3">
            <side-menu />
          </div>
          <div class="col-span-9">
            <h1 class="text-2xl font-semibold mb-3">ตรวจสอบการชำระเงิน</h1>
            <div class="bg-white shadow-lg rounded-md p-5 flex flex-col gap-4">
              <payment-record
                paymentId="123"
                paymentDate="12/01/2563"
                paymentTotal="3600"
              />
              <payment-record
                paymentId="1234"
                paymentDate="12/01/2563"
                paymentTotal="3600"
              />
              <payment-record
                paymentId="1235"
                paymentDate="12/01/2563"
                paymentTotal="3600"
              />
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
import SideMenu from "@/Components/Student/SideMenu.vue";
import PaymentRecord from "@/Components/Admin/PaymentRecord.vue";

export default {
  components: {
    AppLayout,
    JetNavLink,
    SideMenu,
    PaymentRecord,
  },
};
</script>
