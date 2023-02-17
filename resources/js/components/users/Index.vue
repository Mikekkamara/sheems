<template>
    <div class="shadow-sm p-2 m-1 bg-white" style="border-radius: 15px">
        <h4>
            <i class="fa-duotone fa-hippo"></i>
            Sheems
        </h4>
        <div class="d-flex flex-row gap-3 mt-5">
            <vs-button dark block style="max-width:fit-content"
                @click="$router.push({ name: 'users', query: { type: 'keyboardists' } })" :loading="loading">
                <h6 class="m-0">
                    <span class="d-block">
                        <i class="fa-duotone fa-piano-keyboard h2 text-danger m-0"></i>
                    </span>
                    <span class="d-block display-4 mt-3">
                        {{ allUsers.reduce((total, user) => (user.type === 1 ? total + 1 : total), 0) }}
                    </span>
                    <span class="text-muted">
                        Keyboardists
                    </span>
                </h6>
                <template #animate>
                    <i class='fa-duotone fa-arrow-right h3 m-0'></i>
                </template>
            </vs-button>
            <vs-button dark block style="max-width:fit-content"
                @click="$router.push({ name: 'users', query: { type: 'violinists' } })" :loading="loading">
                <h6 class="m-0">
                    <span class="d-block">
                        <i class="fa-duotone fa-violin h2 text-danger m-0"></i>
                    </span>
                    <span class="d-block display-4 mt-3">
                        {{ allUsers.reduce((total, user) => (user.type === 3 ? total + 1 : total), 0) }}
                    </span>
                    <span class="text-muted">
                        Violinists
                    </span>
                </h6>
                <template #animate>
                    <i class='fa-duotone fa-arrow-right h3 m-0'></i>
                </template>
            </vs-button>
            <vs-button dark block style="max-width:fit-content"
                @click="$router.push({ name: 'users', query: { type: 'worship-leaders' } })" :loading="loading">
                <h6 class="m-0">
                    <span class="d-block">
                        <i class="fa-duotone fa-microphone-stand h2 text-danger m-0"></i>
                    </span>
                    <span class="d-block display-4 mt-3">
                        {{ allUsers.reduce((total, user) => (user.type === 2 ? total + 1 : total), 0) }}
                    </span>
                    <span class="text-muted">
                        Worship Leaders
                    </span>
                </h6>
                <template #animate>
                    <i class='fa-duotone fa-arrow-right h3 m-0'></i>
                </template>
            </vs-button>
        </div>
        <div class="mt-5 d-flex flex-column gap-3">
            <div>
                <h5>
                    <i class="fa-duotone fa-stopwatch"></i>
                    <span>
                        Keyboardists
                    </span>
                </h5>
                <div v-if="ongoingShifts.keyboardists === undefined">
                    <vs-alert warn>
                        <template #icon>
                            <i class="fa-duotone fa-timer fa-2x"></i>
                        </template>
                        <template #title>
                            <h4 class="m-0 fw-bold">
                                Shifts
                            </h4>
                        </template>
                        There are no ongoing shifts. <br><br>
                        The ongoing shifts will appear here.
                    </vs-alert>
                    <div class="d-flex flex-row gap-1 mt-2">
                        <vs-button style="max-width:fit-content" v-for="shiftItem in allShifts.keyboardists"
                            @click="startShift(shiftItem.id, 1)" :key="shiftItem.id"
                            :loading="(shift.loading.id === shiftItem.id) && (shift.loading.keyboardists.start)" dark>
                            <h6 class="fw-bold m-0">
                                <i class="fa-duotone fa-play"></i>
                                <span class="p-1">
                                    Commence {{ shiftItem.name }}
                                </span>
                            </h6>
                        </vs-button>
                    </div>
                </div>
                <div v-else>
                    <vs-alert warn>
                        <template #icon>
                            <i class="fa-duotone fa-timer fa-2x"></i>
                        </template>
                        <template #title>
                            <h4 class="m-0 fw-bold">
                                Ongoing Shift :
                                <span class="text-muted">
                                    {{ ongoingShifts.keyboardists.name }}
                                </span>
                            </h4>
                        </template>
                        <span class="m-2 d-block">
                            Started:
                            <timeago :datetime="new Date(Date.parse(ongoingShifts.keyboardists.session_keyboardists.start))"
                                :auto-update="60">
                            </timeago>
                        </span>
                        <span class="m-2 d-block">
                            Checked In:
                            {{ clockedInKeyboardists }} / {{ totalKeyboardists }}
                        </span>
                    </vs-alert>
                    <div>
                        <div class="d-flex flex-row align-items-center p-2">
                            <vs-button dark :loading="shift.loading.keyboardists.end"
                                @click="endShift(ongoingShifts.keyboardists.id, 1)">
                                <h6 class="fw-bold m-0">
                                    <i class="fa-duotone fa-ban"></i>
                                    <span class="p-1">
                                        End Shift
                                    </span>
                                </h6>
                            </vs-button>
                            <vs-button
                                v-for="otherShift in allShifts.keyboardists.filter(shift => shift.id !== ongoingShifts.keyboardists.id)"
                                dark :loading="shift.loading.keyboardists.goToNext" :key="otherShift.id"
                                @click="goToNext(otherShift.id, 1)">
                                <h6 class="fw-bold m-0">
                                    <i class="fa-duotone fa-ban"></i>
                                    <i class="fa-duotone fa-forward"></i>
                                    <span class="p-1">
                                        End Shift and Commence
                                        {{ otherShift.name }}
                                    </span>
                                </h6>
                            </vs-button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5>
                    <i class="fa-duotone fa-stopwatch"></i>
                    <span>
                        Violinists
                    </span>
                </h5>
                <div v-if="ongoingShifts.violinists === undefined">

                    <vs-alert warn>
                        <template #icon>
                            <i class="fa-duotone fa-timer fa-2x"></i>
                        </template>
                        <template #title>
                            <h4 class="m-0 fw-bold">
                                Shifts
                            </h4>
                        </template>
                        There are no ongoing shifts. <br><br>
                        The ongoing shifts will appear here.
                    </vs-alert>
                    <div class="d-flex flex-row gap-1 mt-2">
                        <vs-button style="max-width:fit-content" v-for="shiftItem in allShifts.violinists"
                            @click="startShift(shiftItem.id, 3)" :key="shiftItem.id"
                            :loading="(shift.loading.id === shiftItem.id) && (shift.loading.violinists.start)" dark>
                            <h6 class="fw-bold m-0">
                                <i class="fa-duotone fa-play"></i>
                                <span class="p-1">
                                    Commence {{ shiftItem.name }}
                                </span>
                            </h6>
                        </vs-button>
                    </div>
                </div>
                <div v-else>
                    <vs-alert warn>
                        <template #icon>
                            <i class="fa-duotone fa-timer fa-2x"></i>
                        </template>
                        <template #title>
                            <h4 class="m-0 fw-bold">
                                Ongoing Shift :
                                <span class="text-muted">
                                    {{ ongoingShifts.violinists.name }}
                                </span>
                            </h4>
                        </template>
                        <span class="m-2 d-block">
                            Started:
                            <timeago :datetime="new Date(Date.parse(ongoingShifts.violinists.session_violinists.start))"
                                :auto-update="60">
                            </timeago>
                        </span>
                        <span class="m-2 d-block">
                            Checked In:
                            {{ clockedInViolinists }} / {{ totalViolinists }}
                        </span>
                    </vs-alert>
                    <div>
                        <div class="d-flex flex-row align-items-center p-2">
                            <vs-button dark :loading="shift.loading.violinists.end"
                                @click="endShift(ongoingShifts.violinists.id, 3)">
                                <h6 class="fw-bold m-0">
                                    <i class="fa-duotone fa-ban"></i>
                                    <span class="p-1">
                                        End Shift
                                    </span>
                                </h6>
                            </vs-button>
                            <vs-button
                                v-for="otherShift in allShifts.violinists.filter(shift => shift.id !== ongoingShifts.violinists.id)"
                                dark :loading="shift.loading.violinists.goToNext" :key="otherShift.id"
                                @click="goToNext(otherShift.id, 3)">
                                <h6 class="fw-bold m-0">
                                    <i class="fa-duotone fa-ban"></i>
                                    <i class="fa-duotone fa-forward"></i>
                                    <span class="p-1">
                                        End Shift and Commence
                                        {{ otherShift.name }}
                                    </span>
                                </h6>
                            </vs-button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5>
                    <i class="fa-duotone fa-stopwatch"></i>
                    <span>
                        Worship Leaders
                    </span>
                </h5>
                <div v-if="ongoingShifts.worship_leaders === undefined">
                    <vs-alert warn>
                        <template #icon>
                            <i class="fa-duotone fa-timer fa-2x"></i>
                        </template>
                        <template #title>
                            <h4 class="m-0 fw-bold">
                                Shifts
                            </h4>
                        </template>
                        There are no ongoing shifts. <br><br>
                        The ongoing shifts will appear here.
                    </vs-alert>
                    <div class="d-flex flex-row gap-1 mt-2">
                        <vs-button style="max-width:fit-content" v-for="shiftItem in allShifts.worship_leaders"
                            @click="startShift(shiftItem.id, 2)" :key="shiftItem.id"
                            :loading="(shift.loading.id === shiftItem.id) && (shift.loading.worshipLeaders.start)" dark>
                            <h6 class="fw-bold m-0">
                                <i class="fa-duotone fa-play"></i>
                                <span class="p-1">
                                    Commence {{ shiftItem.name }}
                                </span>
                            </h6>
                        </vs-button>
                    </div>
                </div>
                <div v-else>
                    <vs-alert warn>
                        <template #icon>
                            <i class="fa-duotone fa-timer fa-2x"></i>
                        </template>
                        <template #title>
                            <h4 class="m-0 fw-bold">
                                Ongoing Shift :
                                <span class="text-muted">
                                    {{ ongoingShifts.worship_leaders.name }}
                                </span>
                            </h4>
                        </template>
                        <span class="m-2 d-block">
                            Started:
                            <timeago
                                :datetime="new Date(Date.parse(ongoingShifts.worship_leaders.session_worship_leaders.start))"
                                :auto-update="60">
                            </timeago>
                        </span>
                        <span class="m-2 d-block">
                            Checked In:
                            {{ clockedInWorshipLeaders }} / {{ totalWorshipLeaders }}
                        </span>
                    </vs-alert>
                    <div>
                        <div class="d-flex flex-row align-items-center p-2">
                            <vs-button dark :loading="shift.loading.worshipLeaders.end"
                                @click="endShift(ongoingShifts.worship_leaders.id, 2)">
                                <h6 class="fw-bold m-0">
                                    <i class="fa-duotone fa-ban"></i>
                                    <span class="p-1">
                                        End Shift
                                    </span>
                                </h6>
                            </vs-button>
                            <vs-button
                                v-for="otherShift in allShifts.worship_leaders.filter(shift => shift.id !== ongoingShifts.worship_leaders.id)"
                                dark :loading="shift.loading.worshipLeaders.goToNext" :key="otherShift.id"
                                @click="goToNext(otherShift.id, 2)">
                                <h6 class="fw-bold m-0">
                                    <i class="fa-duotone fa-ban"></i>
                                    <i class="fa-duotone fa-forward"></i>
                                    <span class="p-1">
                                        End Shift and Commence
                                        {{ otherShift.name }}
                                    </span>
                                </h6>
                            </vs-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
    data() {
        return {
            shift: {
                loading: {
                    id: '',
                    keyboardists: {
                        start: false,
                        end: false,
                        goToNext: false
                    },
                    worshipLeaders: {
                        start: false,
                        end: false,
                        goToNext: false
                    },
                    violinists: {
                        start: false,
                        end: false,
                        goToNext: false
                    }
                }
            },
            loadingTypes: [
                'analyst',
                'keyboardists',
                'worshipLeaders',
                'violinists'
            ],
            loading: true,
            errors: false,
            createForm: {
                name: '',
                email: '',
                from: '',
                type: 3,
                title: 0,
                shift: '',
                phone: '',
                loading: false
            }
        }
    },
    async mounted() {
        await this.$store.dispatch('getShifts');
        this.loading = false;
    },
    computed: {
        ...mapGetters(['allUsers', 'allShifts', 'ongoingShifts', 'csrfToken']),
        shiftUsers() {
            return this.allUsers.filter(user => user.shift_id === this.ongoingShift.id);
        },
        clockedInKeyboardists() {
            return this.allUsers.reduce((total, user) => {
                if (user.type !== 1 || user.shift_id !== this.ongoingShifts.keyboardists.id) {
                    return total;
                }
                let attendance = user.attendances.find(attendance => attendance.session_id === this.ongoingShifts.keyboardists.ongoing_session_keyboardists);


                if (attendance !== undefined) {
                    if (attendance.start !== null && attendance.end == null) {
                        return total + 1;
                    }
                }

                return total;
            }, 0);
        },
        clockedInViolinists() {
            return this.allUsers.reduce((total, user) => {
                if (user.type !== 3 || user.shift_id !== this.ongoingShifts.violinists.id) {
                    return total;
                }
                let attendance = user.attendances.find(attendance => attendance.session_id === this.ongoingShifts.violinists.ongoing_session_violinists);


                if (attendance !== undefined) {
                    if (attendance.start !== null && attendance.end == null) {
                        return total + 1;
                    }
                }

                return total;
            }, 0);
        },
        clockedInWorshipLeaders() {
            return this.allUsers.reduce((total, user) => {
                if (user.type !== 3 || user.shift_id !== this.ongoingShifts.worship_leaders.id) {
                    return total;
                }
                let attendance = user.attendances.find(attendance => attendance.session_id === this.ongoingShifts.worship_leaders.ongoing_session_worship_leaders);


                if (attendance !== undefined) {
                    if (attendance.start !== null && attendance.end == null) {
                        return total + 1;
                    }
                }

                return total;
            }, 0);
        },
        totalKeyboardists() {
            return this.allUsers.reduce((total, user) => (user.type === 1 && user.shift_id === this.ongoingShifts.keyboardists.id ? total + 1 : total), 0)
        },
        totalViolinists() {
            return this.allUsers.reduce((total, user) => (user.type === 3 && user.shift_id === this.ongoingShifts.violinists.id ? total + 1 : total), 0)
        },
        totalWorshipLeaders() {
            return this.allUsers.reduce((total, user) => (user.type === 2 && user.shift_id === this.ongoingShifts.worship_leaders.id ? total + 1 : total), 0)
        }
    },
    methods: {
        createUser() {
            this.createForm.loading = true;

            this.errors = false;

            let { name, email, from, shift, phone } = this.createForm;

            if (name === '' || from === '' || shift === '' || phone === '') {
                this.errors = true;
                this.createForm.loading = false;
            } else {
                //Get form
                let form = document.querySelector('#createUserForm');

                let createForm = new FormData(form);

                let items = this.allShifts.find(item => item.name === shift.trim());

                createForm.append('shift', items.id);

                //Attach profile image
                createForm.append('profile', this.$refs.profile.files[0]);

                this.$store.dispatch('createUser', createForm).then(response => {
                    this.createForm = { name: '', email: '', from: '', shift: '', phone: '', loading: false };
                    this.createForm.loading = false;
                    this.$bvModal.hide('add-user');

                });
            }

        },
        startShift(shiftId, type) {
            this.shift.loading.id = shiftId;

            this.shift.loading[this.loadingTypes[type]].start = true;

            this.$store.dispatch('startShift', { shiftId, type }).then(async response => {
                // console.log('start', response.data);


                await this.$store.dispatch('getShifts').then(shifts => {
                    this.shift.loading[this.loadingTypes[type]].start = false;
                })
                // window.location.reload();
            });
        },
        async endShift(shiftId, type) {
            this.shift.loading.id = shiftId;

            this.shift.loading[this.loadingTypes[type]].end = true;

            await this.$store.dispatch('endShift', { shiftId, type }).then(async response => {
                // console.log('end', response.data);
                await this.$store.dispatch('getShifts').then(shifts => {
                    this.shift.loading[this.loadingTypes[type]].end = false;
                });
            });
        },
        async goToNext(shiftId, type) {
            this.shift.loading.id = shiftId;

            this.shift.loading[this.loadingTypes[type]].goToNext = true;

            let payload = {
                nextId: this.allShifts.keyboardists.find(shift => shift.id !== shiftId).id,
                shiftId,
                type
            };

            await this.$store.dispatch('goToNext', payload).then(async response => {

                await this.$store.dispatch('getShifts').then(shifts => {
                    this.shift.loading[this.loadingTypes[type]].goToNext = false;
                });
            })
        }
    },
    beforeRouteUpdate(to, from, next) {
        console.log('hello')
    }
}
</script>
<style>
.template-modal {
    border-radius: 15px;
}

.template-modal-header {
    border: none;
}
</style>
