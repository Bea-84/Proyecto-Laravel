<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Editar horario</h5>
            </div>
            
               

               <!--Enviar form a script-->
            <form @submit.prevent="guardar">
               
                

                <div>Día:</div>
                <div class="card flex justify-content-center">
                    <div class="flex flex-column gap-3">
                        <div
                            v-for="dia in dias"
                            :key=dia.id
                            class="flex align-items-center"
                        >
                            <RadioButton
                                v-model=horario.dia
                                :value=dia.id
                                @input="change($event.target.value)"
                                name="diaSemana"
                            />
                            <label :for=dia.id class="ml-2">{{ dia.diaSemana }}</label>
                        </div>
                    </div>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>Hora inicio:</label><span class="text-danger"></span>
                    <input v-model="horario.hora_inicio" class="form-control" type="time" name="Hora inicio"/>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>Hora fin:</label><span class="text-danger"></span>
                    <input v-model="horario.hora_fin" class="form-control" type="time" name="Hora fin"/>
                </div>
                
                
            

<div class="card flex flex-wrap gap-2 justify-content-center">
    <Button @click="confirm1($event)" label="Guardar" outlined></Button>
    
</div>
 
 
            </form>
 
        </div>
    </div>
 </template>

<script setup>
import { ref, onMounted ,inject} from "vue";
import { useRoute, useRouter } from "vue-router";
const swal = inject('$swal')



const router = useRouter();
const route = useRoute(); // Usar useRoute() para acceder a los parámetros de la ruta
const id = route.params.id; // Obtener el ID de la ruta
const horario = ref ({});
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

// Obtener datos de los horarios para editar
onMounted(()=>{

axios.get('/api/horario/'+id)
    .then(response =>{
        console.log('response');
    console.log(response);
    horario.value = response.data.data;
    })

})

// Función para guardar cambios
const guardar = () => {
    axios.put(`/api/horario/${id}`, horario.value)
        .then(response => {
            console.log("Horario actualizado:", response.data);
            // Redireccionar 
            router.push({ name: 'horario.index' });
        })
        .catch(error => {
            console.error("Error al actualizar el horario:", error);
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