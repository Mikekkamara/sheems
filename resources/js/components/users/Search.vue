<template>
    <div class="p-2">
        <div class="d-flex flex-row items-center p-2 mb-1 gap-2">
            <vs-switch v-model="filters.checkedIn" dark>
                <span class="fs-6 fw-bold" :key="`${filters.checkedIn}-checked-in`">
                    <i class='fa-duotone' :class="[filters.checkedIn ? 'fa-check' : 'fa-times']"></i>
                    {{ filters.checkedIn ? 'Checked In' : 'All' }}
                </span>
            </vs-switch>
            <vs-switch v-model="filters.shiftA" dark>
                <span class="fs-6 fw-bold" :key="`${filters.shiftA}-shift-a`">
                    <i class='fa-duotone' :class="[filters.shiftA ? 'fa-check' : 'fa-times']"></i>
                    Shift A
                </span>
            </vs-switch>
            <vs-switch v-model="filters.shiftB" dark>
                <span class="fs-6 fw-bold" :key="`${filters.shiftB}-shift-b`">
                    <i class='fa-duotone' :class="[filters.shiftB ? 'fa-check' : 'fa-times']"></i>
                    Shift B
                </span>
            </vs-switch>
        </div>
        <div class="d-flex flex-row align-items-center gap-1">
            <vs-input type="search" style="max-width: 430px;" class="w-100" @change="searchUsers"
                placeholder="search using name or user number" :loading="loading" v-model="search"></vs-input>
            <vs-button icon circle dark>
                <i class="fa-duotone fa-magnifying-glass"></i>
            </vs-button>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    data() {
        return {
            search: '',
            filters: {
                checkedIn: false,
                shiftA: true,
                shiftB: true
            },
            loading: false
        }
    },
    computed: {
        ...mapGetters(["allShifts"])
    },
    mounted() {
        this.$store.subscribe((mutation, state) => {
            if (mutation.type === 'setUsers') {
                let storedFilters = localStorage.getItem('filters');
                if (storedFilters) {
                    this.filters = JSON.parse(storedFilters);
                }

                let storedSearch = localStorage.getItem('search');

                if (storedSearch) {
                    this.search = storedSearch;
                }
            }
        });

    },
    methods: {
        searchUsers() {
            this.loading = true;
            localStorage.setItem('search', this.search);

            this.$store.commit('searchUsers', this.search);

            if (this.search.length === 0) {
                localStorage.removeItem('search')
                this.$store.commit('resetSearch');
            }

            this.loading = false;
        }
    },
    watch: {
        filters: {
            handler(value) {
                localStorage.setItem('filters', JSON.stringify(value));
                this.$store.commit('filter', value);
            },
            deep: true
        }
    }
}
</script>
