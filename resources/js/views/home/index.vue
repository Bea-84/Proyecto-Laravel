<template>
    <!--<div class="relative items-top justify-center min-h-screen bg-gray-900 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">-->
    <div class="items-top justify-center min-h-screen bg-gray-900 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <img src="images/portada_boxeo.webp" alt="background" class="background-image"/>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="justify-center pt-8 sm:text-gray-600 dark:text-gray-400 text-sm">
            </div>
        </div>
    </div>
    <AppFooter />
</template>

<script setup>
import AppFooter from '../../layouts/AppFooter.vue';
</script>

<style scoped>
body {
    font-family: 'Nunito', sans-serif;
}

.background-image{
    width: 100%;
    object-fit: contain;
}
</style>
