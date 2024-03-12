<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una especialidad nueva</h5>
            </div>
 
 
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong></strong>
            </div>
 
 
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong></strong>
            </div>
               <!--Var dumpt vue-->
               {{ especialidad }} 

               <!--Enviar form a script-->
            <form @submit.prevent="addEspecialidad">
                

                <div class="form-group mb-2">
                    <label>Dia</label><span class="text-danger"> *</span>
                    <!--input añadimos v- model para vue-->
                    <input v-model="especialidad.dia" type="date" class="form-control" placeholder="Dia">
                </div>
 
 
                <div class="form-group mb-2">
                    <label>Hora</label><span class="text-danger"> *</span>
                    <input v-model="especialidad.hora"  type="time" class="form-control" rows="3" placeholder="Hora">
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>User_id</label><span class="text-danger">*</span>
                    <input v-model="especialidad.user_id" class="form-control" type="text" name="user_id"/>
                </div>
                
                <Dropdown v-model="especialidad.user_id" :options="users.data" filter optionLabel="name" optionValue="id" placeholder="Selecciona Id usuario" class="w-full md:w-14rem">
                </Dropdown>
            
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Especialidad</button>
 
 
 
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
    const especialidad=ref({});

    function addEspecialidad(){
       axios.post('/api/especialidad',especialidad.value)
            .then(response =>{
                console.log(response);
                router.push({ name: 'especialidad.index' })
            })
            .catch(error=>{
                console.log(error);
            }) 
    }

    onMounted(()=> {
        getUsers();
    })
    

</script>




 
 