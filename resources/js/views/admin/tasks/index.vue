
<template>
   <div class="grid">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   <div class="d-flex justify-content-between pb-2 mb-2">
                       <h5 class="card-title">Todas las tareas</h5>
                       <div>
                        <!--Boton envio con vue-->
                        <router-link :to="{name: 'task.create'}" class="btn btn-success" type="button">Nueva Tarea</router-link>
                           <!--<button class="btn btn-success" type="button">Nueva Tarea</button>-->
                       </div>
                   </div>
                   
                   

                   <table class="table table-hover table-sm">
                       <thead class="bg-dark text-light">
                           <tr>
                               <th width="50" class="text-center">#</th>
                               <th>Name</th>
                               <th>description</th>
                               <th>date_open</th>
                               <th>date_close</th>
                               <th class="text-center" width="200">Acciones</th>
                           </tr>
                       </thead>
                       <tbody>
                        <!--Bucle vue-->
                           <tr v-for ="task in tasks">
                               <td class="text-center">{{ task.id }}</td>
                               <td>{{ task.name }}</td>
                               <td>{{ task.description }}</td>
                               <td>{{ task.date_open }}</td>
                               <td>{{ task.date_close }}</td>
                               <td class="text-center">
                                   <a class="btn btn-warning mr-1">Edit</a>
                                   <button class="btn btn-danger">Delete</button>
                               </td>
                           </tr>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>
</template>


<script setup>
  
  import {ref, onMounted} from "vue"

  const tasks=ref()

  onMounted(()=>{

     axios.get('/api/tasks')
          .then(response =>{
            //console.log(response);
            tasks.value = response.data;
          })

  })
  
</script>


<style>


</style>

