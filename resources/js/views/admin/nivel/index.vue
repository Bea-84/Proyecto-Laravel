
<template>
   <div class="grid">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   <div class="d-flex justify-content-between pb-2 mb-2">
                       <h5 class="card-title">Todos los niveles</h5>
                       <div>
                        
                        <router-link :to="{name: 'nivel.create'}" class="btn btn-success" type="button">Nuevo Nivel</router-link>
                         
                       </div>
                   </div>
                   
                   <DataTable :value="niveles" tableStyle="min-width: 50rem">
                        <Column field="id" header="id"  ></Column>
                        <Column field="nombre" header="Nombre"  ></Column>
                        <Column field="descripcion" header="Descripcion"  ></Column>
                        <Column field="user_id" header="Usuario ID" ></Column>
                        <Column header="Acciones">
                         <template #body="slotProps">
                         <!-- Botón para editar nivel que le pasaremos a la vista edit los datos a través de su id-->
                         <router-link
                                :to="{ name: 'nivel.edit', params: { id: slotProps.data.id } }" class="btn btn-primary mr-2"> Edit
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

  const niveles=ref()

  import { useConfirm } from "primevue/useconfirm";
  import { useToast } from "primevue/usetoast";

  const confirm = useConfirm();
  const toast = useToast();

  onMounted(()=>{

     axios.get('/api/nivel')
          .then(response =>{
            console.log(response);
            niveles.value = response.data;
          })

  })

    //Función eliminar nivel
    const deleteNivel = (id, index) => {
       
        axios.delete(`/api/nivel/${id}`)
            .then(response => {
                console.log("Nivel eliminado:", response.data);
                // Mostrar index del array sin el dato eliminado
                niveles.value.splice(index, 1);
                
            })
            .catch(error => {
                console.error("Error al eliminar el nivel:", error);
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
                deleteNivel(id,index)
            },
            reject: () => {

            
                toast.add({ severity: 'error', summary: 'Cancelado', detail: 'Cambios no guardados', life: 3000 });
            }
        });
    };
  
</script>


<style>


</style>

