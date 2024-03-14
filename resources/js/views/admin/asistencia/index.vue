
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
                                :to="{ name: 'asistencia.edit', params: { id: slotProps.data.id } }" class="btn btn-primary"> Edit
                            </router-link>
                         
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
   
 
   onMounted(()=>{
 
      axios.get('/api/asistencia')
           .then(response =>{
             console.log(response);
             asistencias.value = response.data;
           })
 
   })
   
 </script>
 
 
