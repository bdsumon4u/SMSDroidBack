<template>
    <div :class="[isFull ? 'fixed h-full' : 'absolute h-auto']" class="w-60 sm:w-10 flex flex-col top-14 bottom-16 sm:bottom-0 -left-60 sm:left-0 text-white transition-all duration-300 border-none z-10 sidebar">
        <div :class="[isFull ? 'scrollbar scrollbar-none' : '']" class="flex flex-col justify-between flex-grow bg-gray-900">
            <ul :class="[isFull ? 'pb-32' : 'pb-4']" class="flex flex-col pt-4 space-y-1">
                <li v-for="item in items" class="relative" :class="hasSub(item)">
                    <div class="group">
                        <component :is="item.children ? 'a' : 'Link'" :href="item.href ?? '#'" @click.prevent="doOpen(item.id)" :class="[isActive(item) ? 'active bg-blue-800 dark:bg-blue-800 text-white-800' : '']" class="relative flex flex-row items-center h-10 focus:outline-none hover:bg-gray-700 dark:hover:bg-gray-600 text-white-600 hover:text-white-800">
                            <span :class="[isActive(item) ? 'border-blue-400 dark:hover:border-gray-800' : '']" class="w-10 h-full flex justify-center items-center border-l-2 border-transparent">
                                <Icon :name="item.icon"></Icon>
                            </span>
                            <span :class="[isFull ? 'inline-flex group-hover:inline-flex group-hover:bg-gray-700' : 'hidden']" class="pl-1 pr-2 h-full items-center grow text-sm tracking-wide overflow-hidden">
                                <span :class="[isFull ? 'group-hover:translate-x-2 transform-gpu transition-transform duration-200' : '']" class="font-bold overflow-hidden text-ellipsis">{{ item.name }}</span>
                            </span>
                            <span v-if="item.badge" v-show="isFull" class="inline-flex px-1.5 py-0.5 ml-auto mr-2 text-xs font-medium tracking-wide text-blue-500 bg-indigo-50 rounded-md">{{ item.badge }}</span>
                            <span v-if="item.children" v-show="isFull" class="inline-flex justify-center items-center w-6 h-6 mr-2 flex-none text-gray-300">
                                <svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                                    <path icon="+" fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                                    <path icon="-" fill="currentColor" d="M19,13H5V11H19V13Z"></path>
                                </svg>
                            </span>
                        </component>
                    </div>
                    <ul v-show="item.children && open_id === item.id" class="bg-gray-800 dark:bg-black">
                        <li class="title relative flex flex-row items-center h-10 focus:outline-none bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800">
                            <span class="font-bold ml-6 grow text-sm tracking-wide truncate">{{ item.name }}</span>
                        </li>
                        <li v-for="child in item.children">
                            <Link :href="child.href" :class="[isActive(child) ? 'text-blue-400' : '']" class="relative flex flex-row items-center h-10 focus:outline-none hover:bg-gray-700 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-2 border-transparent">
                                <span class="ml-6 flex h-full items-center hover:translate-x-2 transform-gpu transition-transform duration-200 grow text-sm font-bold tracking-wide truncate">{{ child.name }}</span>
                            </Link>
                        </li>
                    </ul>
                </li>
            </ul>

            <div :class="[isFull ? 'h-12' : 'sm:w-10']" class="w-60 flex fixed bottom-14 sm:bottom-0 border-t transition-all duration-300 border-gray-700">
                <ul :class="[isFull ? 'px-4' : 'flex-col-reverse']" class="w-full flex items-center justify-between bg-gray-800">
                    <li class="cursor-pointer text-white">
                        <button @click="themeToggle" class="focus:outline-none px-2 py-3 focus:ring-gray-300">
                            <Icon :name="isDark ? 'sun' : 'moon'"></Icon>
                        </button>
                    </li>
                    <li class="cursor-pointer text-white">
                        <button class="focus:outline-none px-2 py-3 focus:ring-gray-300">
                            <Icon name="chats"></Icon>
                        </button>
                    </li>
                    <li class="cursor-pointer text-white">
                        <button class="focus:outline-none px-2 py-3 focus:ring-gray-300">
                            <Icon name="settings"></Icon>
                        </button>
                    </li>
                    <li class="cursor-pointer text-white">
                        <button class="focus:outline-none px-2 py-3 focus:ring-gray-300">
                            <Icon name="lock"></Icon>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { sidebar } from "../../Mixins/sidebar";
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Icon.vue";

export default defineComponent({
    mixins: [sidebar],
    props: ['isFull'],
    components: {
        Icon,
        Link,
    },
    methods: {
        xSidebarDropdown() {
            this.isFull || (this.open_id = null);
        }
    },
    mounted() {
        document.querySelectorAll('[x-sidebar-dropdown]').forEach(el => {
            el.addEventListener('click', this.xSidebarDropdown);
        })
    },
    beforeUnmount() {
        document.querySelectorAll('[x-sidebar-dropdown]').forEach(el => {
            el.removeEventListener('click', this.xSidebarDropdown);
        })
    },
})
</script>
