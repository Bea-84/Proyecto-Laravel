<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Editar dato de asistencia</h5>
            </div>

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
            
                <Toast />

<ConfirmPopup> </ConfirmPopup>
<div class="card flex flex-wrap gap-2 justify-content-center">
    <Button @click="confirm1($event)" label="Guardar" outlined></Button>
    
</div>
 
 
            </form>
 
        </div>
    </div>
 </template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from 'vue-router';
import useUsers from "../../../composables/users"

import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";

const confirm = useConfirm();
const toast = useToast();

const {users, getUsers} = useUsers()
const router = useRouter();
const route = useRoute(); // Usar useRoute() para acceder a los parámetros de la ruta
const id = route.params.id; // Obtener el ID de la ruta

const asistencia = ref({});

onMounted(()=> {
    getUsers();
})

// Obtener datos de la asistencia para editar
onMounted(() => {
    axios.get(`/api/asistencia/${id}`)
        .then(response => {
            asistencia.value = response.data.data;
            
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
            router.push({ name: 'asistencia.index' });
        })
        .catch(error => {
            console.error("Error al actualizar la asistencia:", error);
        });
};


//Función para popup
const confirm1 = (event) => {
    console.log(event);

    confirm.require({
        target: event.currentTarget,
        message: 'Estas seguro que deseas modificar este dato?',
        icon: 'pi pi-exclamation-triangle',
        rejectClass: 'p-button-secondary p-button-outlined p-button-sm',
        acceptClass: 'p-button-sm',
        rejectLabel: 'No',
        acceptLabel: 'Si',
        accept: () => {
            toast.add({ severity: 'info', summary: 'Confirmado', detail: 'Dato modificado', life: 3000 });
            guardarCambios()
        },
        reject: () => {

           
            toast.add({ severity: 'error', summary: 'Cancelado', detail: 'Cambios no guardados', life: 3000 });
        }
    });
};
</script>

  

 
 
 