
<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Vista tabla registro asistencia</h5>
                    </div>
                    
                    <DataTable :value="asistencias" tableStyle="min-width: 50rem" class="table-dark">
                         <Column field="clase.hora" header="Clase registrada" class="text-black" ></Column>
                         <Column field="estado.estado" header="Resultado asistencia" class="text-black" ></Column>
                         <Column field="user.name" header="Nombre alumno" class="text-black"></Column>
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
   
 </script>
 
 
