<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añadir actividad</h5>
            </div>


            <!--Enviar form a script-->
            <form @submit.prevent="GuardarActividad">

                <div class="form-group mb-2">
                    <label>Nombre:</label><span class="text-danger"> </span>
                    <input v-model="actividad.nombre" class="form-control" type="text" name="nombre" />
                </div>


                <div class="form-gorup mb-2">
                    <label>Descripcion:</label><span class="text-danger"></span>
                    <textarea v-model="actividad.descripcion" class="form-control" type="text" placeholder="descripcion"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Actividad</button>
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
const actividad = ref ({});
const dias = ref([ ]);



onMounted(()=>{

axios.get('/api/actividad/'+id)
    .then(response =>{
        console.log('response');
        console.log(response);
        actividad.value = response.data.data;
    })

})

// Función para guardar cambios
const GuardarActividad = () => {
    axios.put(`/api/actividad/${id}`, actividad.value)
        .then(response => {
            console.log("Actividad actualizado:", response.data);
            // Redireccionar 
            router.push({ name: 'actividad.index' });
        })
        .catch(error => {
            console.error("Error al actualizar el actividad:", error);
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