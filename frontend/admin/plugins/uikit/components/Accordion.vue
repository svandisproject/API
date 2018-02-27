<template>
    <div>
        <ul :uk-accordion="getConfig()">
            <slot>
                <uk-accordion-content></uk-accordion-content>
            </slot>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'uk-accordion',
        props: {
            'notCollapsible': { type: Boolean, default: false },
            'multiple':    { type: Boolean, default: false },
            // 'uk-open':     { type: Boolean, default: false },
        },
        methods: {
            getConfig() {
                if((this.notCollapsible) && (this.multiple)){
                    throw new Error('Collapsed style is can not be closed and multi-open together')
                }
                let config = {};

                if(this.multiple) {
                    config.multiple = true
                }
                if(this.notCollapsible) {
                    config.collapsible = false
                }
                console.log(config);
                return JSON.stringify(config);
            }
        }
    }
</script>

