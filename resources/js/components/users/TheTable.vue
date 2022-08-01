<template>
    <div>
        <div class="d-flex flex-row align-items-center justify-content-center p-4" v-if="loading">
            <div class="spinner-border spinner-border-sm" role="status" style="height: 100px; width: 100px;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div v-else>
            <div class="my-3 d-flex flex-row justify-content-end">
                <vs-button danger flat v-b-modal.add-user>
                    <h6 class="m-0 fw-bold">
                        <i class="fa-duotone fa-plus"></i>
                        Add a User
                    </h6>
                </vs-button>
            </div>
            <div v-if="allUsers.length === 0" class="p-3 m-2">
                No users yet
            </div>
            <div v-else>
                <h6>
                    Click on a user to view attendance history
                </h6>
                <vs-table>
                    <template #header>
                        <vs-input block v-model="search" border danger placeholder="Search" />
                    </template>
                    <template #thead>
                        <vs-tr class="text-capitalize">
                            <vs-th>
                                <h6 class="m-0 mx-auto fw-bold">Avatar</h6>
                            </vs-th>
                            <vs-th>
                                <h6 class="m-0 mx-auto fw-bold">Name</h6>
                            </vs-th>
                            <vs-th>
                                <h6 class="m-0 mx-auto fw-bold">From</h6>
                            </vs-th>
                            <vs-th>
                                <h6 class="m-0 mx-auto fw-bold">Phone Number</h6>
                            </vs-th>
                            <vs-th sort @click="users = $vs.sortData($event ,users, 'shift_id')">
                                <h6 class="m-0 mx-auto fw-bold">Shift</h6>
                            </vs-th>
                        </vs-tr>
                    </template>
                    <template #tbody>
                        <vs-tr
                            v-for="(user, index) in $vs.getPage($vs.getSearch(users, search), pagination.page, pagination.max)"
                            :key="index"
                        >
                            <vs-td>
                                <b-avatar :src="`../../../../storage/profile/${user.profile}`"></b-avatar>
                            </vs-td>
                            <vs-td>
                                <h6 class="m-0 text-center mx-auto" style="width: 150px;overflow: hidden;white-space:nowrap; text-overflow: ellipsis;">
                                    {{ user.name }}
                                </h6>
                            </vs-td>
                            <vs-td>
                                <h6 class="m-0 text-center mx-auto" style="width: 200px;overflow: hidden;white-space:nowrap; text-overflow: ellipsis;">
                                    {{ user.from }}
                                </h6>
                            </vs-td>
                            <vs-td>
                                <h6 class="m-0 p-1 text-center mx-auto" style="width: 250px;overflow: hidden;white-space:nowrap; text-overflow: ellipsis;">
                                    {{ user.phone_number }}
                                </h6>
                            </vs-td>
                            <vs-td>
                                <h6 class="m-0 text-center mx-auto">
                                    {{ allShifts.find(shift => shift.id === user.shift_id).name }}
                                </h6>
                            </vs-td>
                            <template #expand>
                                <div class="container py-3 bg-light shadow border rounded-3">
                                    <h6 class="fw-bold">
                                        <i class="fa-duotone fa-clock-rotate-left"></i>
                                        Attendance History
                                    </h6>
                                    <vs-table>
                                        <template #thead>
                                            <vs-th>
                                                <h6 class="m-0 mx-auto fw-bold">#</h6>
                                            </vs-th>
                                            <vs-th>
                                                <h6 class="m-0 mx-auto fw-bold">Shift</h6>
                                            </vs-th>
                                            <vs-th>
                                                <h6 class="m-0 mx-auto fw-bold">Clocked In</h6>
                                            </vs-th>
                                            <vs-th>
                                                <h6 class="m-0 mx-auto fw-bold">Clocked Out</h6>
                                            </vs-th>
                                        </template>
                                        <template #tbody>
                                            <vs-tr
                                                v-for="(attendance, index) in user.attendances"
                                                :key="index"
                                            >
                                                <vs-td>
                                                    <h6 class="m-0 text-center">
                                                        {{ index + 1 }}
                                                    </h6>
                                                </vs-td>
                                                <vs-td>
                                                    <h6 class="m-0 text-center">
                                                        {{ attendance.shift }}
                                                    </h6>
                                                </vs-td>
                                                <vs-td>
                                                    <h6 class="m-0 text-center">
                                                        {{ attendance.start }}
                                                    </h6>
                                                </vs-td>
                                                <vs-td>
                                                    <h6 class="m-0 text-center">
                                                        {{ attendance.end }}
                                                    </h6>
                                                </vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </div>
                            </template>
                        </vs-tr>
                    </template>
                    <template #footer>
                        <vs-pagination color="dark" v-model="pagination.page" :length="$vs.getLength(users, pagination.max)" />
                    </template>
                </vs-table>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    data(){
        return{
            pagination:{
                page: 1,
                max: 15
            },
            search: '',
            users: [],
            loading: true
        }
    },
    computed:{
        ...mapGetters(['allUsers', 'allShifts'])
    },
    mounted() {
        this.users = this.allUsers;
        setTimeout(() => {
            this.loading = false
        }, 2000);
    }
}
</script>
