<template>
    <div class="d-flex flex-row align-items-center justify-content-evenly" v-if="isLoggedIn">
        <router-link :to="{ name: 'home' }" class="text-decoration-none">
            <vs-button danger transparent :active="$route.path.includes('home')">
                <h6 class="m-0 fw-bold">
                    <i class="fa-duotone fa-home"></i>
                    <span class="d-none d-sm-inline">
                        Home
                    </span>
                </h6>
            </vs-button>
        </router-link>
        <router-link :to="{ name: 'users' }" class="text-decoration-none">
            <vs-button danger transparent :active="$route.path.includes('users')">
                <h6 class="m-0 fw-bold">
                    <i class="fa-duotone fa-users"></i>
                    <span class="d-none d-sm-inline">
                        Users
                    </span>
                </h6>
            </vs-button>
        </router-link>
        <router-link :to="{ name: 'reports' }" class="text-decoration-none">
            <vs-button danger transparent :active="$route.path.includes('reports')">
                <h6 class="m-0 fw-bold">
                    <i class="fa-duotone fa-chart-network"></i>
                    <span class="d-none d-sm-inline">
                        Reports
                    </span>
                </h6>
            </vs-button>
        </router-link>

        <form ref="logout-form" action="/logout" method="POST" class="d-none">
            <input type="text" name="_token" :value="csrfToken" hidden>
        </form>
        <vs-button flat dark :active="true" @click="$refs['logout-form'].submit()">
            <h6 class="m-0 fw-bold">
                <i class="fa-duotone fa-sign-out"></i>
                <span class="d-none d-sm-inline">
                    Sign Out
                </span>
            </h6>
        </vs-button>
    </div>
</template>

<script>
export default {
    computed: {
        csrfToken() {
            return window.Laravel.csrfToken;
        },
        isLoggedIn() {
            let status = window.Laravel.status;

            if (status === 0) {
                return false;
            } else {
                return true;
            }
        }
    }
}
</script>

<style>

</style>
