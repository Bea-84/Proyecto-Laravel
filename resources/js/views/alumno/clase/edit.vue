<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title text-uppercase"><strong>Modifica clase</strong></h5>
            </div>
            
               

               <!--Enviar form a script-->
            <form @submit.prevent="guardar">
               
                
                <div class="border border-black p-3">
                <div class="text-black"><strong>Modifica Día:</strong> </div>
                <div class="card flex justify-content-center">
                    <div class="flex flex-column gap-3">
                        <div
                            v-for="dia in dias"
                            :key=dia.id
                            class="flex align-items-center"
                        >
                            <RadioButton
                                v-model=clase.dia
                                :value=dia.id
                                @input="change($event.target.value)"
                                name="diaSemana"
                            />
                            <label :for=dia.id class="ml-2">{{ dia.diaSemana }}</label>
                        </div>
                    </div>
                </div>
                </div>
                <br>
 
                <div class="border border-black p-3">
                <div class="form-gorup mb-2">
                    <label class="text-black"><strong>Modifica clase:</strong></label>
                    <input v-model="clase.hora" class="form-control" type="text" name="Hora"/>
                </div>
                </div>
                <br>

                
                <div class="border border-black p-3">
                <div class="form-gorup mb-2">
                    <label class="text-black"><strong>Id alumno:</strong></label>
                    <input v-model="clase.user_id" class="form-control" type="text" name="user_id"/>
                </div>
                
                <Dropdown v-model="clase.user_id" :options="users.data" filter optionLabel="name" optionValue="id" placeholder="Selecciona Id usuario" class="w-full md:w-14rem">
                </Dropdown>
                </div>
            

<div class="card flex flex-wrap gap-2 justify-content-center">
    <Button @click="confirm1($event)" label="Guardar" outlined class="btn btn-dark"></Button>
    
</div>
 
 
            </form>
 
        </div>
    </div>
 </template>

<script setup>
import { ref, onMounted,inject } from "vue";
import { useRoute, useRouter } from "vue-router";
import useUsers from "../../../composables/users"

const swal = inject('$swal')



const {users, getUsers} = useUsers()
const router = useRouter();
const route = useRoute(); // Usar useRoute() para acceder a los parámetros de la ruta
const id = route.params.id; // Obtener el ID de la ruta
const clase = ref ({});


const dias = ref([ ]);

//Obtener dator tabla día semana
onMounted(()=> {
        
        // Obtener los días de la API 
        axios.get('/api/dia')
           .then(response => {
               console.log(response);
               dias.value = response.data; 
           })
           .catch(error => {
               console.error('Error al obtener datos:', error);
           });
                 
   })

 


onMounted(()=> {
        getUsers();
    })
    

// Obtener datos de la clase para editar
onMounted(() => {
    axios.get(`/api/clase/${id}`)
        .then(response => {
            clase.value = response.data.data;
        })
        .catch(error => {
            console.error("Error al obtener clase:", error);
        });
});

// Función para guardar cambios
const guardar = () => {
    axios.put(`/api/clase/${id}`, clase.value)
        .then(response => {
            console.log("Clase actualizada:", response.data);
            // Redireccionar a la vista de lista de clase u otra vista
            router.push({ name: 'clase.index' });
        })
        .catch(error => {
            console.error("Error al actualizar la clase:", error);
        });
};


  //Función para mensaje confirmación
  const confirm1 = (event,id,index) => {
        console.log(event);
        swal({
            title: 'Estás seguro??',
            text: 'No podrás revertir esta acción!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            confirmButtonColor: '#ef4444',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true
        })
            .then(result => {
                if (result.isConfirmed) {
                    swal({
                                icon: 'success',
                                title: 'Dato modificado'
                            })
                    guardar(id,index)
                }else{
                    swal({
                                icon: 'error',
                                title: 'Error al intentar modificar el dato'
                            })
                }
            })

    };
</script>
