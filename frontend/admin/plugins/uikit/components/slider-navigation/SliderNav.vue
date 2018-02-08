<template>
    <div>
        <a href="#" uk-slidenav-previous></a>
        <a href="#" uk-slidenav-next></a>

        <p>Large modifier</p>
        <a href="#" class="uk-slidenav-large" uk-slidenav-previous></a>
        <a href="#" class="uk-slidenav-large" uk-slidenav-next></a>

        <p> Slidenav container</p>
        <div class="uk-slidenav-container">
            <a href="" uk-slidenav-previous></a>
            <a href="" uk-slidenav-next></a>
        </div>

        <p>Position as overlay</p>
        <div class="uk-position-relative uk-light">
            <a class="uk-position-center-left" href="" uk-slidenav-previous></a>
            <a class="uk-position-center-right" href="" uk-slidenav-next></a>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'ui-slider-nav'
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