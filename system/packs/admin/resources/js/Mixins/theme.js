export const theme = {
    emits: ['themeToggle'],
    methods: {
        getTheme() {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }
            return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
        },
        setTheme(value) {
            window.localStorage.setItem('dark', value)
        },
        themeToggle() {
            this.isDark = !this.isDark;
            this.setTheme(this.isDark);
            this.$emit('themeToggle');
        },
    },
    data() {
        return {
            isDark: this.getTheme(),
        }
    }
}
