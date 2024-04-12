<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade un nuevo nivel</h5>
            </div>
 
              

               <!--Enviar form a script-->
            <form @submit.prevent="addNivel">
                
                <div class="form-group mb-2">
                    <label>Nombre:</label><span class="text-danger"> </span>
                    <textarea v-model="nivel.nombre" class="form-control" type="text" placeholder="nombre"></textarea>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>Descripcion:</label><span class="text-danger"></span>
                    <input v-model="nivel.descripcion" class="form-control" type="text" name="descripción"/>
                </div>
 
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Nivel</button>
 
 
            </form>
 
        </div>
    </div>
 </template>
 
 
 <script setup>
    import { ref, onMounted } from "vue";
    import { useRouter } from 'vue-router'
    


    
    const router = useRouter()
    const nivel=ref({});

    function addNivel(){
       axios.post('/api/nivel',nivel.value)
            .then(response =>{
                console.log(response);
                router.push({ name: 'nivel.index' })
            })
            .catch(error=>{
                console.log(error);
            }) 
    }

    
    
    

</script>