export const screen = {
    computed: {
        breakpoints() {
            return {
                '2xl': 1536,
                'xl': 1280,
                'lg': 1024,
                'md': 768,
                'sm': 640,
                'xs': 0,
            }
        }
    },
    methods: {
        onResize() {
            this.windowWidth = window.innerWidth
        },
        isDevice(size) {
            return this.windowWidth >= this.breakpoints[size]
        },
        detectScreenType() {
            if (this.windowWidth >= 1536) {
                return this.screenType = '2xl';
            }

            if (this.windowWidth >= 1280) {
                return this.screenType = 'xl';
            }

            if (this.windowWidth >= 1024) {
                return this.screenType = 'lg';
            }

            if (this.windowWidth >= 768) {
                return this.screenType = 'md';
            }

            if (this.windowWidth >= 640) {
                return this.screenType = 'sm';
            }

            return this.screenType = 'xs';
        },
    },
    data() {
        return {
            windowWidth: window.innerWidth,
            screenType: null,
        }
    },
    watch: {
        windowWidth(){
            this.detectScreenType()
        }
    },
    created() {
        this.detectScreenType();
        window.addEventListener('resize', this.onResize);
        this.onResize();
    },
    unmounted() {
        window.removeEventListener('resize', this.onResize);
    },
}
