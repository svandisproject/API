<template>
    <div>
        <ul :uk-accordion="getConfig()">
            <li class="uk-open">
                <a class="uk-accordion-title" href="#">Item 1</a>
                <div class="uk-accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </li>
            <li>
                <a class="uk-accordion-title" href="#">Item 2</a>
                <div class="uk-accordion-content">
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor reprehenderit.</p>
                </div>
            </li>
            <li>
                <a class="uk-accordion-title" href="#">Item 3</a>
                <div class="uk-accordion-content">
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                </div>
            </li>
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

