
<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Vista tabla registro asistencia alumnos</h5>
                    </div>
                    
                    <DataTable :value="asistencias" tableStyle="min-width: 50rem">
                         <Column field="clase.hora" header="Clase registrada"  ></Column>
                         <Column field="estado.estado" header="Resultado asistencia"  ></Column>
                         <Column field="user.name" header="Nombre alumno" ></Column>
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
 
 
