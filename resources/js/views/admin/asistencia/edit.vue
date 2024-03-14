<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Editar nuevo dato de asistencia</h5>
            </div>
 
 
           
               <!--Var dumpt vue-->
               {{ asistencia }} 

               <!--Enviar form a script-->
            <form @submit.prevent="guardarCambios">
               
 
 
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
            
                <button type="submit" class="btn btn-primary mt-4 mb-4">Guardar</button>
 
 
            </form>
 
        </div>
    </div>
 </template>

<script setup>
import { ref, onMounted } from "vue";


const id = $route.params.id
const asistencia = ref({});

// Obtener datos de la asistencia para editar
onMounted(() => {
    axios.get(`/api/asistencia/${id}`)
        .then(response => {
            asistencia.value = response.data;
        })
        .catch(error => {
            console.error("Error al obtener los datos de la asistencia:", error);
        });
});

// Función para guardar cambios
const guardarCambios = () => {
    axios.put(`/api/asistencia/${id}`, asistencia.value)
        .then(response => {
            console.log("Asistencia actualizada:", response.data);
            // Redireccionar a la vista de lista de asistencias u otra vista
        })
        .catch(error => {
            console.error("Error al actualizar la asistencia:", error);
        });
};
</script>

  

 
 
 