<template>
<!--    <admin-layout title="API Tokens">-->
<!--        <template #header>-->
<!--            <h2 class="font-semibold text-xl text-gray-800 leading-tight">-->
<!--                API Tokens-->
<!--            </h2>-->
<!--        </template>-->

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <api-token-manager :tokens="tokens"
                                   :available-permissions="availablePermissions"
                                   :default-permissions="defaultPermissions" />
            </div>
        </div>
<!--    </admin-layout>-->
</template>

<script>
    import { defineComponent } from 'vue'
    import AdminLayout from '../../Layouts/AdminLayout.vue'
    import ApiTokenManager from './Partials/ApiTokenManager.vue'

    export default defineComponent({
        layout: (h, page) => {
            return h(AdminLayout, {
                title: 'API Tokens',
            }, () => page);
        },
        props: [
            'tokens',
            'availablePermissions',
            'defaultPermissions',
        ],

        components: {
            AdminLayout,
            ApiTokenManager,
        },
    })
</script>
