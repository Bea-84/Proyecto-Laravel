<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Inscripciones</h5>
                        <div>
                         
                            <router-link :to="{name: 'inscripcion.create'}" class="btn btn-success" type="button">Nueva Inscripción</router-link>
                           
                        </div>
                    </div>
                    
                   <DataTable :value="inscripciones" tableStyle="min-width: 50rem">
                         <Column field="id" header="id"  ></Column>
                         <Column field="fecha" header="Fecha"  ></Column>
                         <Column field="forma_de_pago" header="Forma Pago"  ></Column>
                         <Column field="user_id" header="Id alumno" ></Column>
                         <Column header="Acciones">
                         <template #body="slotProps">
                          <!-- Botón para editar inscripcion que le pasaremos a la vista edit los datos a través de su id-->
                         <router-link
                                :to="{ name: 'inscripcion.edit', params: { id: slotProps.data.id } }" class="btn btn-primary"> Edit
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
 
  const inscripciones=ref()
   
 
   onMounted(()=>{
 
      axios.get('/api/inscripcion')
           .then(response =>{
             console.log(response);
             inscripciones.value = response.data;
           })
 
   })
   
 //Función eliminar nivel
 const deleteInscripcion = (id, index) => {
       
       axios.delete(`/api/inscripcion/${id}`)
           .then(response => {
               console.log("Inscripción eliminada:", response.data);
               // Mostrar index del array sin el dato eliminado
               inscripciones.value.splice(index, 1);
               
           })
           .catch(error => {
               console.error("Error al eliminar la inscripción:", error);
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
               deleteInscripcion(id,index)
           },
           reject: () => {

           
               toast.add({ severity: 'error', summary: 'Cancelado', detail: 'Cambios no guardados', life: 3000 });
           }
       });
   };
 
</script>


<style>


</style>


 