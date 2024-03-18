
<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Tabla especialidad</h5>
                        <div>
                         
                         <router-link :to="{name: 'especialidad.create'}" class="btn btn-success" type="button">Nuevo especialidad</router-link>
                          
                        </div>
                    </div>

                    
                    
                    <DataTable :value="especialidad" tableStyle="min-width: 50rem">
                         <Column field="id" header="id"  ></Column>
                         <Column field="dia" header="Dia"  ></Column>
                         <Column field="hora" header="Hora"  ></Column>
                         <Column field="user_id" header="Usuario ID" ></Column>
                         <Column header="Acciones">
                         <template #body="slotProps">

                             <!-- Botón para editar especialidad que le pasaremos a la vista edit los datos a través de su id-->
                         <router-link
                                :to="{ name: 'especialidad.edit', params: { id: slotProps.data.id } }" class="btn btn-primary"> Edit
                            </router-link>

                               <!--Botón para eliminar nivel-->
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
 
  const especialidad=ref()
   

   onMounted(()=>{

      axios.get('/api/especialidad')
           .then(response =>{
             console.log(response);
             especialidad.value = response.data;
           })

   })
 
//Función eliminar especialidad
const deleteEspecialidad = (id, index) => {
       
       axios.delete(`/api/especialidad/${id}`)
           .then(response => {
               console.log("Especialidad eliminada:", response.data);
               // Mostrar index del array sin el dato eliminado
               especialidad.value.splice(index, 1);
               
           })
           .catch(error => {
               console.error("Error al eliminar la especialidad:", error);
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
               deleteEspecialidad(id,index)
           },
           reject: () => {

           
               toast.add({ severity: 'error', summary: 'Cancelado', detail: 'Cambios no guardados', life: 3000 });
           }
       });
   };
 
</script>


<style>


</style>
 
 
