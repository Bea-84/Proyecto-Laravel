
<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title font-weight-bold text-uppercase">Tabla clases registradas</h5>
                       
                        <div>
                            <router-link :to="{name: 'clase.create'}" class="btn btn-dark" type="button">Añadir Nueva clase</router-link>
                        </div>

                    </div>
                    
                    <DataTable :value="clase" tableStyle="min-width: 50rem" class="table-dark">
                         <Column field="dia.diaSemana" header="Dia" class="text-black"></Column>
                         <Column field="hora" header="Hora clase" class="text-black" ></Column>
                         <Column field="user_id" header="ID alumno" class="text-black"></Column>
                         <Column header="Acciones" class="text-black">
                         <template #body="slotProps">

                             <!-- Botón para editar clase que le pasaremos a la vista edit los datos a través de su id-->
                         <router-link
                                :to="{ name: 'clase.edit', params: { id: slotProps.data.id } }" class="btn btn-dark"> Edit clase
                            </router-link>

                               
                         <Toast />

                        <ConfirmPopup> </ConfirmPopup>
                        <Button @click="confirm1($event,slotProps.data.id, slotProps.index)"  class="btn btn-dark">Eliminar clase</Button>
                         
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
  const dias = ref([ ]);
  
   

   onMounted(()=>{

      axios.get('/api/clase')
           .then(response =>{
             console.log(response);
             clase.value = response.data;
           })
   })

   
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
 
 
