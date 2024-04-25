    <template>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between pb-2 mb-2">
                    <h5 class="card-title">Editar nivel</h5>
                </div>
    
                

                <!--Enviar form a script-->
                <form @submit.prevent="guardarCambios">
                    
                    <div class="form-group mb-2">
                        <label>Nombre:</label><span class="text-danger"> </span>
                        <textarea v-model="nivel.nombre" class="form-control" type="text" placeholder="nombre"></textarea>
                    </div>
    
    
                    <div class="form-gorup mb-2">
                        <label>Descripcion:</label><span class="text-danger"></span>
                        <input v-model="nivel.descripcion" class="form-control" type="text" name="descripción"/>
                    </div>
    
    
                
       
        <div class="card flex flex-wrap gap-2 justify-content-center">
            <Button @click="confirm1($event)" label="Guardar" outlined></Button>
            
        </div>

                    
    
    
                </form>
    
            </div>
        </div>
    </template>

    <script setup>
    import { ref, onMounted,inject } from "vue";
    import { useRouter, useRoute } from 'vue-router';

    const swal = inject('$swal')

    const router = useRouter();
    const route = useRoute(); // Usar useRoute() para acceder a los parámetros de la ruta
    const id = route.params.id; // Obtener el ID de la ruta

    const nivel = ref({});

    

    // Obtener datos del nivel para editar
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
                    guardarCambios(id,index)
                }else{
                    swal({
                                icon: 'error',
                                title: 'Error al intentar modificar el dato'
                            })
                }
            })

    };



</script> 