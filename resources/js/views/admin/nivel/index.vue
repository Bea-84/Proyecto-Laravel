
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
                    </DataTable>
               </div>
           </div>
       </div>
   </div>
</template>


<script setup>
  
  import {ref, onMounted} from "vue"

  const niveles=ref()

  onMounted(()=>{

     axios.get('/api/nivel')
          .then(response =>{
            console.log(response);
            niveles.value = response.data;
          })

  })
  
</script>


<style>


</style>

