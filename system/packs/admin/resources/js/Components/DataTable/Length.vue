<template>
    <div class="relative">
        <div class="shadow rounded-lg flex">
            <div class="relative">
                <button @click.prevent="length_open = !length_open" class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4">
                    <span>25</span>
                </button>

                <!-- Full Screen Dropdown Overlay -->
                <div v-show="length_open" class="fixed inset-0 z-40"
                     @click="length_open = false">
                </div>

                <div v-show="length_open" class="z-40 absolute top-0 left-0 w-40 bg-white rounded-lg shadow-lg mt-12 -mr-1 block py-1 overflow-hidden">
                    <template v-for="len in [5, 10, 15, 20, 25, 50, 100, 250, 500, 1000]">
                        <label
                            class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2">
                            <div class="text-teal-600 mr-3">
                                <input type="checkbox"
                                       class="form-checkbox focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="select-none text-gray-700" v-text="len"></div>
                        </label>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Length"
}
</script>
