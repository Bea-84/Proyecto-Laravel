
<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Vista tabla asistencia alumnos</h5>
                        <div>
                        <!--Boton envio con vue-->
                        <router-link :to="{name: 'asistencia.create'}" class="btn btn-success" type="button">Introduce nuevo dato asistencia</router-link>
                           <!--<button class="btn btn-success" type="button">Nueva Tarea</button>-->
                       </div>
                    </div>
                    
                    <DataTable :value="asistencias" tableStyle="min-width: 50rem">
                         <Column field="id" header="Id"  ></Column>
                         <Column field="asistencia" header="Resultado OK/NG"  ></Column>
                         <Column field="fecha" header="Fecha clase"  ></Column>
                         <Column field="user_id" header="Id alumno" ></Column>
                         <Column header="Acciones">
                         <template #body="slotProps">
                         <!-- Botón para editar asistencia que le pasaremos a la vista edit los datos a través de su id-->
                         <router-link
                                :to="{ name: 'asistencia.edit', params: { id: slotProps.data.id } }" class="btn btn-primary mr-2"> Edit
                            </router-link>

                             <!--Botón para eliminar asistencia-->
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
 
   const asistencias=ref()

    import { useConfirm } from "primevue/useconfirm";
    import { useToast } from "primevue/usetoast";

    const confirm = useConfirm();
    const toast = useToast();
   
 
   onMounted(()=>{
 
      axios.get('/api/asistencia')
           .then(response =>{
             console.log(response);
             asistencias.value = response.data;
           })
 
   })

    //Función eliminar nivel
    const deleteAsistencia = (id, index) => {
       
       axios.delete(`/api/asistencia/${id}`)
           .then(response => {
               console.log("Dato asistencia eliminado:", response.data);
               // Mostrar index del array sin el dato eliminado
               asistencias.value.splice(index, 1);
               
           })
           .catch(error => {
               console.error("Error al eliminar dato asistencia:", error);
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
               deleteAsistencia(id,index)
           },
           reject: () => {

           
               toast.add({ severity: 'error', summary: 'Cancelado', detail: 'Cambios no guardados', life: 3000 });
           }
       });
   };
   
 </script>
 
 
