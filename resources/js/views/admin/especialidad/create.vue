<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una especialidad nueva</h5>
            </div>
 
                {{ especialidad }}

               <!--Enviar form a script-->
            <form @submit.prevent="addEspecialidad">
                
                <div>Día:</div>
                
                <div class="flex flex-wrap gap-3">
                    <div class="flex align-items-center">
                        <RadioButton  v-model="especialidad.dia"  name="dia" value="Lunes" />
                        <label  class="ml-2"> Lunes </label>
                    </div>
                    <div class="flex align-items-center">
                        <RadioButton v-model="especialidad.dia"  name="dia" value="Martes" />
                        <label class="ml-2"> Martes </label>
                    </div>
                    <div class="flex align-items-center">
                        <RadioButton  v-model="especialidad.dia"  name="dia" value="Miercoles" />
                        <label  class="ml-2"> Miercoles </label>
                    </div>
                    <div class="flex align-items-center">
                        <RadioButton  v-model="especialidad.dia"  name="dia" value="Jueves" />
                        <label  class="ml-2"> Jueves </label>
                    </div>
                    <div class="flex align-items-center">
                    <RadioButton  v-model="especialidad.dia"  name="dia" value="Viernes" />
                    <label  class="ml-2"> Viernes </label>
                </div>
                </div>
                <br>

                <div>Hora:</div>

             <div class="flex flex-wrap gap-3">
                <div class="flex align-items-center">
                    <RadioButton  v-model="especialidad.hora" name="hora" value="10:00-11:00" />
                    <label  class="ml-2"> 10:00-11:00 </label>
                </div>
                <div class="flex align-items-center">
                    <RadioButton  v-model="especialidad.hora"  name="hora" value="16:30-17:30" />
                    <label class="ml-2"> 16:30-17:30 </label>
                </div>
                <div class="flex align-items-center">
                    <RadioButton  v-model="especialidad.hora"  name="hora" value="17:30-18:30" />
                    <label class="ml-2"> 17:30-18:30 </label>
                </div>
                <div class="flex align-items-center">
                    <RadioButton  v-model="especialidad.hora"  name="hora" value="18:30-19:30" />
                    <label  class="ml-2"> 18:30-19:30 </label>
                </div>
                <div class="flex align-items-center">
                <RadioButton  v-model="especialidad.hora"  name="hora" value="20:30-21:30" />
                <label  class="ml-2"> 20:30-21:30 </label>
              </div>
              </div>
                
              <br>
 
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




 
 