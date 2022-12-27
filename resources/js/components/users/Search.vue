<template>
    <div class="p-2 container m-2">
        <label for="search-input" class="lead">
            Type to search users
        </label>
        <vs-input type="text" style="max-width: 430px;" class="w-100" @change="searchUsers"
            placeholder="search using name or user number" :loading="loading" v-model="search"></vs-input>
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
    mounted() {
        let storedSearch = localStorage.getItem('search');
        if (storedSearch) {
            this.search = storedSearch;
            this.$store.subscribe((mutation, state) => {
                if (mutation.type === 'setUsers') {
                    this.searchUsers();
                }
            })
        }
    },
    methods: {
        searchUsers() {
            this.loading = true;


            if (this.search.length > 1) {
                localStorage.setItem('search', this.search);

                this.$store.commit('searchUsers', this.search);
            }

            if (this.search.length === 0) {
                localStorage.removeItem('search')
                this.$store.commit('resetSearch');
            }

            this.loading = false;
        }
    }
}
</script>
