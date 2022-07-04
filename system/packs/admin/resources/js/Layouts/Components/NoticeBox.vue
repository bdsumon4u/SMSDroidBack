<template>
    <div class="relative">
        <div @click="open = !open">
            <button class="relative h-10 w-10 bg-white text-center text-gray-700 hover:text-primary border-transparent rounded-md shadow focus:outline-none focus:border-gray-300 transition flex items-center justify-center">
                <Icon name="bell"></Icon>
                <div v-if="notifications.unread" class="absolute top-0 right-0 w-6 h-6 text-white -mr-2 rounded-full bg-red-500">{{ notifications.unread }}</div>
            </button>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false">
        </div>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="open"
                 class="absolute z-50 mt-2 rounded-md shadow-lg w-72 -mr-16 md:mr-0 origin-top-right right-0"
                 style="display: none;"
                 @click="open = false">
                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white dark:bg-black">
                    <div class="hu z-10 aw fo right-0 sz pu uk ff">
                        <div class="text-sm font-bold fy uppercase py-2 px-4">Notifications</div>
                        <ul class="pt-1 px-2">
                            <li v-for="notification in notifications.latest" class="hover:bg-gray-200 my-1 rounded-sm" :class="[notification.read_at ? 'bg-gray-100' : 'bg-yellow-100']">
                                <a href="" @click.prevent="see(notification)" class="block px-2 py-2 nc">
                                    <span class="block text-sm mb-2">📣 <span class="rx text-gray-800">{{ notification.data.message }}</span></span>
                                    <span class="block text-xs font-weight-500 opacity-75">{{ notification.created_at }}</span>
                                </a>
                            </li>
                            <li v-if="notifications.count > 3" class="flex items-center justify-center">
                                <small class="text-xs -mt-1">.......</small>
                            </li>
                            <li class="flex mt-2 mb-1 space-x-1">
                                <strong v-if="!notifications.count" class="border p-2 text-red-500 w-full">Nothing Found.</strong>
                                <Link v-if="notifications.unread > 0" class="p-2 bg-gray-200 hover:bg-gray-300 w-full text-sm grid place-content-center font-bold rounded-sm" href="" @click.prevent="markAsRead">Mark All As Read</Link>
                                <Link v-if="notifications.count > 3" class="p-2 bg-gray-200 hover:bg-gray-300 w-full text-sm grid place-content-center font-bold rounded-sm" :href="route(routePrefix + 'notifications')">View All</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Icon.vue";

export default {
    components: {
        Icon,
        Link,
    },
    methods: {
        closeOnEscape(e) {
            if (this.open && e.keyCode === 27) {
                this.open = false;
            }
        },
        reloadList() {
            axios.get('')
                .then(({data}) => this.notifications = data)
                .catch(err => console.error(err));
        },
        see(notification) {
            this.$inertia.form({
                id: notification.id,
            }).post('', {
                onSuccess: this.reloadList,
            });
        },
        markAsRead() {
            this.$inertia.form({}).patch(route(this.routePrefix + 'notifications.read-all'), {
                onSuccess: () => {
                    this.reloadList();
                    // Emit Event
                }
            })
        }
    },
    data() {
        return {
            open: false,
            notifications: {
                count: 0,
                unread: 0,
                latest: []
            },
        };
    },
    mounted() {
        document.addEventListener('keydown', this.closeOnEscape);
        // On Listen Event
    },
    unmounted() {
        document.removeEventListener('keydown', this.closeOnEscape);
    }
}
</script>
