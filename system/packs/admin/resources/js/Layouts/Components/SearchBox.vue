<template>
    <!-- Modal backdrop -->
    <transition
        enter-active-class="transition ease-out duration-200"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-out duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div v-show="modalOpen" class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" aria-hidden="true"></div>
    </transition>
    <!-- Modal dialog -->
    <transition
        enter-active-class="transition ease-in-out duration-200"
        enter-from-class="opacity-0 translate-y-4"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition ease-in-out duration-200"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 translate-y-4"
    >
        <div v-show="modalOpen" :id="id" class="fixed inset-0 z-50 overflow-hidden flex items-start top-20 mb-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true">
            <div ref="modalContent" class="bg-white overflow-auto max-w-2xl w-full max-h-full rounded shadow-lg">
                <!-- Search form -->
                <form class="border-b border-gray-200">
                    <div class="relative">
                        <label :for="searchId" class="sr-only">Search</label>
                        <input :id="searchId" class="w-full border-0 focus:ring-transparent placeholder-gray-400 appearance-none py-3 pl-10 pr-4" type="search" placeholder="Search Anything…" ref="searchInput" />
                        <button class="absolute inset-0 right-auto group" type="submit" aria-label="Search">
                            <Icon name="search" class="w-4 h-4 shrink-0 fill-current text-gray-400 group-hover:text-gray-500 ml-4 mr-2"></Icon>
                        </button>
                    </div>
                </form>
                <div class="py-4 px-2">
                    <!-- Recent searches -->
                    <div class="mb-3 last:mb-0">
                        <div class="text-xs font-semibold text-gray-400 uppercase px-2 mb-2">Recent searches</div>
                        <ul class="text-sm">
                            <li>
                                <Link class="flex items-center p-2 text-gray-800 hover:text-white hover:bg-indigo-500 rounded group" to="#0" @click="$emit('close-modal')">
                                    <Icon name="sear-fresh" class="w-4 h-4 fill-current text-gray-400 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3"></Icon>
                                    <span>Form Builder - 23 hours on-demand video</span>
                                </Link>
                            </li>
                            <li>
                                <Link class="flex items-center p-2 text-gray-800 hover:text-white hover:bg-indigo-500 rounded group" to="#0" @click="$emit('close-modal')">
                                    <Icon name="sear-fresh" class="w-4 h-4 fill-current text-gray-400 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3"></Icon>
                                    <span>Master Digital Marketing Strategy course</span>
                                </Link>
                            </li>
                            <li>
                                <Link class="flex items-center p-2 text-gray-800 hover:text-white hover:bg-indigo-500 rounded group" to="#0" @click="$emit('close-modal')">
                                    <Icon name="sear-fresh" class="w-4 h-4 fill-current text-gray-400 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3"></Icon>
                                    <span>Dedicated forms for products</span>
                                </Link>
                            </li>
                            <li>
                                <Link class="flex items-center p-2 text-gray-800 hover:text-white hover:bg-indigo-500 rounded group" to="#0" @click="$emit('close-modal')">
                                    <Icon name="sear-fresh" class="w-4 h-4 fill-current text-gray-400 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3"></Icon>
                                    <span>Product Update - Q4 2021</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <!-- Recent pages -->
                    <div class="mb-3 last:mb-0">
                        <div class="text-xs font-semibold text-gray-400 uppercase px-2 mb-2">Recent pages</div>
                        <ul class="text-sm">
                            <li>
                                <Link class="flex items-center p-2 text-gray-800 hover:text-white hover:bg-indigo-500 rounded group" to="#0" @click="$emit('close-modal')">
                                    <Icon name="page" class="w-4 h-4 fill-current text-gray-400 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3"></Icon>
                                    <span><span class="font-medium text-gray-800 group-hover:text-white">Messages</span> - Conversation / … / Mike Mills</span>
                                </Link>
                            </li>
                            <li>
                                <Link class="flex items-center p-2 text-gray-800 hover:text-white hover:bg-indigo-500 rounded group" to="#0" @click="$emit('close-modal')">
                                    <Icon name="page" class="w-4 h-4 fill-current text-gray-400 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3"></Icon>
                                    <span><span class="font-medium text-gray-800 group-hover:text-white">Messages</span> - Conversation / … / Eva Patrick</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { ref, nextTick, onMounted, onUnmounted, watch } from 'vue'
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Icon.vue";

export default {
    name: 'SearchBox',
    props: ['id', 'searchId', 'modalOpen'],
    emits: ['open-modal', 'close-modal'],
    components: {
        Icon,
        Link,
    },
    setup(props, { emit }) {
        const modalContent = ref(null)
        const searchInput = ref(null)

        // close on click outside
        const clickHandler = ({ target }) => {
            if (!props.modalOpen || modalContent.value.contains(target)) return
            emit('close-modal')
        }
        // close if the esc key is pressed
        const keyHandler = ({ keyCode }) => {
            if (!props.modalOpen || keyCode !== 27) return
            emit('close-modal')
        }
        onMounted(() => {
            document.addEventListener('click', clickHandler)
            document.addEventListener('keydown', keyHandler)
        })
        onUnmounted(() => {
            document.removeEventListener('click', clickHandler)
            document.removeEventListener('keydown', keyHandler)
        })
        watch(() => props.modalOpen, (open) => {
            open && nextTick(() => searchInput.value.focus())
        })
        return {
            modalContent,
            searchInput,
        }
    }
}
</script>
