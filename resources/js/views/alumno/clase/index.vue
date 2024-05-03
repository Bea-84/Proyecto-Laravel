
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card ">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title  text-uppercase"><strong>Clases registradas</strong></h5>
                       
                        <div>
                            <router-link :to="{name: 'clase.create'}" class="btn btn-dark" type="button">Añadir Nueva clase</router-link>
                        </div>

                    </div>
                    
                    <DataTable :value="clase" tableStyle="min-width: 50rem" class="border border-black p-3">
                         <Column field="id" header="#" class="text-black"></Column>
                         <Column field="actividad_id" header="Id actividad" class="text-black"></Column>
                         <Column field="fecha" header="Fecha clase" class="text-black" ></Column>
                         <Column field="duración" header="Duración clase" class="text-black"></Column>
                         <Column header="Acciones" class="text-black">
                         <template #body="slotProps">

                        
                         
                         </template>
                        </Column>
                     </DataTable>
                </div>
            </div>
        </div>
    </div>
 </template>
 
 
 <script setup>
  
 



   
 
 

   
    
  

   
 
</script>


<style>


</style>
 
 
