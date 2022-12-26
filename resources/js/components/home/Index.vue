<template>
    <div class="container mx-auto">
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    props: ['user'],
    data() {
        return {
            items: null
        }
    },
    created() {
        this.$store.dispatch('getUsers');
    }
}
</script>

<style>

</style>
