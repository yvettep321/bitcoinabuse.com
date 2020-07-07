Vue.component('spark-contributor-badge', {
    /**
     * The component's data.
     */
    data() {
        return {
            width_px: "260",
            use_100_width: false,
            use_dark: false,
            border: true,
            rounded_corners: true,
            include_link: true,
        };
    },


    /**
     * Prepare the component.
     */
    mounted() {
    },


    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;
    },


    methods: {
        /**
         * Get the current API tokens for the user.
         */
        getCode() {

            output = `<img width="`+(this.use_100_width || this.width_px < 160 || this.width_px > 640 ? '100%' : this.width_px + 'px')+`" title="BitcoinAbuse.com Certified Contributor" srcset="https://www.bitcoinabuse.com/img/badges/badge-`+(this.use_dark ? 'dark' : 'white')+`-md.png 448w, https://www.bitcoinabuse.com/img/badges/badge-`+(this.use_dark ? 'dark' : 'white')+`-sm.png 224w" src="https://www.bitcoinabuse.com/img/badges/badge-`+(this.use_dark ? 'dark' : 'white')+`-lg.png" style="max-width: 640px;` + (this.rounded_corners ? 'border-radius:6px;' : '') + (this.border ? 'border: 1px solid #111;' : '') + `">`;
            if (this.include_link) {
            	output = `<a href="https://www.bitcoinabuse.com" target="_blank" rel="noopener" title="Bitcoin Abuse Database">` + output + `</a>`;
            }
            return output;
        },
    }
});