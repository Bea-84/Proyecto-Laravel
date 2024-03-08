<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Todos los niveles</h5>
                        <div>
                         
                            <button class="btn btn-success" type="button">Nueva inscripcion</button>
                        </div>
                    </div>
                    
                    <DataTable :value="inscripcions" tableStyle="min-width: 50rem">
                         <Column field="id" header="id" sortable ></Column>
                         <Column field="fecha" header="Fecha" sortable ></Column>
                         <Column field="forma_de_pago" header="Forma Pago" sortable ></Column>
                         <Column field="user_id" header="Usuario ID" sortable ></Column>
                     </DataTable>
                </div>
            </div>
        </div>
    </div>
 </template>
 
 
 <script setup>
   
   import {ref, onMounted} from "vue"
 
   const inscripcions=ref()
 
   onMounted(()=>{
 
      axios.get('/api/inscripcion')
           .then(response =>{
             console.log(response);
             inscripcions.value = response.data;
           })
 
   })
   
 </script>
 
 
 <style>
 
 
 </style>
 