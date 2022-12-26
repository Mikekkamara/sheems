<template>
    <div class="shadow-sm p-2 m-1 bg-white" style="border-radius: 15px">
        <h4>
            <i class="fa-duotone fa-hippo"></i>
            Sheems
        </h4>

        <!-- <div v-if="ongoingShift === false" class="p-3">
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
                The ongoing shifts will appear here. -->
        <!-- <div>
                    <h5 class="m-0 text-center">
                    </h5> -->

        <!-- <div v-if="shift.loading === false"
                        class="d-flex flex-column flex-md-row justify-content-center align-items-center p-2 m-2 mb-4">
                        <vs-button v-for="shift in allShifts" @click="startShift(shift.id)" :key="shift.id" dark>
                            <h6 class="fw-bold m-0">
                                <i class="fa-duotone fa-play"></i>
                                <span class="p-1">
                                    Commence {{ shift.name }}
                                </span>
                            </h6>
                        </vs-button>
                    </div>
                    <div v-else class="d-flex flex-row justify-content-center align-items-center p-2 m-2">
                        <div class="spinner-border spinner-border-sm" role="status" style="height: 30px; width: 30px;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div> -->
        <!-- </div> -->
        <!-- </vs-alert>
        </div> -->
        <!-- <div class="p-3" v-else>
            <vs-alert warn>
                <template #icon>
                    <i class="fa-duotone fa-timer fa-2x"></i>
                </template>
                <template #title>
                    <h4 class="m-0 fw-bold">
                        Ongoing Shift :
                        <span class="text-muted">
                            {{ ongoingShift.name }}
                        </span>
                    </h4>
                </template>
                <div>
                    <div class="d-flex flex-row align-items-center">
                        <h6 class="m-0 fw-bold d-flex flex-row align-items-center">
                            <i class="fa-duotone fa-clock fa-2x"></i>
                            <span class="m-2">
                                Started:
                            </span>
                        </h6>
                        <timeago :datetime="new Date(Date.parse(ongoingShift.session.start))" :auto-update="60">
                        </timeago>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <h6 class="m-0 fw-bold d-flex flex-row align-items-center">
                            <i class="fa-duotone fa-circle-check fa-2x"></i>
                            <span class="m-2">
                                Checked In:
                            </span>
                        </h6>
                        Checked in {{ clockedInUsers.length }} of {{ shiftUsers.length }}
                    </div>
                    <div class="d-flex flex-row align-items-center p-2">
                        <vs-button dark @click="endShift(ongoingShift.id)">
                            <h6 class="fw-bold m-0">
                                <i class="fa-duotone fa-ban"></i>
                                <span class="p-1">
                                    End Shift
                                </span>
                            </h6>
                        </vs-button>
                        <vs-button dark @click="goToNext(ongoingShift.id)">
                            <h6 class="fw-bold m-0">
                                <i class="fa-duotone fa-ban"></i>
                                <i class="fa-duotone fa-forward"></i>
                                <span class="p-1">
                                    End Shift and Commence {{ allShifts.find(shift => shift.id !== ongoingShift.id).name
}}
                                </span>
                            </h6>
                        </vs-button>
                    </div>
                </div>
            </vs-alert>
        </div> -->
        <!-- <div class="d-flex flex-row mb-3">
            <router-link :to="{ name: 'homeAll' }" class="text-decoration-none">
                <vs-button danger flat :active="$route.path.includes('all')">
                    <h6 class="m-0  fw-bold">
                        <i class="fa-duotone fa-users"></i>
                        All Users
                    </h6>
                </vs-button>
            </router-link>
            <router-link :to="{ name: 'clock' }" class="text-decoration-none">
                <vs-button danger flat :active="$route.path.includes('clock')">
                    <h6 class="m-0 fw-bold">
                        <i class="fa-duotone fa-list-check"></i>
                        Clock In Users
                    </h6>
                </vs-button>
            </router-link>
        </div> -->
        <!-- <div>
            <transition>
                <router-view :key="$route.path"></router-view>
            </transition>
        </div> -->
        <div class="d-flex flex-row gap-3 mt-5">
            <vs-button dark block style="max-width:fit-content">
                <h6 class="m-0">
                    <span class="d-block">
                        <i class="fa-duotone fa-piano-keyboard h2 text-danger m-0"></i>
                    </span>
                    <span class="d-block display-4 mt-3">
                        200
                    </span>
                    <span class="text-muted">
                        Keyboardists
                    </span>
                </h6>
                <template #animate>
                    <i class='fa-duotone fa-arrow-right h3 m-0'></i>
                </template>
            </vs-button>
            <vs-button dark block style="max-width:fit-content">
                <h6 class="m-0">
                    <span class="d-block">
                        <i class="fa-duotone fa-violin h2 text-danger m-0"></i>
                    </span>
                    <span class="d-block display-4 mt-3">
                        200
                    </span>
                    <span class="text-muted">
                        Violinists
                    </span>
                </h6>
                <template #animate>
                    <i class='fa-duotone fa-arrow-right h3 m-0'></i>
                </template>
            </vs-button>
            <vs-button dark block style="max-width:fit-content">
                <h6 class="m-0">
                    <span class="d-block">
                        <i class="fa-duotone fa-microphone-stand h2 text-danger m-0"></i>
                    </span>
                    <span class="d-block display-4 mt-3">
                        200
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
                    <vs-button style="max-width:fit-content" v-for="shift in allShifts" @click="startShift(shift.id)"
                        :key="shift.id" dark>
                        <h6 class="fw-bold m-0">
                            <i class="fa-duotone fa-play"></i>
                            <span class="p-1">
                                Commence {{ shift.name }}
                            </span>
                        </h6>
                    </vs-button>
                </div>
            </div>
            <div>
                <h5>
                    <i class="fa-duotone fa-stopwatch"></i>
                    <span>
                        Violinists
                    </span>
                </h5>
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
                    <vs-button style="max-width:fit-content" v-for="shift in allShifts" @click="startShift(shift.id)"
                        :key="shift.id" dark>
                        <h6 class="fw-bold m-0">
                            <i class="fa-duotone fa-play"></i>
                            <span class="p-1">
                                Commence {{ shift.name }}
                            </span>
                        </h6>
                    </vs-button>
                </div>
            </div>
            <div>
                <h5>
                    <i class="fa-duotone fa-stopwatch"></i>
                    <span>
                        Worship Leaders
                    </span>
                </h5>
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
                    <vs-button style="max-width:fit-content" v-for="shift in allShifts" @click="startShift(shift.id)"
                        :key="shift.id" dark>
                        <h6 class="fw-bold m-0">
                            <i class="fa-duotone fa-play"></i>
                            <span class="p-1">
                                Commence {{ shift.name }}
                            </span>
                        </h6>
                    </vs-button>
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
                loading: false
            },
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
    mounted() {
        this.$store.dispatch('getShifts');
    },
    computed: {
        ...mapGetters(['allUsers', 'allShifts', 'ongoingShift', 'csrfToken']),
        shiftUsers() {
            return this.allUsers.filter(user => user.shift_id === this.ongoingShift.id);
        },
        clockedInUsers() {
            return this.shiftUsers.filter(user => {
                let attendance = user.attendances.find(item => item.session_id === this.ongoingShift.ongoing_session);

                if (attendance !== undefined) {
                    if (attendance.start !== null && attendance.end == null) {
                        return true;
                    }
                } else {
                    return false;
                }
            })
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
        startShift(shiftId) {
            this.shift.loading = true;

            this.$store.dispatch('startShift', shiftId).then(response => {
                // console.log('start', response.data);
                this.shift.loading = false;
                window.location.reload();
            });
        },
        endShift(shiftId) {
            this.shift.loading = true;

            this.$store.dispatch('endShift', shiftId).then(response => {
                // console.log('end', response.data);
                this.shift.loading = false;
                window.location.reload();
            });
        },
        goToNext(shiftId) {
            let payload = {
                nextId: this.allShifts.find(shift => shift.id !== shiftId).id,
                shiftId
            };

            this.$store.dispatch('goToNext', payload).then(response => {
                // console.log('next', response.data);
                window.location.reload();
            })
        }
    },
    watch: {

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
