<template>
    <div class="d-flex flex-row align-items-center justify-content-evenly" v-if="isLoggedIn">
        <router-link :to="{ name: 'home' }" class="text-decoration-none" v-if="userType === 1">
            <vs-button danger transparent :active="$route.path.includes('home')">
                <h6 class="m-0 fw-bold">
                    <i class="fa-duotone fa-users"></i>
                    Writers
                </h6>
            </vs-button>
        </router-link>
        <router-link :to="{ name: 'home' }" class="text-decoration-none" v-else>
            <vs-button danger transparent :active="$route.path.includes('home')">
                <h6 class="m-0 fw-bold">
                    <i class="fa-duotone fa-home"></i>
                    Home
                </h6>
            </vs-button>
        </router-link>
<!--        <router-link :to="{ name: 'tutorials' }" class="text-decoration-none">
            <vs-button danger transparent :active="$route.path.includes('tutorials')">
                <h6 class="m-0 fw-bold">
                    <i class="fa-duotone fa-timer"></i>
                    Shifts
                </h6>
            </vs-button>
        </router-link>-->
        <router-link :to="{ name: 'jobDetails', params: { slug: 'pending'} }" class="text-decoration-none">
            <vs-button danger transparent :active="$route.path.includes('jobs')">
                <h6 class="m-0 fw-bold">
                    <i class="fa-duotone fa-chart-network"></i>
                    Reports
                </h6>
            </vs-button>
        </router-link>

        <form ref="logout-form" action="/logout" method="POST" class="d-none">
            <input type="text" name="_token" :value="csrfToken" hidden>
        </form>
        <vs-button flat dark :active="true" @click="$refs['logout-form'].submit()">
            <h6 class="m-0 fw-bold">
                Sign Out
            </h6>
        </vs-button>
    </div>

<!--    <div class="d-flex flex-row align-items-center" v-else>
        <vs-button danger flat href="/organization/services" :active="$route.path.includes('services')">
            <h6 class="m-0 fw-bold">
                <i class="fa-thin fa-list-check"></i>
                Our Services
            </h6>
        </vs-button>
        <vs-button danger flat href="/organization/about-us" :active="$route.path.includes('about')">
            <h6 class="m-0 fw-bold">
                <i class="fa-duotone fa-circle-info"></i>
                About Us
            </h6>
        </vs-button>
        <vs-button danger flat href="/organization/FAQ" :active="$route.path.includes('FAQ')">
            <h6 class="m-0 fw-bold">
                <i class="fa-duotone fa-comment-question"></i>
                FAQS
            </h6>
        </vs-button>

        <vs-button flat href="/register" danger class="d-none d-md-block">
            <h5 class="m-0 fw-bold">
                Become a writer today
            </h5>
        </vs-button>
    </div>-->
</template>

<script>
import {mapGetters} from "vuex";
export default {
    computed:{
        ...mapGetters(['userType']),
        csrfToken(){
            return window.Laravel.csrfToken;
        },
        isLoggedIn(){
            let status = window.Laravel.status;

            if(status === 0){
                return false;
            }else{
                return true;
            }
        }
    }
}
</script>

<style>

</style>
