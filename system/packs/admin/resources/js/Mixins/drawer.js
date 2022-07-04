export const drawer = {
    emits: ['drawerToggle'],
    methods: {
        drawerToggle() {
            this.drawerOpen = !this.drawerOpen;
            this.$emit('drawerToggle');
        },
        isTabOpen(tab, def = false) {
            return this.activeTab
                ? this.activeTab === tab
                : def;
        },
    },
    data() {
        return {
            drawerOpen: false,
            activeTab: false,
        }
    },
}
