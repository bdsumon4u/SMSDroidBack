<template>
    <div :class="{ 'dark': isDark, 'sidebar-maximized': sidebarFull }" v-bind:screen="screenType">
        <Head :title="title" />

        <jet-banner />

        <div v-show="sidebarFull" @click="sidebarToggle" class="fixed inset-0 z-10 w-screen h-screen bg-black bg-opacity-25 sm:hidden"></div>
        <div v-show="drawerOpen" @click="drawerToggle" class="fixed inset-0 z-50 w-screen h-screen bg-black bg-opacity-25 sm:hidden"></div>
        <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black">
            <Header x-sidebar-dropdown @sidebarToggle="sidebarToggle" @drawerToggle="drawerToggle" />
            <Sidebar :refresh="Math.random()" :isFull="sidebarFull" @themeToggle="themeToggle" />
            <Drawer :isOpen="drawerOpen" @drawerToggle="drawerToggle" />

            <main x-sidebar-dropdown :class="{'lg:ml-60': sidebarFull}" class="flex flex-col flex-1 mt-14 mb-20 sm:mb-10 ml-0 sm:ml-10 transition-all duration-300">
                <slot></slot>
            </main>

            <Footer @sidebarToggle="sidebarToggle" @drawerToggle="drawerToggle" />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { sidebar } from "../Mixins/sidebar";
import { theme } from "../Mixins/theme";
import { drawer } from "../Mixins/drawer";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetBanner from "@/Jetstream/Banner.vue";
import Header from "./Components/Header.vue";
import Sidebar from "./Components/Sidebar.vue";
import Drawer from "./Components/Drawer.vue";
import Welcome from '@/Jetstream/Welcome.vue'
import Footer from "./Components/Footer.vue";

export default defineComponent({
    mixins: [sidebar, theme, drawer],
    props: {
        title: String,
    },
    components: {
        Head,
        Link,
        JetBanner,
        Header,
        Sidebar,
        Drawer,
        Welcome,
        Footer,
    },
})
</script>

<style lang="scss">
    @import "../../css/panel.scss";
</style>
