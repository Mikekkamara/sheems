<template>
    <div class="shadow-sm p-2 m-1 bg-white" style="border-radius: 15px; height: fit-content !important">
        <h4>
            <i class="fa-duotone fa-elephant"></i>
            Sheems Users
        </h4>
        <!-- Nav -->
        <div class="d-flex flex-row gap-2 mt-5">
            <vs-button style="max-width:fit-content" @click="$router.push({ query: {} })" dark flat
                :active="Object.keys($route.query).length === 0">
                <h6 class="fw-bold m-0">
                    <i class="fa-duotone fa-timer"></i>
                    <span class="p-1">
                        All
                    </span>
                </h6>
            </vs-button>
            <vs-button style="max-width:fit-content" @click="$router.push({ query: { type: 'keyboardists' } })"
                :active="$route.query.type === 'keyboardists'" dark flat>
                <h6 class="fw-bold m-0">
                    <i class="fa-duotone fa-piano-keyboard"></i>
                    <span class="p-1 d-none d-md-inline">
                        Keyboardists
                    </span>
                </h6>
            </vs-button>
            <vs-button style="max-width:fit-content" @click="$router.push({ query: { type: 'violinists' } })"
                :active="$route.query.type === 'violinists'" dark flat>
                <h6 class="fw-bold m-0">
                    <i class="fa-duotone fa-violin"></i>
                    <span class="p-1 d-none d-md-inline">
                        Violinists
                    </span>
                </h6>
            </vs-button>
            <vs-button style="max-width:fit-content" @click="$router.push({ query: { type: 'worship-leaders' } })"
                :active="$route.query.type === 'worship-leaders'" dark flat>
                <h6 class="fw-bold m-0">
                    <i class="fa-duotone fa-microphone-stand"></i>
                    <span class="p-1 d-none d-md-inline">
                        Worship Leaders
                    </span>
                </h6>
            </vs-button>
        </div>

        <!-- Search -->
        <div class="my-4">
            <search></search>
        </div>
        <div v-if="loading" class="d-flex flex-row justify-content-center align-items-center p-2 m-2">
            <div class="spinner-border spinner-border-sm" role="status" style="height: 30px; width: 30px;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <transition-group v-else tag="ul" name="list" class="match-cards list-unstyled">
            <li v-for="user in allUsers" :key="user.id">

                <vs-card>
                    <template #title>
                        <div class="d-flex flex-row align-items-center gap-1">
                            <span class="badge bg-secondary p-1" style="font-size:smaller">
                                <!-- {{ user.title }} -->
                                Pastor
                            </span>
                            <span> &bull; </span>
                            <i class="fa-duotone fa-microphone-stand h5 m-0"></i>
                            <span> &bull; </span>
                            <i class="fa-duotone fa-piano-keyboard h5 m-0"></i>
                            <span> &bull; </span>
                            <i class="fa-duotone fa-violin h5 m-0"></i>
                        </div>
                        <h3 class="mt-2">
                            {{ user.name }}
                        </h3>
                    </template>
                    <template #img>
                        <b-img src="../../../../storage/assets/woman-g5474d9095_1920.jpg" alt=""></b-img>
                    </template>
                    <template #text>
                        <p>
                            <span>{{ user.from }}</span>
                            <span> &bull;</span>
                            <span>{{ user.phone_number }}</span>
                            <span> &bull;</span>
                            <span>{{ allShifts['keyboardists'].find(shift => shift.id === user.shift_id).name }}</span>
                        </p>
                        <div class="mt-3"
                            v-if="ongoingShifts.keyboardists || ongoingShifts.worship_leaders || ongoingShifts.violinists">
                            <vs-button dark icon v-if="showAction(user, false)">
                                <h5 class="m-0 d-flex flex-row justify-content-center gap-2">
                                    <i class="fa-duotone fa-lightbulb-cfl text-warning fa-shake"></i>
                                    <span class="h6 m-0">
                                        Clock Out
                                    </span>
                                </h5>
                            </vs-button>
                            <vs-button dark icon v-if="showAction(user)">
                                <h5 class="m-0 d-flex flex-row justify-content-center gap-2">
                                    <i class="fa-duotone fa-lightbulb-cfl-on text-warning fa-fade"></i>
                                    <span class="h6 m-0">
                                        Clock In
                                    </span>
                                </h5>
                            </vs-button>
                        </div>
                    </template>
                    <template #interactions>
                        <vs-button danger icon @click="editDetails">
                            <i class='fa-duotone fa-pen h5 m-0'></i>
                        </vs-button>
                        <vs-button danger icon @click="editDetails">
                            <i class='fa-duotone fa-eye h5 m-0'></i>
                        </vs-button>
                    </template>
                </vs-card>
            </li>
        </transition-group>

        <!-- Update Details or create user modal -->
        <b-modal id="user-modal" size="lg" scrollable centered hide-footer hide-header content-class="template-modal"
            header-class="template-modal-header">
            <div class="d-flex flex-row justify-content-end" style="position: sticky; top: 0;z-index: 20;">
                <vs-button danger icon circle @click="$bvModal.hide('user-modal')">
                    <i class='fa-duotone fa-times-circle h5 m-0'></i>
                </vs-button>
            </div>
            <div class="mt-4">
                <h3 class="font-monospace">
                    Update Details
                </h3>

                <form action="" class="mt-4 d-flex flex-column gap-3">
                    <div>
                        <h5 class="fw-bold">
                            Profile Picture
                        </h5>
                        <div class="mt-2">
                            <b-avatar size="100" src="../../../../storage/assets/woman-g5474d9095_1920.jpg"
                                alt=""></b-avatar>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-row items-center gap-3">
                        <div class="flex-grow-1">
                            <h5 class="fw-bold d-flex flex-row align-items-center">
                                <i class="fa-duotone fa-user-group-crown"></i>
                                <span class="m-2">Title</span>
                            </h5>
                            <select name="title" id="title" class="form-control border-0" style="border-radius: 10px;">
                                <option value="0" selected>None</option>
                                <option value="1">Pastor</option>
                                <option value="2">Overseer</option>
                                <option value="3">Bishop</option>
                            </select>
                        </div>
                        <div class="flex-grow-1 ">
                            <h5 class="fw-bold d-flex flex-row align-items-center">
                                <i class="fa-duotone fa-phone"></i>
                                <span class="m-2">Type</span>
                            </h5>
                            <select name="type" id="type" class="form-control border-0" style="border-radius: 10px;">
                                <option
                                    v-for="(item, i) in ['Shift Leader / keyboardists', 'Data analyst', 'Keyboardist', 'Shift Leader / Worshippers', 'Worshipper', 'Violinist']"
                                    :key="i" :value="i">
                                    {{ item }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-row items-center gap-3">
                        <div class="flex-grow-1">
                            <h5 class="fw-bold d-flex flex-row align-items-center">
                                <i class="fa-duotone fa-signature"></i>
                                <span class="m-2">Name</span>
                            </h5>
                            <vs-input type="text" name="name"></vs-input>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold d-flex flex-row align-items-center">
                                <i class="fa-duotone fa-at "></i>
                                <span class="m-2">Email</span>
                            </h5>
                            <vs-input type="email" name="email"></vs-input>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-row items-center gap-3">
                        <div class="flex-grow-1">
                            <h5 class="fw-bold d-flex flex-row align-items-center">
                                <i class="fa-duotone fa-location-dot"></i>
                                <span class="m-2">From</span>
                            </h5>
                            <vs-input type="text" name="from"></vs-input>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold d-flex flex-row align-items-center">
                                <i class="fa-duotone fa-phone"></i>
                                <span class="m-2">Phone Number</span>
                            </h5>
                            <vs-input type="tel" name="phone_number"></vs-input>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-row items-center gap-3">
                        <div class="flex-grow-1" style="max-width: 50%;">
                            <h5 class="fw-bold d-flex flex-row align-items-center">
                                <i class="fa-duotone fa-timer"></i>
                                <span class="m-2">Shift</span>
                            </h5>
                            <select type="text" name="shift" class="form-control border-0" style="border-radius: 10px;">
                                <!-- <option v-for="(shift, index) in allShifts" :selected="index === 0" :key="index">
                                    {{ shift.name }}
                                </option> -->
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-row items-center gap-3 mt-5">
                        <vs-button dark block style="max-width: 50%;" class="mx-auto">
                            <h5 class="m-0 fw-bold">
                                <span>
                                    Create
                                </span>
                                <i class="fa-duotone fa-arrow-right"></i>
                            </h5>
                        </vs-button>
                    </div>
                </form>
            </div>
            <!-- <form @submit.stop.prevent id="createUserForm" method="post">
                     Token
                <input hidden name="_token" :value="csrfToken" />

                <div class="d-flex flex-column flex-md-row align-items-center justify-content-evenly">
                    <div>
                        <h6 class="fw-bold d-flex flex-row align-items-center">
                            <i class="fa-duotone fa-signature fa-2x"></i>
                            <span class="m-2">Name</span>
                        </h6>
                        <vs-input type="text" name="name" v-model="createForm.name"></vs-input>
                    </div>
                    <div>
                        <h6 class="fw-bold d-flex flex-row align-items-center">
                            <i class="fa-duotone fa-at fa-2x"></i>
                            <span class="m-2">Email</span>
                        </h6>
                        <vs-input type="email" name="email" v-model="createForm.email"></vs-input>
                    </div>
                </div>
                <div class="mb-3 container p-3">
                    <h6 class="fw-bold d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-duotone fa-user fa-2x"></i>
                        <span class="m-2">Profile</span>
                    </h6>
                    <input type="file" name="profile" ref="profile" class="form-control border-0"
                        style="border-radius: 10px;" />
                </div>
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-evenly">
                    <div>
                        <h6 class="fw-bold d-flex flex-row align-items-center">
                            <i class="fa-duotone fa-location-dot fa-2x"></i>
                            <span class="m-2">From</span>
                        </h6>
                        <vs-input type="text" name="from" v-model="createForm.from"></vs-input>
                    </div>
                    <div>
                        <h6 class="fw-bold d-flex flex-row align-items-center">
                            <i class="fa-duotone fa-phone fa-2x"></i>
                            <span class="m-2">Phone Number</span>
                        </h6>
                        <vs-input type="tel" name="phone_number" v-model="createForm.phone"></vs-input>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-evenly my-2 p-2">
                    <div class="flex-grow-1 m-2">
                        <h6 class="fw-bold d-flex flex-row align-items-center">
                            <i class="fa-duotone fa-user-group-crown fa-2x"></i>
                            <span class="m-2">Title</span>
                        </h6>
                        <select name="title" id="title" v-model="createForm.title" class="form-control border-0"
                            style="border-radius: 10px;">
                            <option value="0" selected>None</option>
                            <option value="1">Pastor</option>
                            <option value="2">Bishop</option>
                        </select>
                    </div>
                    <div class="flex-grow-1 m-2">
                        <h6 class="fw-bold d-flex flex-row align-items-center">
                            <i class="fa-duotone fa-phone fa-2x"></i>
                            <span class="m-2">Type</span>
                        </h6>
                        <select name="type" id="type" v-model="createForm.type" class="form-control border-0"
                            style="border-radius: 10px;">
                            <option
                                v-for="(item, i) in ['Shift Leader / keyboardists', 'Data analyst', 'Keyboardist', 'Shift Leader / Worshippers', 'Worshipper', 'Violinist']"
                                :key="i" :value="i">
                                {{ item }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 container p-4">
                    <h6 class="fw-bold d-flex flex-row align-items-center">
                        <i class="fa-duotone fa-timer fa-2x"></i>
                        <span class="m-2">Shift</span>
                    </h6>
                    <select type="text" name="shift" v-model="createForm.shift" class="form-control border-0"
                        style="border-radius: 10px;">
                        <option v-for="(shift, index) in allShifts" :selected="index === 0" :key="index">
                            {{ shift.name }}
                        </option>
                    </select>
                    <vs-input type="text" name="shift" v-model="createForm.shift" list="shift-list"></vs-input>
                    <datalist id="shift-list">
                        <option v-for="(shift, index) in allShifts" :selected="index === 0" :key="index">
                            {{ shift.name }}
                        </option>
                    </datalist>
                </div>
                <div v-if="errors">
                    <h6 class="m-0 text-danger fw-bold">
                        Please fill all fields
                    </h6>
                </div>
                <div class="container d-flex flex-row justify-content-between align-items-center">
                    <vs-button dark flat :loading="createForm.loading" @click="createUser()">
                        <h6 class="m-0 fw-bold">
                            Create
                        </h6>
                    </vs-button>
                    <vs-button class="my-3" danger flat @click="$bvModal.hide('add-user')">
                        <h6 class="m-0 fw-bold">
                            <i class="fa-solid fa-times"></i>
                            Close
                        </h6>
                    </vs-button>
                </div>
            </form> -->
        </b-modal>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Search from './Search.vue';
import gsap from 'gsap';
export default {
    components: { Search },
    data() {
        return {
            loading: true,
            search: '',
            data: []
        }
    },
    methods: {
        editDetails() {
            this.$bvModal.show('user-modal');
        },
        async testApi() {
            await axios.get('/api/v1/user/keyboardists').then(response => {
                console.log(response.data)
            }).catch(error => {
                console.log('error', error)
            });
        },

        showAction(user, clockIn = true) {

            if (!this.ongoingIndex.includes(user.type)) {
                return false;
            }
            if (this.ongoingShifts.keyboardists) {
                if (user.shift_id !== this.ongoingShifts.keyboardists.id) {
                    return false;
                }
            }

            if (this.ongoingShifts.violinists) {
                if (user.shift_id !== this.ongoingShifts.violinists.id) {
                    return false;
                }
            }

            if (this.ongoingShifts.worship_leaders) {
                if (user.shift_id !== this.ongoingShifts.worship_leaders.id) {
                    return false;
                }

            }

            if (clockIn) {
                switch (user.type) {
                    case 1:
                        return !this.tobeClockedOutKeyboardists.includes(user.id);
                    case 2:
                        return !this.tobeClockedOutWorshipLeaders.includes(user.id);
                    case 3:
                        return !this.tobeClockedOutViolinists.includes(user.id);
                    default:
                        break;
                }
            } else {
                switch (user.type) {
                    case 1:
                        return this.tobeClockedOutKeyboardists.includes(user.id);
                    case 2:
                        return this.tobeClockedOutWorshipLeaders.includes(user.id);
                    case 3:
                        return this.tobeClockedOutViolinists.includes(user.id);
                    default:
                        break;
                }
            }

        },
        clockInUser() {

        }
    },
    computed: {
        ...mapGetters(['allUsers', 'allShifts', 'userTypes', 'ongoingShifts']),

        ongoingIndex() {
            let index = [];

            if (this.ongoingShifts.keyboardists) {
                index.push(1);
            } else if (this.ongoingShifts.worship_leaders) {
                index.push(2);
            } else if (this.ongoingShifts.violinists) {
                index.push(3);
            }
            return index;
        },
        tobeClockedOutKeyboardists() {
            let clockedIn = [];
            this.allUsers.forEach(user => {
                if (this.ongoingShifts.keyboardists) {

                    if (user.type !== 1 || user.shift_id !== this.ongoingShifts.keyboardists.id) {
                        return;
                    }

                    let attendance = user.attendances.find(attendance => attendance.session_id === this.ongoingShifts.keyboardists.ongoing_session_keyboardists);


                    if (attendance !== undefined) {
                        if (attendance.start !== null && attendance.end == null) {
                            clockedIn.push(user.id);
                        }
                    }
                }
            });
            return clockedIn;
        },
        tobeClockedOutWorshipLeaders() {
            let clockedIn = [];
            this.allUsers.forEach(user => {
                if (this.ongoingShifts.worship_leaders) {
                    if (user.type !== 1 || user.shift_id !== this.ongoingShifts.worship_leaders.id) {
                        return;
                    }

                    let attendance = user.attendances.find(attendance => attendance.session_id === this.ongoingShifts.worship_leaders.ongoing_session_worship_leaders);


                    if (attendance !== undefined) {
                        if (attendance.start !== null && attendance.end == null) {
                            clockedIn.push(user.id);
                        }
                    }
                }
            });
            return clockedIn;
        },
        tobeClockedOutViolinists() {
            let clockedIn = [];
            this.allUsers.forEach(user => {
                if (this.ongoingShifts.violinists) {

                    if (user.type !== 1 || user.shift_id !== this.ongoingShifts.violinists.id) {
                        return;
                    }

                    let attendance = user.attendances.find(attendance => attendance.session_id === this.ongoingShifts.violinists.ongoing_session_violinists);


                    if (attendance !== undefined) {
                        if (attendance.start !== null && attendance.end == null) {
                            clockedIn.push(user.id);
                        }
                    }
                }
            });
            return clockedIn;
        }
    },
    async mounted() {
        await this.$store.dispatch('getShifts');

        let query = this.$route.query.type;

        if (query) {
            await this.$store.dispatch('getUsers', query);
        } else {
            await this.$store.dispatch('getUsers');
        }

        this.loading = false;
    },
    async beforeRouteUpdate(to, from, next) {
        this.loading = true;
        let query = to.query.type;

        if (query) {
            await this.$store.dispatch('getUsers', query);
        } else {
            await this.$store.dispatch('getUsers');
        }
        next();
        this.loading = false;
    }
}
</script>

<style>
.match-cards {
    display: grid;
    gap: 40px;
    grid-auto-flow: dense;
    grid-auto-rows: minmax(min-content, max-content);
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    line-break: strict;
    transition: all 0.5s;
    padding: 1rem;
}

.vs-card-content {
    width: fit-content !important;
    margin: 0 auto !important;
}

.vs-input {
    width: 100%;
}

.template-modal {
    border-radius: 15px;
}

.template-modal-header {
    border: none;
}

.list-move,
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}

.list-leave-active {
    position: absolute;
}
</style>
