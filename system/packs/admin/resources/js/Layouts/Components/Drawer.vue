<template>
    <aside :class="[drawerOpen ? 'right-0' : '-right-72']" class="w-72 fixed z-50 top-0 right-0 bottom-0 transition-all duration-300">
        <header class="w-72 fixed z-30 bg-gray-200 dark:bg-black shadow">
            <div class="flex items-center justify-between h-14 px-2 border-b dark:border-gray-700">
                <ul class="flex">
                    <li :class="[isTabOpen('tab-1', true) ? 'border-blue-600' : 'border-transparent']" class="mb-0.5 border-b-2">
                        <button @click="activeTab = 'tab-1'" class="h-14 px-3">
                            <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24"><path class="fill-current text-gray-600" d="M8 1v2H3v19h18V3h-5V1h7v23H1V1z"></path><path class="fill-current text-gray-600" d="M1 1h22v23H1z"></path><path class="fill-current text-gray-400" d="M15 10.586L16.414 12 11 17.414 7.586 14 9 12.586l2 2zM5 0h14v4H5z"></path></svg>
                        </button>
                    </li>
                    <li :class="[isTabOpen('tab-2') ? 'border-blue-600' : 'border-transparent']" class="mb-0.5 border-b-2">
                        <button @click="activeTab = 'tab-2'" class="h-14 px-3">
                            <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24"><path class="fill-current text-gray-600" d="M19.714 14.7l-7.007 7.007-1.414-1.414 7.007-7.007c-.195-.4-.298-.84-.3-1.286a3 3 0 113 3 2.969 2.969 0 01-1.286-.3z"></path><path class="fill-current text-gray-400" d="M10.714 18.3c.4-.195.84-.298 1.286-.3a3 3 0 11-3 3c.002-.446.105-.885.3-1.286l-6.007-6.007 1.414-1.414 6.007 6.007z"></path><path class="fill-current text-gray-600" d="M5.7 10.714c.195.4.298.84.3 1.286a3 3 0 11-3-3c.446.002.885.105 1.286.3l7.007-7.007 1.414 1.414L5.7 10.714z"></path><path class="fill-current text-gray-400" d="M19.707 9.292a3.012 3.012 0 00-1.415 1.415L13.286 5.7c-.4.195-.84.298-1.286.3a3 3 0 113-3 2.969 2.969 0 01-.3 1.286l5.007 5.006z"></path></svg>
                        </button>
                    </li>
                    <li :class="[isTabOpen('tab-3') ? 'border-blue-600' : 'border-transparent']" class="mb-0.5 border-b-2">
                        <button @click="activeTab = 'tab-3'" class="h-14 px-3">
                            <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24"><path class="fill-current text-gray-600" d="M20 7a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 0120 7zM4 23a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 014 23z"></path><path class="fill-current text-gray-400" d="M17 23a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 010-2 4 4 0 004-4 1 1 0 012 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1zM7 13a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 110-2 4 4 0 004-4 1 1 0 112 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1z"></path></svg>
                        </button>
                    </li>
                </ul>
                <button @click.stop="drawerToggle" type="button" class="h-14 px-3">
                    <Icon name="close" class="w-4 h-4 shrink-0 fill-current"></Icon>
                </button>
            </div>
        </header>
        <div class="w-72 fixed h-full top-14 z-30 bg-gray-100 dark:bg-black shadow">
            <div v-if="isTabOpen('tab-1', true)" class="h-full scrollbar scrollbar-none">
                <div class="p-2">Tasks</div>
            </div>
            <div v-if="isTabOpen('tab-2')" class="h-full scrollbar scrollbar-none">
                <div class="p-2">Campaigns</div>
            </div>
            <div v-if="isTabOpen('tab-3')" class="h-full scrollbar scrollbar-none">
                <div class="p-2">Customization</div>
            </div>
        </div>
    </aside>
</template>

<script>
import { drawer } from "../../Mixins/drawer";
import Icon from "@/Icon.vue";

export default {
    name: "Drawer",
    mixins: [drawer],
    props: ['isOpen'],
    components: {
        Icon,
    },
    watch: {
        isOpen() {
            this.drawerOpen = this.isOpen;
        }
    }
}
</script>
