
<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Tabla clases</h5>
                        <div>
                         
                         <router-link :to="{name: 'clase.create'}" class="btn btn-success" type="button">Nuevo clase</router-link>
                          
                        </div>
                    </div>

                    
                    
                    <DataTable :value="clase" tableStyle="min-width: 50rem">
                         <Column field="dia" header="Id_dia_semana"></Column>
                         <Column field="hora" header="Hora clase"  ></Column>
                         <Column field="user_id" header="ID alumno" ></Column>
                         <Column header="Acciones">
                         <template #body="slotProps">

                             <!-- Botón para editar clase que le pasaremos a la vista edit los datos a través de su id-->
                         <router-link
                                :to="{ name: 'clase.edit', params: { id: slotProps.data.id } }" class="btn btn-primary"> Edit
                            </router-link>

                               
                         <Toast />

                        <ConfirmPopup> </ConfirmPopup>
                        <Button @click="confirm1($event,slotProps.data.id, slotProps.index)" label="Eliminar" outlined class="btn btn-primary"></Button>
                         
                         </template>
                        </Column>
                     </DataTable>
                </div>
            </div>
        </div>
    </div>
 </template>
 
 
 <script setup>
  
  import {ref, onMounted} from "vue"
   import { useConfirm } from "primevue/useconfirm";
   import { useToast } from "primevue/usetoast";

  const confirm = useConfirm();
  const toast = useToast();
 
  const clase=ref()
  
   

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
               console.log("Clase eliminada:", response.data);
               // Mostrar index del array sin el dato eliminado
               clase.value.splice(index, 1);
               
           })
           .catch(error => {
               console.error("Error al eliminar la clase:", error);
           });
   };

   //Función para popup
   const confirm1 = (event,id,index) => {
       console.log(event);

       confirm.require({
           target: event.currentTarget,
           message: 'Estas seguro que deseas eliminar este dato?',
           icon: 'pi pi-exclamation-triangle',
           rejectClass: 'p-button-secondary p-button-outlined p-button-sm',
           acceptClass: 'p-button-sm',
           rejectLabel: 'No',
           acceptLabel: 'Si',
           accept: () => {
               toast.add({ severity: 'info', summary: 'Confirmado', detail: 'Dato eliminado', life: 3000 });
               deleteClase(id,index)
           },
           reject: () => {

           
               toast.add({ severity: 'error', summary: 'Cancelado', detail: 'Cambios no guardados', life: 3000 });
           }
       });
   };

   
 
</script>


<style>


</style>
 
 
