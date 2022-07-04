<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <welcome />
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import AdminLayout from "../Layouts/AdminLayout.vue";
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        layout: (h, page) => {
            return h(AdminLayout, {
                title: 'Dashboard',
            }, () => page);
        },
        components: {
            Welcome,
        },
    })
</script>
