<script setup>
    import {defineAsyncComponent} from "vue";
    const backgroundImage = require('../../../../public/assets/watercolor-4116932.png');
    const logo = require('../../../../public/android-chrome-192x192.png')

    const Users = defineAsyncComponent(() => import('../users/Users'));
    const Navigation = defineAsyncComponent(() => import('../navigation/Index'))



    const lorem = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, voluptas?';
    console.log(process.env.MIX_APP_NAME);
</script>
<template>
    <div class="h-full w-full p-2 bg-gray-100">
        <div
            class="h-1/3 rounded-lg flex justify-center sm:justify-start"
            :style="`background: url(${backgroundImage.default}) no-repeat center; background-size: cover;`"
        >
            <div class="flex justify-center items-center md:ml-10">
                <div class="flex flex-row items-center justify-between">
                    <img
                        :src="logo.default"
                        class="rounded-full drop-shadow-2xl"
                        style="height: 100px"
                    />
                    <h5 class="text-5xl font-bold ml-2 font-sans">
                        Sheems
                    </h5>
                </div>
            </div>
        </div>
        <div class="h-2/3 p-2">
            <navigation/>
            <router-view></router-view>
        </div>
    </div>
</template>
