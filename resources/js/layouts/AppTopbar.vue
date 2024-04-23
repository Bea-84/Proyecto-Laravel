<template>
    <div class="layout-topbar">
        <router-link to="/login" class="layout-topbar-logo"  >
            <img src="images/logo_redondo.png" alt="logo" />
            <span></span>
        </router-link>

        <button class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle()">
            <i class="pi pi-bars"></i>
        </button>

        <button class="p-link layout-topbar-menu-button layout-topbar-button" @click="onTopBarMenuButton()">
            <i class="pi pi-ellipsis-v"></i>
        </button>

        <div class="layout-topbar-menu" :class="topbarMenuClasses">

            <button class="p-link layout-topbar-button layout-topbar-button-c nav-item dropdown " role="button"
                data-bs-toggle="dropdown">
                <i class="pi pi-user"></i>
                <span class="nav-link dropdown-toggle ms-3 me-2" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Hola, {{ user.name }}
                </span>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useLayout } from '../composables/layout';
import { useStore } from 'vuex';
import useAuth from "@/composables/auth";

const { onMenuToggle } = useLayout();
const store = useStore();
const user = computed(() => store.state.auth.user)
const { processing, logout } = useAuth();


const topbarMenuActive = ref(false);

const onTopBarMenuButton = () => {
    topbarMenuActive.value = !topbarMenuActive.value;
};

const topbarMenuClasses = computed(() => {
    return {
        'layout-topbar-menu-mobile-active': topbarMenuActive.value
    };
});


</script>

<style lang="scss" scoped>
.layout-topbar-button-c,
.layout-topbar-button-c:hover {
    width: auto;
    background-color: rgb(255, 255, 255, 0);
    border: 0;
    border-radius: 0%;
    padding: 1em;
}
.layout-topbar-logo {
    width: 200px;
    height: auto;
}
</style>
