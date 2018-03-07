<template lang="html">

    <section>
        <h2>Create FB User</h2>
        <fbUser-input />
        <h2>Registered FB users</h2>
        <ui-card>
            <k-datatable resource="facebook-user" :columns="getColumns()"/>
        </ui-card>

    </section>

</template>

<script lang="js">
    import FbUserInput from '../components/FbUserInput'
    export default  {
        name: 'fbUser',
        props: [],
        methods: {
            getColumns() {
                return [
                    { title: 'Email', field: 'email', sortable: true},
                    { title: 'Password', field: 'password', sortable: false},
                ]
            }
        },
        computed: {

        },
        components: {
            FbUserInput
        }
    }
</script>

