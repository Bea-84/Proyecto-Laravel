
<template>
    <div class="grid">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   <div class="d-flex justify-content-between pb-2 mb-2">
                       <h5 class="card-title">Mis clases</h5>
                       <div>
                        
                        <router-link :to="{name: 'clase.create'}" class="btn btn-success" type="button">Apuntarme a nueva clase</router-link>
                         
                       </div>
                   </div>
                   
                   <DataTable :value="user_clase" tableStyle="min-width: 50rem">
                        <Column field="pivot.user_id" header="Id usuario"  ></Column>
                        <Column field="pivot.clase_id" header="Id clase"  ></Column>
                        <Column header="Acciones">
                        
                        </Column>
                    </DataTable>
               </div>
           </div>
       </div>
   </div>
 </template>
 
 
 <script setup>
  
  import {ref, onMounted,inject} from "vue"
  const swal = inject('$swal')
  const user_clase=ref()

  import useUsers from "../../../composables/users"
  const {users, getUsers} = useUsers()

    //Función para obtener usuarios y clases de tabla intermedia 
    onMounted(()=> {
        getUsers();

        axios.get('/api/clase')
          .then(response =>{
            console.log(response);
            user_clase.value = response.data;
          })

    })

 

 
</script>


<style>


</style>
 
 
