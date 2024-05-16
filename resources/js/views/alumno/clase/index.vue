
<template>
    <div class="grid" >
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   <div class="d-flex justify-content-between pb-2 mb-2">
                       <h5 class="card-title">Mis clases</h5>
                       <div>
                        
                        <router-link :to="{name: 'clase.create'}" class="btn btn-success btn-custom" type="button">Apuntarme a nueva clase</router-link>
                         
                       </div>
                   </div>
          
                   <DataTable :value="clase" tableStyle="min-width: 50rem">
                        <Column field="actividad.nombre" header="Actividad"></Column>
                        <Column field="fecha" header="Fecha"  ></Column>
                        <Column header="Acciones">
                            <template #body="slotProps">
                            <!--Botón para eliminar clase-->
                            <Button  class="btn btn-primary btn-custom" @click="confirm1($event,slotProps.data.id, slotProps.index)">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                    <path fill="#ffffff"
                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                </svg>
                                Cancelar mi asistencia
                            </Button>
                     
                         </template>
                        </Column>
                    </DataTable>

               </div>
           </div>
       </div>
   </div>
 </template>
 
 
 <script setup>
  
  import {ref, onMounted,inject} from "vue"
  const swal = inject('$swal')

  const clase=ref()
  const actividades = ref([])

  onMounted(()=>{

        axios.get('/api/clase')
        .then(response =>{
        console.log(response);
        clase.value = response.data;
        })

       

    })

    
    //Función eliminar clase
    const deleteClase = (id, index) => {
       
       axios.delete(`/api/clase/${id}`)
           .then(response => {
               console.log("Clase eliminado:", response.data);
               // Mostrar index del array sin el dato eliminado
               clase.value.splice(index, 1);
               
           })
           .catch(error => {
               console.error("Error al eliminar el clase:", error);
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
                               title: 'Dato eliminado'
                           })
                   deleteClase(id,index)
               }else{
                   swal({
                               icon: 'error',
                               title: 'Error al intentar eliminar el dato'
                           })
               }
           })

   };
 
</script>


<style scoped>
.btn-custom {
    background-color: black;
    color: white;
}



</style>
 
 
