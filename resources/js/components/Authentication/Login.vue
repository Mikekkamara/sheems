<script setup>
    const lorem = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, voluptas?';
    console.log(process.env.MIX_APP_NAME);
</script>
<template>
    <div>
        <div class="border border-danger">
            {{ lorem }}
        </div>
    </div>
</template>
