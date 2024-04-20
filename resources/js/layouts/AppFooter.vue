<script setup>
import { useLayout } from '../composables/layout';
import { computed } from 'vue';

const { layoutConfig } = useLayout();

const logoUrl = computed(() => {
    return `layout/images/${layoutConfig.darkTheme.value ? 'logo-white' : 'logo-dark'}.svg`;
});
</script>

<template>
    <div class="layout-footer">
        <ul>
            <li>
                <router-link :to="{ name : 'avisolegal'}" class="nav-link">Aviso legal</router-link>
            </li>
            <li>
                <router-link :to="{ name : 'cookies'}" class="nav-link">Política de cookies</router-link>
            </li>
            <li>
                <router-link :to="{ name : 'contacto'}" class="nav-link">Contacto</router-link>
            </li>
        </ul>
    </div>
</template>
<style lang="scss" scoped>
    .layout-footer {
        background-color: black;
    }
</style>
