<template>
    <div class="p-2">
        <div class="d-flex flex-row flex-wrap items-center p-2 mb-1 gap-2">
            <vs-switch v-model="filters.checkedIn" dark>
                <span class="fs-6 fw-bold" :key="`${filters.checkedIn}-checked-in`">
                    <i class='fa-duotone' :class="[filters.checkedIn ? 'fa-check' : 'fa-times']"></i>
                    Checked In
                </span>
            </vs-switch>
            <vs-switch v-model="filters.absent" danger>
                <span class="fs-6 fw-bold" :key="`${filters.absent}-absent`">
                    <i class='fa-duotone' :class="[filters.absent ? 'fa-check' : 'fa-times']"></i>
                    Absent
                </span>
            </vs-switch>
            <vs-switch :loading="loadingShiftA" v-model="filters.shifts.shiftA" dark>
                <span class="fs-6 fw-bold" :key="`${filters.shifts.shiftA}-shift-a`">
                    <i class='fa-duotone' :class="[filters.shifts.shiftA ? 'fa-check' : 'fa-times']"></i>
                    Shift A
                </span>
            </vs-switch>
            <vs-switch :loading="loadingShiftB" v-model="filters.shifts.shiftB" dark>
                <span class="fs-6 fw-bold" :key="`${filters.shifts.shiftB}-shift-b`">
                    <i class='fa-duotone' :class="[filters.shifts.shiftB ? 'fa-check' : 'fa-times']"></i>
                    Shift B
                </span>
            </vs-switch>
            <vs-switch :loading="loadingShiftC" v-model="filters.shifts.shiftC" dark>
                <span class="fs-6 fw-bold" :key="`${filters.shifts.shiftC}-shift-b`">
                    <i class='fa-duotone' :class="[filters.shifts.shiftC ? 'fa-check' : 'fa-times']"></i>
                    Shift C
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
                checkedIn: true,
                absent: true,
                shifts: {
                    shiftA: false,
                    shiftB: false,
                    shiftC: false
                }
            },
            loadingShiftA: false,
            loadingShiftB: false,
            loadingShiftC: false,
            loading: false
        }
    },
    computed: {
        ...mapGetters(["allShifts"])
    },
    mounted() {
        localStorage.clear();

    },
    methods: {
        filterShiftA(val) {
            console.log(val)
        },
        filterShiftB() {
            console.log('filter shift b')
        },
        filterShiftC() {
            console.log('filter c')
        },
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
        'filters.shifts.shiftA': {
            async handler(value) {

                this.loadingShiftA = true;

                if (value === false && this.filters.shifts.shiftB === false && this.filters.shifts.shiftC === false) {

                    await this.$store.dispatch('getUsers');

                }

                if (value) {

                    let shiftAId = this.allShifts.keyboardists.find(shift => shift.name == 'Shift A').id;

                    this.$store.state.users = this.$store.state.users.filter(user => user.shift_id == shiftAId);

                }

                this.loadingShiftA = false;
            },
            deep: true
        },
        'filters.shifts.shiftB': {
            async handler(value) {

                this.loadingShiftB = true;

                if (value === false && this.filters.shifts.shiftA === false && this.filters.shifts.shiftC === false) {

                    await this.$store.dispatch('getUsers');

                }

                if (value) {

                    let shiftBId = this.allShifts.keyboardists.find(shift => shift.name == 'Shift B').id;

                    this.$store.state.users = this.$store.state.users.filter(user => user.shift_id == shiftBId);

                }

                this.loadingShiftB = false;
            },
            deep: true
        },
        'filters.shifts.shiftC': {
            async handler(value) {

                this.loadingShiftC = true;

                if (value === false && this.filters.shifts.shiftA === false && this.filters.shifts.shiftB === false) {

                    await this.$store.dispatch('getUsers');

                }

                if (value) {

                    let shiftCId = this.allShifts.keyboardists.find(shift => shift.name == 'Shift C').id;

                    this.$store.state.users = this.$store.state.users.filter(user => user.shift_id == shiftCId);

                }

                this.loadingShiftC = false;
            },
            deep: true
        },
        filters: {
            handler(value) {
                // localStorage.setItem('filters', JSON.stringify(value));
                // this.$store.commit('filter', value);
            },
            deep: true
        },
    }
}
</script>
