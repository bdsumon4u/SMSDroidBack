import { screen } from "./screen";
import { theme } from "./theme";

export const sidebar = {
    mixins: [screen, theme],
    emits: ['sidebarToggle'],
    methods: {
        sidebarToggle() {
            this.sidebarFull = !this.sidebarFull;
            this.$emit('sidebarToggle');
        },
        shouldMaximize() {
            return this.sidebarFull = this.isDevice('lg');
        },
        setSidebarHeight() {
            const target = document.querySelector('.sidebar > div > ul');
            const px = document.body.scrollHeight - 3.5 * 16;
            target.style.height = px / 16 + 'rem';
        },
        doOpen(item_id) {
            this.open_id = this.open_id === item_id ? null : item_id;
        },
        hasSub(item) {
            let _class = '';
            if (item.children) {
                _class += 'has-sub';
                if (this.open_id === item.id) {
                    _class += ' open';
                }
            }
            return _class;
        },
        isActive(item) {
            if (item.active?.length) {
                return this.routeIn(item.active ?? []);
            }

            let href = item.href;
            if (href && !href.startsWith(location.origin)) {
                href = location.origin + href;
            }
            return location.href === href;
        },
        routeIn(active) {
            return active.some(item => route().current(item));
        }
    },
    data() {
        return {
            open_id: null,
            sidebarFull: false,
            items: [
                {
                    id: 'dashboard',
                    name: 'Dashboard',
                    icon: 'home-smile',
                    href: route('admin.dashboard'),
                }
            ],
        }
    },
    watch: {
        windowWidth() {
            this.shouldMaximize();
            this.setSidebarHeight();
        },
    },
    created() {
        this.shouldMaximize();
    },
    mounted() {
        this.setSidebarHeight();
    }
}
