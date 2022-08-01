<template>
    <div>
        <div class="d-flex flex-row align-items-center justify-content-center p-4" v-if="loading">
            <div class="spinner-border spinner-border-sm" role="status" style="height: 100px; width: 100px;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-center p-4" v-else-if="error">
            <h6 class="m-0 fw-bold">
                Something went wrong
            </h6>
        </div>
        <div
            class="d-flex flex-column align-items-center"
            v-else
        >
            <b-avatar
                size="15rem"
                :src="`../../../../storage/profile/${user.profile}`"
            ></b-avatar>
            <small class="mt-2">
                {{ allShifts.find(shift => shift.id === user.shift_id).name }}
            </small>
            <hr class="w-50 mx-auto">
            <h1>
                {{ user.name }}
            </h1>
            <h6>
                {{ user.from }} &#8226; {{ user.phone_number}}
            </h6>
            <div class="container d-flex flex-row align-items-center justify-content-between">
                <vs-button success flat>
                    <h6 class="m-0 fw-bold d-flex flex-row align-items-center">
                        <i class="fa-duotone fa-timer fa-2x"></i>
                        <span class="m-2">
                            Clock In
                        </span>
                    </h6>
                </vs-button>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from "vuex";

export default {
    props:{
        slug:{
            type: Object,
            required: true
        }
    },
    data(){
        return{
            loading: true,
            error: false,
            user:{}
        }
    },
    computed:{
        ...mapGetters(['allUsers', 'allShifts'])
    },
    async mounted() {
        try {
            this.user = await this.allUsers.find(item => item.id === this.slug);
            this.loading = false;
        }
        catch(error){
            this.error = true;
        }
    }
}
</script>
