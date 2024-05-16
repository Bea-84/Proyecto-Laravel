<template>
<div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Registro clases</h5>
            </div>
 
              

               <!--Enviar form a script-->
            <form @submit.prevent="addclase">
                
                
                <div class="form-gorup mb-2">
                    <label>Actividad id</label><span class="text-danger"></span>
                    <input v-model="clase.actividad_id" class="form-control" type="number" name="id"/>
                </div>

                <Dropdown v-model="clase.actividad_id" :options="actividades" filter optionLabel="nombre" optionValue="id" placeholder="Selecciona actividad" class="w-full md:w-14rem">
                </Dropdown>

                <br>

                <div class="form-group mb-2">
                    <label>Fecha</label><span class="text-danger"> </span>
                    <input v-model="clase.fecha" class="form-control" type="datetime-local" placeholder="fecha"/>
                </div>
     
                
 
                <button type="submit" class="btn btn-primary mt-4 mb-4  btn-custom">Apuntarme a esta clase!! </button>
 
 
            </form>
 
        </div>
    </div>
 </template>
 
 <script setup>
  
    import { ref, onMounted } from "vue";
    import { useRouter } from 'vue-router'
    
    
    const router = useRouter()
    const clase=ref({});
    const actividades = ref([])
    

    onMounted(() => {

        axios.get('/api/actividad')
            .then(response => {
                console.log(response);
                actividades.value = response.data;
            })

    })

    function addclase(){
       axios.post('/api/clase',clase.value)
            .then(response =>{
                console.log(response);
                router.push({ name: 'clase.index' })
            })
            .catch(error=>{
                console.log(error);
            }) 
    }

</script>

<style scoped>
.btn-custom {
    background-color: black;
    color: white;
}



</style>

   




 
 