<template>
    <div class="h-14 bg-white dark:bg-black fixed z-30 shadow bottom-0 w-full border-t dark:border-t-gray-500 sm:hidden">
        <ul class="flex justify-around">
            <li class="p-2">
                <a @click.prevent="sidebarToggle" href="#" class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-200 hover:text-indigo-500">
                            <span class="block h-6">
                                <Icon name="hamburger" :size="24"></Icon>
                            </span>
                    <span class="block text-xs leading-none mt-1">Menu</span>
                </a>
            </li>
            <li class="p-2">
                <Link href="#" class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-200 hover:text-indigo-500">
                            <span class="block h-6">
                                <Icon name="bar-chart" :size="24"></Icon>
                            </span>
                    <span class="block text-xs leading-none mt-1">Analytics</span>
                </Link>
            </li>
            <li class="p-2">
                <a @click.stop="searchModalOpen = true" aria-controls="search-modal" href="#" class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-200 hover:text-indigo-500">
                            <span class="block h-6">
                                <Icon name="search" :size="24"></Icon>
                            </span>
                    <span class="block text-xs leading-none mt-1">Search</span>
                </a>
                <SearchBox id="search-modal" searchId="search" :modalOpen="searchModalOpen" @open-modal="searchModalOpen = true" @close-modal="searchModalOpen = false" />
            </li>
            <li class="p-2">
                <a @click.prevent="drawerToggle" href="#" class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-200 hover:text-indigo-500">
                            <span class="block h-6">
                                <Icon name="utilities" :size="24"></Icon>
                            </span>
                    <span class="block text-xs leading-none mt-1">Utilities</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { sidebar } from "../../Mixins/sidebar";
import { drawer } from "../../Mixins/drawer";
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Icon.vue";
import SearchBox from "../../Layouts/Components/SearchBox.vue";

export default defineComponent({
    mixins: [sidebar, drawer],
    components: {
        Icon,
        Link,
        SearchBox,
    },
    data() {
        return {
            searchModalOpen: false,
        };
    },
})
</script>
