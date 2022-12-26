<template>
    <div class="shadow-sm p-2 m-1 bg-white" style="border-radius: 15px">
        <h4>
            <i class="fa-duotone fa-elephant"></i>
            Sheems Users
        </h4>
        <!-- Nav -->
        <div class="d-flex flex-row gap-2 mt-5">
            <vs-button style="max-width:fit-content" dark flat :active="Object.keys($route.query).length === 0">
                <h6 class="fw-bold m-0">
                    <i class="fa-duotone fa-timer"></i>
                    <span class="p-1">
                        All
                    </span>
                </h6>
            </vs-button>
            <vs-button style="max-width:fit-content" dark flat>
                <h6 class="fw-bold m-0">
                    <i class="fa-duotone fa-piano-keyboard"></i>
                    <span class="p-1">
                        Keyboardists
                    </span>
                </h6>
            </vs-button>
            <vs-button style="max-width:fit-content" dark flat>
                <h6 class="fw-bold m-0">
                    <i class="fa-duotone fa-violin"></i>
                    <span class="p-1">
                        Violinists
                    </span>
                </h6>
            </vs-button>
            <vs-button style="max-width:fit-content" dark flat>
                <h6 class="fw-bold m-0">
                    <i class="fa-duotone fa-microphone-stand"></i>
                    <span class="p-1">
                        Keyboardists
                    </span>
                </h6>
            </vs-button>
        </div>

        <!-- Search -->
        <div class="d-flex flex-row justify-centent-center justify-content-md-end my-4">
            <vs-input class="d-none d-md-block" warn border placeholder="Search" type="search">
                <template #icon>
                    <i class="fa-duotone fa-magnifying-glass"></i>
                </template>
            </vs-input>
            <vs-input class="d-block d-md-none w-100" warn border placeholder="Search" type="search">
                <template #icon>
                    <i class="fa-duotone fa-magnifying-glass"></i>
                </template>
            </vs-input>
        </div>
        <transition-group tag="ul" class="match-cards">
            <li v-for="i in 50" :key="`${i}-vscards`">
                <vs-card>
                    <template #title>
                        <div>
                            <span class="badge bg-warning">
                                Pastor
                            </span>
                            <span> &bull; </span>
                            <span class="badge bg-secondary">
                                <i class="fa-duotone fa-piano-keyboard"></i>
                                Keyboardist
                            </span>
                            <h3 class="fw-bold mt-3">
                                Jane Doe
                            </h3>
                        </div>
                    </template>
                    <template #img>
                        <b-img src="../../../../storage/assets/woman-g5474d9095_1920.jpg" alt=""></b-img>
                    </template>
                    <template #text>
                        <p>
                            <span>Muranga</span>
                            <span> &bull;</span>
                            <span>0701234567</span>
                            <span> &bull;</span>
                            <span>Shift B</span>
                        </p>
                    </template>
                    <template #interactions>
                        <vs-button danger icon @click="editDetails">
                            <i class='fa-duotone fa-pen h5 m-0'></i>
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
export default {
    methods: {
        editDetails() {
            this.$bvModal.show('user-modal');
        }
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
</style>
