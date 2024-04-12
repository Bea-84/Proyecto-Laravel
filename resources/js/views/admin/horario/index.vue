<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Vista tabla horarios gimnasio</h5>
                    </div>
                    <div>
                        
                        <router-link :to="{name: 'horario.create'}" class="btn btn-success" type="button">Añadir nuevo Horario</router-link>
                         
                       </div>
                    
                    <DataTable :value="horario" tableStyle="min-width: 50rem">
                         <Column field="dia.diaSemana" header="Día semana"  ></Column>
                         <Column field="hora_inicio" header="Hora inicio"  ></Column>
                         <Column field="hora_fin" header="Hora fin" ></Column>
                         <Column header="Acciones">
                         <template #body="slotProps">
                         <!-- Botón para editar horario que le pasaremos a la vista edit los datos a través de su id-->
                         <router-link
                                :to="{ name: 'horario.edit', params: { id: slotProps.data.id } }" class="btn btn-primary mr-2"> Edit horario
                            </router-link>
                            <!--Botón para eliminar horario-->
                            <Toast />

                            <ConfirmPopup> </ConfirmPopup>
                            <Button @click="confirm1($event,slotProps.data.id, slotProps.index)"  class="btn btn-primary">Eliminar horario</Button>
                     
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
   
   const horario=ref()

    onMounted(()=>{

    axios.get('/api/horario')
        .then(response =>{
        console.log(response);
        horario.value = response.data;
        })

    })

       //Función eliminar horario
       const deleteHorario = (id, index) => {
       
       axios.delete(`/api/horario/${id}`)
           .then(response => {
               console.log("Horario eliminado:", response.data);
               // Mostrar index del array sin el dato eliminado
               horario.value.splice(index, 1);
               
           })
           .catch(error => {
               console.error("Error al eliminar el horario:", error);
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
               deleteHorario(id,index)
           },
           reject: () => {

           
               toast.add({ severity: 'error', summary: 'Cancelado', detail: 'Cambios no guardados', life: 3000 });
           }
       });
   };

</script>