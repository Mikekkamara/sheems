<template>
    <div class="p-2 container m-2">
        <div class="d-flex flex-row items-center p-2 mb-1 gap-2">
            <vs-switch v-model="checkedIn" dark @change="filterCheckedIn">
                <span class="fs-6 fw-bold" :key="`${checkedIn}-checked-in`">
                    <i class='fa-duotone' :class="[checkedIn ? 'fa-check' : 'fa-times']"></i>
                    {{ checkedIn ? 'Checked In' : 'All' }}
                </span>
            </vs-switch>
        </div>
        <vs-input type="text" style="max-width: 430px;" class="w-100" @change="searchUsers"
            placeholder="search using name or user number" :loading="loading" v-model="search"></vs-input>
    </div>
</template>
<script>
export default {
    data() {
        return {
            search: '',
            checkedIn: false,
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
        let storedCheckedIn = localStorage.getItem('checkedIn');
        if (storedCheckedIn) {
            this.checkedIn = JSON.parse(storedCheckedIn);
            this.$store.subscribe((mutation, state) => {
                if (mutation.type === 'setUsers') {
                    this.filterCheckedIn();
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
        },
        filterCheckedIn() {
            localStorage.setItem('checkedIn', JSON.stringify(this.checkedIn));

            if (this.checkedIn) {

                this.$store.commit('filterCheckedIn');
            } else {
                this.$store.commit('resetSearch');
            }
        }
    }
}
</script>
