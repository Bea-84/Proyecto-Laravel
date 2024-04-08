<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Editar inscripcion</h5>
            </div>
            
               

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

                <div class="form-gorup mb-2">
                    <label>nivel_user</label><span class="text-danger">*</span>
                    <input v-model="inscripcion.nivel_user" class="form-control" type="text" name="id"/>
                </div>

                <Dropdown v-model="inscripcion.nivel_user" :options="nivel" filter optionLabel="nombre" optionValue="id" placeholder="Select a Id" class="w-full md:w-14rem">
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
import { useRoute, useRouter } from "vue-router";
import useUsers from "../../../composables/users"

import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";

const confirm = useConfirm();
const toast = useToast();
const nivel=ref()


const {users, getUsers} = useUsers()
const router = useRouter();
const route = useRoute(); // Usar useRoute() para acceder a los parámetros de la ruta
const id = route.params.id; // Obtener el ID de la ruta
const inscripcion = ref ({});

onMounted(()=> {
        getUsers();

        axios.get('/api/nivel')
        .then(response =>{
            console.log(response);
            nivel.value = response.data;
        });
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
            console.log("Inscripcion actualizada:", response.data);
            // Redireccionar a la vista de lista de inscripcion u otra vista
            router.push({ name: 'inscripcion.index' });
        })
        .catch(error => {
            console.error("Error al actualizar la inscripcion:", error);
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
            guardar()
        },
        reject: () => {

           
            toast.add({ severity: 'error', summary: 'Cancelado', detail: 'Cambios no guardados', life: 3000 });
        }
    });
};
</script>
