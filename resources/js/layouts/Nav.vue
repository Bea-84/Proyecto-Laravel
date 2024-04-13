<template>
    <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm navbar-custom">
        <div class="container">
            <router-link to="/" class="navbar-brand"><img src="images/logo_redondo.png" alt="logo" class="rounded_logo"></router-link>
            <a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-dark"></span>
            </a>
            <!--<div class="collapse navbar-collapse " id="navbarSupportedContent"></div>-->
            <div style="background-color: black; z-index: 999;" class="collapse navbar-collapse " id="navbarSupportedContent"> <!--Añadido color negro de color de fondo del menú desplegable y z-index: 999 para que el desplegable esté siempre en primer plano-->
                <ul class="navbar-nav mt-2 mt-lg-0 me-auto mb-2 mb-lg-0">
                    <!--<LocaleSwitcher />-->  <!--Selector de idioma-->
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0 ms-auto">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link" aria-current="page">{{ $t('home') }}</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'public-posts.index'}" class="nav-link">Trayectoria J.M.Guerrero</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'tarifas'}" class="nav-link">Tarifas</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'horarios'}" class="nav-link">Horarios</router-link>
                        </li>
                    <template v-if="!user?.name">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/login"
                            >{{ $t('login') }}</router-link
                            >
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/register">{{ $t('register') }}</router-link>
                        </li>
                    </template>
                    <li v-if="user?.name" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ user.name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><router-link class="dropdown-item" to="/admin">Admin</router-link></li>
                            <li><router-link to="/admin/posts" class="dropdown-item">Post</router-link></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { useStore} from "vuex";
import useAuth from "@/composables/auth";
import {computed} from "vue";
import LocaleSwitcher from "../components/LocaleSwitcher.vue";

    const store = useStore();
    const user = computed(() => store.getters["auth/user"])
    const { processing, logout } = useAuth();
</script>

<link rel="stylesheet" src="/resources/css/main_page_nav_menu.css" type="text/css">