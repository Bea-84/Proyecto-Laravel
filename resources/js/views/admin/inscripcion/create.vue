<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una nueva inscripción</h5>
            </div>
 
             

               <!--Enviar form a script-->
            <form @submit.prevent="addInscripcion">
                
 
                <div class="form-group mb-2">
                    <label>fecha</label><span class="text-danger"> *</span>
                    <input v-model="inscripcion.fecha" class="form-control" type="datetime-local" placeholder="fecha"/>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>forma_de_pago</label><span class="text-danger">*</span>
                    <input v-model="inscripcion.forma_de_pago" class="form-control" type="text" name="forma de pago"/>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>user_id</label><span class="text-danger">*</span>
                    <input v-model="inscripcion.user_id" class="form-control" type="text" name="user_id"/>
                </div>
                
                <Dropdown v-model="inscripcion.user_id" :options="users.data" filter optionLabel="name" optionValue="id" placeholder="Select a Id" class="w-full md:w-14rem">
                </Dropdown>

                <div class="form-gorup mb-2">
                    <label>nivel_user</label><span class="text-danger">*</span>
                    <input v-model="inscripcion.nivel_user" class="form-control" type="text" name="id"/>
                </div>

                <Dropdown v-model="inscripcion.nivel_user" :options="nivel" filter optionLabel="nombre" optionValue="id" placeholder="Select a Id" class="w-full md:w-14rem">
                </Dropdown>

                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Inscripcion</button>
 
 
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
    const inscripcion=ref({});
    const nivel=ref()

    function addInscripcion(){
       axios.post('/api/inscripcion',inscripcion.value)
            .then(response =>{
                console.log(response);
                router.push({ name: 'inscripcion.index' })
            })
            .catch(error=>{
                console.log(error);
            }) 
    }
    //Función para obtener usuarios
    onMounted(()=> {
        getUsers();

        axios.get('/api/nivel')
        .then(response =>{
            console.log(response);
            nivel.value = response.data;
        });

    })

</script>