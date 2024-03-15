<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade nuevo dato de asistencia</h5>
            </div>
               

               <!--Enviar form a script-->
            <form @submit.prevent="addasistencia">
               
 
 
                <div class="form-group mb-2">
                    <label>Asistencia</label><span class="text-danger"> *</span>
                    <textarea v-model="asistencia.asistencia" class="form-control" type="text" placeholder="resultado OK/NG"></textarea>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>Fecha</label><span class="text-danger">*</span>
                    <input v-model="asistencia.fecha" class="form-control" type="datetime-local" name="fecha"/>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>User_id</label><span class="text-danger">*</span>
                    <input v-model="asistencia.user_id" class="form-control" type="text" name="user_id"/>
                </div>
                
                <Dropdown v-model="asistencia.user_id" :options="users.data" filter optionLabel="name" optionValue="id" placeholder="Selecciona Id usuario" class="w-full md:w-14rem">
                </Dropdown>
            
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Asistencia</button>
 
 
            </form>
 
        </div>
    </div>
 </template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from 'vue-router'
import useUsers from "../../../composables/users"


const {users, getUsers} = useUsers()
const router = useRouter()
const asistencia=ref({});

function addasistencia(){
   axios.post('/api/asistencia',asistencia.value)
        .then(response =>{
            console.log(response);
            router.push({ name: 'asistencia.index' })
        })
        .catch(error=>{
            console.log(error);
        }) 
}

onMounted(()=> {
    getUsers();
})



</script>