
<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Tabla especialidad</h5>
                        <div>
                         
                         <router-link :to="{name: 'especialidad.create'}" class="btn btn-success" type="button">Nuevo especialidad</router-link>
                          
                        </div>
                    </div>

                    {{ especialidad }}
                    
                    <DataTable :value="especialidad" tableStyle="min-width: 50rem">
                         <Column field="id" header="id"  ></Column>
                         <Column field="dia" header="Dia"  ></Column>
                         <Column field="hora" header="Hora"  ></Column>
                         <Column field="user_id" header="Usuario ID" ></Column>
                     </DataTable>
                </div>
            </div>
        </div>
    </div>
 </template>
 
 
 <script setup>
  
   import {ref, onMounted} from "vue"

   const especialidad=ref()

   onMounted(()=>{

      axios.get('/api/especialidad')
           .then(response =>{
             console.log(response);
             especialidad.value = response.data;
           })

   })
 
</script>
 
 
