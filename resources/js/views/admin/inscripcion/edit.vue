<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Editar inscripcion</h5>
            </div>
            
               <!--Var dumpt vue-->
               {{ inscripcion }} 

               <!--Enviar form a script-->
            <form @submit.prevent="guardar">
               
                <div class="form-group mb-2">
                    <label>Fecha</label><span class="text-danger"> *</span>
                    <input v-model="inscripcion.fecha" class="form-control" type="text" placeholder="Fecha"/>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>Forma de pago</label><span class="text-danger">*</span>
                    <textarea v-model="inscripcion.forma_de_pago" class="form-control" type="text" name="forma_de_pago"></textarea>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>User_id</label><span class="text-danger">*</span>
                    <input v-model="inscripcion.user_id" class="form-control" type="text" name="user_id"/>
                </div>
                
                <Dropdown v-model="inscripcion.user_id" :options="users.data" filter optionLabel="name" optionValue="id" placeholder="Selecciona Id usuario" class="w-full md:w-14rem">
                </Dropdown>
            
                <button type="submit" class="btn btn-primary mt-4 mb-4">Guardar inscripción</button>
 
 
            </form>
 
        </div>
    </div>
 </template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import useUsers from "../../../composables/users"


const {users, getUsers} = useUsers()
const router = useRouter();
const route = useRoute(); // Usar useRoute() para acceder a los parámetros de la ruta
const id = route.params.id; // Obtener el ID de la ruta
const inscripcion = ref ({});

onMounted(()=> {
        getUsers();
    })
    

// Obtener datos de la asistencia para editar
onMounted(() => {
    axios.get(`/api/inscripcion/${id}`)
        .then(response => {
            inscripcion.value = response.data.data;
        })
        .catch(error => {
            console.error("Error al obtener inscripción:", error);
        });
});

// Función para guardar cambios
const guardar = () => {
    axios.put(`/api/inscripcion/${id}`, inscripcion.value)
        .then(response => {
            console.log("inscripción actualizada:", response.data);
            // Redireccionar a la vista de lista de inscripción u otra vista
            router.push({ name: 'inscripcion.index' })
        })
        .catch(error => {
            console.error("Error al actualizar la inscripción:", error);
        });
};
</script>
