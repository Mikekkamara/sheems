<script setup>


</script>

<template>
    <div class="py-2">
        <router-link
            to="/home"
            active-class="text-indigo-500"
            class="bg-indigo-100 p-1 m-2 text-lg font-sans font-bold rounded-xl hover:bg-indigo-200 ease-in-out duration-700 ring-4 ring-indigo-100"
        >
            <i class="fa-solid fa-users"></i>
            Users
        </router-link>
        <router-link
            to="/shifts"
            active-class="text-indigo-500"
            class="bg-indigo-100 p-1 m-2 text-lg font-sans font-bold rounded-xl hover:bg-indigo-300 ease-in-out duration-700 ring-4 ring-indigo-100"
        >
            <i class="fa-duotone fa-timer"></i>
            Shifts
        </router-link>
        <router-link
            to="/reports"
            active-class="text-indigo-500"
            class="bg-indigo-100 p-1 m-2 text-lg font-sans font-bold rounded-xl hover:bg-indigo-300 ease-in-out duration-700 ring-4 ring-indigo-100"
        >
            <i class="fa-duotone fa-chart-pie"></i>
            Reports
        </router-link>
    </div>
</template>
