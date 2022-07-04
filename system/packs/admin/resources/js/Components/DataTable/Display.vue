<template>
    <div class="relative">
        <button @click.prevent="display = !display"
                class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:hidden"
                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                <path
                    d="M5.5 5h13a1 1 0 0 1 0.5 1.5L14 12L14 19L10 16L10 12L5 6.5a1 1 0 0 1 0.5 -1.5"></path>
            </svg>
            <span>Display</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" width="24" height="24"
                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </button>

        <div v-show="display"
             class="z-40 absolute top-0 right-0 w-40 bg-white rounded-lg shadow-lg mt-12 -mr-1 block py-1 overflow-hidden">
            <template v-for="heading in headings">
                <label
                    class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2">
                    <div class="text-teal-600 mr-3">
                        <input type="checkbox"
                               class="form-checkbox focus:outline-none focus:shadow-outline"
                               checked="" @click="toggleColumn(heading.key)">
                    </div>
                    <div class="select-none text-gray-700" v-text="heading.value"></div>
                </label>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "Display"
}
</script>
