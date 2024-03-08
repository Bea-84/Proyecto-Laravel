
<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Asistencia alumnos</h5>
                        <div>
                         
                            <button class="btn btn-success" type="button">Introducir nuevo dato de asistencia</button>
                        </div>
                    </div>
                    
                    <DataTable :value="asistencias" tableStyle="min-width: 50rem">
                         <Column field="id" header="Id"  ></Column>
                         <Column field="asistencia" header="Asistencia"  ></Column>
                         <Column field="fecha" header="Fecha clase"  ></Column>
                         <Colum fiel="user_id" header="Id alumno" ></Colum>
                     </DataTable>
                </div>
            </div>
        </div>
    </div>
 </template>
 
 
 <script setup>
   
   import {ref, onMounted} from "vue"
 
   const asistencias=ref()
 
   onMounted(()=>{
 
      axios.get('/api/asistencia')
           .then(response =>{
             console.log(response);
             asistencias.value = response.data;
           })
 
   })
   
 </script>
 
 
 <style>
 
 
 </style>