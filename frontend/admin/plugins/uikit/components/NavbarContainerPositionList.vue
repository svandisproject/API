<template>
    <div>
   <!--the rest of this component I propose for editing-->
        <p>static example for expanding the menu</p>
    <ul class="uk-navbar-nav">
        <li class="uk-active"><a href="#">Active</a></li>
        <li><a href="#">Item</a></li>
        <li>
            <a href="#">Parent</a>
            <div class="uk-navbar-dropdown">
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-header">Header</li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
        </li>
    </ul>
    </div>
</template>

<script>
    export default {
        name: 'ui-navbar-container-position-list'
    }
</script>

<style scoped>

</style>