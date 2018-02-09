<template>
    <div>
        <div v-if="!container && !overlay">
            <a :href="previousLink" :class="{'uk-slidenav': !large, 'uk-slidenav-large': large}" uk-slidenav-previous></a>
            <a :href="nextLink" :class="{'uk-slidenav': !large, 'uk-slidenav-large': large}" uk-slidenav-next></a>
        </div>

        <div class="uk-slidenav-container" v-if="container">
            <a :href="previousLink" uk-slidenav-previous :class="{'uk-slidenav': !large, 'uk-slidenav-large': large}"></a>
            <a :href="nextLink" uk-slidenav-next :class="{'uk-slidenav': !large, 'uk-slidenav-large': large}"></a>
        </div>

        <div class="uk-position-relative uk-light" v-if="overlay">
            <a :class="{'uk-position-center-left': true, 'uk-slidenav-large': large}" :href="previousLink" uk-slidenav-previous></a>
            <a :class="{'uk-position-center-right': true, 'uk-slidenav-large': large}" :href="nextLink" uk-slidenav-next></a>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'ui-slider-nav',
        props: {
            'large':        { type: Boolean, default: false },
            'container':    { type: Boolean, default: false },
            'overlay':      { type: Boolean, default: false },
            'previousLink': { type: String, default: '#' },
            'nextLink':     { type: String, default: '#' },
        }
    }
</script>

<style scoped>
 .uk-position-center-left,
 .uk-position-center-right {
        color: rgba(102, 102, 102, 0.5);
    }
 .uk-position-center-left:hover,
 .uk-position-center-right:hover{
     color: rgba(66, 66, 66, 0.5);
 }
    .uk-position-relative.uk-light{
        padding: 20px;
        width: 80%;
        margin: 0 auto;
    }
</style>