<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade un nuevo nivel</h5>
            </div>
 
               <!--Var dumpt vue-->
               {{ nivel }} 

               <!--Enviar form a script-->
            <form @submit.prevent="addNivel">
                
                <div class="form-group mb-2">
                    <label>nombre</label><span class="text-danger"> *</span>
                    <textarea v-model="nivel.nombre" class="form-control" type="text" placeholder="nombre"></textarea>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>descripcion</label><span class="text-danger">*</span>
                    <input v-model="nivel.descripcion" class="form-control" type="text" name="descripción"/>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>user_id</label><span class="text-danger">*</span>
                    <input v-model="nivel.user_id" class="form-control" type="text" name="user_id"/>
                </div>
                
                <Dropdown v-model="nivel.user_id" :options="users.data" filter optionLabel="name" optionValue="id" placeholder="Selecciona Id usuario" class="w-full md:w-14rem">
                </Dropdown>
            
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Nivel</button>
 
 
            </form>
 
        </div>
    </div>
 </template>
 
 
 <script setup>
    import { ref, onMounted } from "vue";
    import { useRouter } from 'vue-router'
    import useUsers from "../../../composables/users"


    const {users, getUsers} = useUsers()
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

    onMounted(()=> {
        getUsers();
    })
    
    

</script>