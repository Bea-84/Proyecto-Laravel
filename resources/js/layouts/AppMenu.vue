
<template>
    
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<script setup>
import { ref } from 'vue';
import AppMenuItem from './AppMenuItem.vue';
import {useAbility} from '@casl/vue'
const {can} = useAbility();

const vela = "pepe";


const model = ref([
    {
        label: 'Home',
        items: [{ label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/admin', permision: 'all'}]
    },
    {
        label: 'Usuarios',
        items: [
            { label: 'Users', icon: 'pi pi-fw pi-id-card', to: '/admin/users', permision: 'user-list' },
            { label: 'Roles', icon: 'pi pi-fw pi-check-square', to: '/admin/roles', permision:'role-list' },
            { label: 'Permisos', icon: 'pi pi-fw pi-bookmark', to: '/admin/permissions', permision:'permission-list' }
        ]
    },
    {
        label: 'Niveles',
        items: [
            {label:'Niveles',icon:' pi pi-fw pi-book',to:'/admin/nivel',permision:'all'}
        ]
    },
    {
        label: 'Inscripciones',
        items: [
            {label:'Inscripciones',icon:'pi pi-fw pi-pencil',to:'/admin/inscripcion',permision:'all'}
        ]
    },
    {
        label: 'Horario',
        items: [
            {label:'Horario',icon:'pi pi-fw pi-calendar',to:'/admin/horario',permision:'all'}
        ]
    },
    {
        label: 'Productos',
        items: [
            {label:'Productos',icon:'pi pi-fw pi-wallet',to:'/admin/productos',permision:'all'}
        ]
    }
   
    
]);
</script>


<style lang="scss" scoped></style>
