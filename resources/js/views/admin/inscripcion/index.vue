<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Inscripciones</h5>
                        <div>
                         
                            <router-link :to="{name: 'inscripcion.create'}" class="btn btn-success" type="button">Nueva Inscripcion</router-link>
                           
                        </div>
                    </div>
                    
                    <DataTable :value="inscripcions" tableStyle="min-width: 50rem">
                         <Column field="id" header="id"  ></Column>
                         <Column field="fecha" header="Fecha"  ></Column>
                         <Column field="forma_de_pago" header="Forma Pago"  ></Column>
                         <Column field="user_id" header="Usuario ID" ></Column>
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
 