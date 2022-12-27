<template>
    <div class="p-2 container m-2">
        <label for="search-input">
            Type to search users
        </label>
        <vs-input type="text" placeholder="search using name or user number" :loading="loading"
            v-model="search"></vs-input>
    </div>
</template>
<script>
export default {
    data() {
        return {
            search: '',
            loading: false
        }
    },
    watch: {
        async search(value) {
            this.loading = true;

            if (value.length > 1) {
                this.$store.commit('searchUsers', value);
            }

            if (value.length === 0) {
                let query = this.$route.query.type;

                if (query) {
                    await this.$store.dispatch('getUsers', query);
                } else {
                    await this.$store.dispatch('getUsers');
                }
            }

            this.loading = false;
        }
    }
}
</script>
