<template>
    <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
        <p class="text-sm leading-5 text-gray-600 text-center mb-2">
            Showing
            <span class="font-medium">{{ pagination.from }}</span>
            to
            <span class="font-medium">{{ pagination.to }}</span>
            of
            <span class="font-medium">{{ pagination.total }}</span>
            results
        </p>

        <div class="flex space-x-1 justify-center items-top" v-if="pagination.last_page > 1">
            <button
                :disabled="noPreviousPage"
                :class="{'opacity-50': noPreviousPage}"
                @click="loadPage(1)"
                class="inline-flex justify-center items-center w-10 h-10 text-gray-700 bg-white rounded border border-gray-300 shadow-sm outline-none hover:bg-gray-50 lg:h-10 lg:w-10 lg:text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:h-3 lg:w-3" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
            </button>
            <button
                :disabled="noPreviousPage"
                :class="{'opacity-50': noPreviousPage}"
                @click="loadPage(pagination.current_page - 1)"
                class="inline-flex justify-center items-center w-10 h-10 text-gray-700 bg-white rounded border border-gray-300 shadow-sm outline-none hover:bg-gray-50 lg:h-10 lg:w-10 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:h-3 lg:w-3" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <div class="flex items-center space-x-1">
                <input type="number" @keydown.enter="loadPage(page)" v-model="page" class="px-2 w-10 h-10 text-center rounded border border-gray-400 shadow-sm lg:h-10 lg:w-10 lg:text-sm focus:ring-blue-500 focus:border-blue-500"/>
                <div class="grid place-content-center px-1 text-gray-600 lg:text-sm">of {{ pagination.last_page }}</div>
            </div>

            <button
                :disabled="noNextPage"
                :class="{'opacity-50': noNextPage}"
                @click="loadPage(pagination.current_page + 1)"
                class="inline-flex justify-center items-center w-10 h-10 text-gray-700 bg-white rounded border border-gray-300 shadow-sm outline-none hover:bg-gray-50 lg:h-10 lg:w-10 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:h-3 lg:w-3" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <button
                :disabled="noNextPage"
                :class="{'opacity-50': noNextPage}"
                @click="loadPage(pagination.last_page)"
                class="inline-flex justify-center items-center w-10 h-10 text-gray-700 bg-white rounded border border-gray-300 shadow-sm outline-none hover:bg-gray-50 lg:h-10 lg:w-10 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:h-3 lg:w-3" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Pagination',
    props: {
        pagination: Object,
    },
    data() {
        return {
            page: this.pagination.current_page
        }
    },
    watch: {
        'pagination.current_page': function(page) {
            this.page = page;
        }
    },
    methods: {
        loadPage(page) {
            this.$inertia.get(this.$page.url, {page: page}, {
                preserveState: true,
            });
        }
    },
    computed: {
        noPreviousPage() {
            return this.pagination.current_page - 1 <= 0;
        },
        noNextPage() {
            return this.pagination.current_page + 1 > this.pagination.last_page;
        }
    }
};
</script>

<style scoped>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
}
</style>
