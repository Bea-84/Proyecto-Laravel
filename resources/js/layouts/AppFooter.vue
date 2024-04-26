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
        <div class="imagen">
            <img src="/images/logo_redondo.png" alt="logo" class="img-fluid"/>
        </div>
        <div class="lista">
        <h5 class="titulo">Enlaces destacados</h5>
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
    </div>
</template>
<style lang="scss" scoped>
   
    .titulo {
        color: white;
    }
     
</style>
