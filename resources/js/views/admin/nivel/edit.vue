<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Editar nivel</h5>
            </div>
 
               <!--Var dumpt vue-->
               {{ nivel }} 

               <!--Enviar form a script-->
            <form @submit.prevent="guardarCambios">
                
                <div class="form-group mb-2">
                    <label>nombre</label><span class="text-danger"> *</span>
                    <textarea v-model="nivel.nombre" class="form-control" type="text" placeholder="nombre"></textarea>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>descripcion</label><span class="text-danger">*</span>
                    <input v-model="nivel.descripcion" class="form-control" type="text" name="descripción"/>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>user_id</label><span class="text-danger">*</span>
                    <input v-model="nivel.user_id" class="form-control" type="text" name="user_id"/>
                </div>
                
                <Dropdown v-model="nivel.user_id" :options="users.data" filter optionLabel="name" optionValue="id" placeholder="Selecciona Id usuario" class="w-full md:w-14rem">
                </Dropdown>
            
                <button type="submit" class="btn btn-primary mt-4 mb-4">Guardar</button>
 
 
            </form>
 
        </div>
    </div>
 </template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from 'vue-router';
import useUsers from "../../../composables/users"

const {users, getUsers} = useUsers()
const router = useRouter();
const route = useRoute(); // Usar useRoute() para acceder a los parámetros de la ruta
const id = route.params.id; // Obtener el ID de la ruta

const nivel = ref({});

onMounted(()=> {
    getUsers();
})

// Obtener datos de la asistencia para editar
onMounted(() => {
    axios.get(`/api/nivel/${id}`)
        .then(response => {
            nivel.value = response.data.data;
            
        })
        .catch(error => {
            console.error("Error al obtener los datos de niveles:", error);
        });
});

// Función para guardar cambios
const guardarCambios = () => {
    axios.put(`/api/nivel/${id}`, nivel.value)
        .then(response => {
            console.log("Nivel actualizado:", response.data);
            // Redireccionar a la vista de lista de niveles u otra vista
            router.push({ name: 'nivel.index' });
        })
        .catch(error => {
            console.error("Error al actualizar el nivel:", error);
        });
};
</script> 