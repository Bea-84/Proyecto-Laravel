
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
          
                   <DataTable :value="clase" tableStyle="min-width: 50rem">
                        <Column field="actividad.nombre" header="Actividad"></Column>
                        <Column field="fecha" header="Fecha"  ></Column>
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

  const clase=ref()
  const actividades = ref([])

  onMounted(()=>{

        axios.get('/api/clase')
        .then(response =>{
        console.log(response);
        clase.value = response.data;
        })

       

    })
 
</script>


<style>


</style>
 
 
