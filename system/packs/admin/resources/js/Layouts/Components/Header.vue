<template>
    <header class="fixed w-full z-30 bg-white dark:bg-black shadow">
        <div class="flex items-center justify-between h-14 p-2 border-b dark:border-b-gray-500">
            <div class="flex items-center justify-center">
                <img class="w-40 sm:w-56 lg:w-44 h-12" src="/storage/logo.png" alt="HotashCMS">
                <!-- Mobile menu button -->
                <button
                    @click="sidebarToggle"
                    class="ml-3 w-8 h-8 text-blue-400 transition-colors duration-200 rounded-md bg-blue-50 hover:text-blue-600 hover:bg-blue-100 hidden lg:block focus:outline-none focus:ring"
                >
                    <span aria-hidden="true">
                        <svg
                            class="w-8 h-8"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </span>
                </button>
            </div>

            <div class="hidden sm:flex mr-auto">
                <div class="ml-3 relative">
                    <button class="w-8 h-8 rounded-sm flex items-center justify-center bg-gray-100 hover:bg-gray-200 transition duration-150">
                        <Icon name="bar-chart"></Icon>
                    </button>
                </div>
                <div class="ml-3 relative">
                    <button
                        class="w-8 h-8 rounded-sm flex items-center justify-center bg-gray-100 hover:bg-gray-200 transition duration-150"
                        :class="{ 'bg-gray-200': searchModalOpen }"
                        @click.stop="searchModalOpen = true"
                        aria-controls="search-modal"
                    >
                        <Icon name="search"></Icon>
                    </button>
                    <SearchBox id="search-modal" searchId="search" :modalOpen="searchModalOpen" @open-modal="searchModalOpen = true" @close-modal="searchModalOpen = false" />
                </div>
                <slot name="header"></slot>
            </div>

            <!-- Right Buttons -->
            <nav aria-label="Right Buttons" class="mr-3 flex items-center">
                <div class="ml-3 relative">
                    <NoticeBox />
                </div>

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <jet-dropdown align="right" width="48">
                        <template #trigger>
                            <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-md focus:outline-none focus:border-gray-300 transition">
                                <img class="h-10 w-10 rounded-md object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </button>

                            <span v-else class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white dark:bg-black hover:text-gray-700 focus:outline-none transition">
                                    {{ $page.props.user.name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Account
                            </div>

                            <jet-dropdown-link :href="route('profile.show')">
                                Profile
                            </jet-dropdown-link>

                            <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                API Tokens
                            </jet-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <jet-dropdown-link as="button">
                                    Log Out
                                </jet-dropdown-link>
                            </form>
                        </template>
                    </jet-dropdown>
                </div>
                <div class="ml-3 relative hidden sm:flex">
                    <button
                        @click="drawerToggle"
                        class="p-2 text-blue-400 transition-colors duration-200 rounded-md bg-blue-50 hover:text-blue-600 hover:bg-blue-100 focus:outline-none focus:ring"
                    >
                        <span aria-hidden="true">
                            <Icon name="utilities" :size="24"></Icon>
                        </span>
                    </button>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
import { defineComponent } from 'vue'
import { sidebar } from "../../Mixins/sidebar";
import { drawer } from "../../Mixins/drawer";
import Icon from "@/Icon.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import NoticeBox from "../Components/NoticeBox.vue";
import SearchBox from "../Components/SearchBox.vue";

export default defineComponent({
    mixins: [sidebar, drawer],
    components: {
        Icon,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        NoticeBox,
        SearchBox,
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
    data() {
        return {
            searchModalOpen: false,
        };
    },
})
</script>
