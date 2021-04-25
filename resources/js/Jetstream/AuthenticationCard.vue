<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" :class="registerClass">
            <slot />
        </div>
    </div>
</template>

<script>

export default {
    props: {
        register: {
            type: Boolean,
            default: false,
            required: false,
        }
    },

    computed: {
        registerClass() {
            return this.register ? 'sm:max-w-lg' : 'sm:max-w-md';
        }
    }
}
</script>
