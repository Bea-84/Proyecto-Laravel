<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una clase nueva</h5>
            </div>
 
              

               <!--Enviar form a script-->
            <form @submit.prevent="addClase">
                
                <div>Día:</div>
                <div class="card flex justify-content-center">
                    <div class="flex flex-column gap-3">
                        <div
                            v-for="dia in dias"
                            :key=dia.id
                            class="flex align-items-center"
                        >
                            <RadioButton
                                v-model=clase.dia
                                :value=dia.id
                                @input="change($event.target.value)"
                                name="diaSemana"
                            />
                            <label :for=dia.id class="ml-2">{{ dia.diaSemana }}</label>
                        </div>
                    </div>
                </div>

                <br>

                <div>Horario:</div>
                <div class="card flex justify-content-center">
                    <div class="flex flex-column gap-3">
                        <div
                            v-for="horario in horarios"
                            :key=horario.id
                            class="flex align-items-center"
                        >
                            <RadioButton
                                v-model=clase.hora
                                :value="horario.hora_inicio + '-' + horario.hora_fin" 
                                name="horario"
                            />
                            <label :for="horario.id" class="ml-2">{{ horario.hora_inicio + '-' + horario.hora_fin }}</label>
                        </div>
                    </div>
                </div>

                
                
              <br>
 
                <div class="form-gorup mb-2">
                    <label>User_id</label><span class="text-danger">*</span>
                    <input v-model="clase.user_id" class="form-control" type="text" name="user_id"/>
                </div>
                
                <Dropdown v-model="clase.user_id" :options="users.data" filter optionLabel="name" optionValue="id" placeholder="Selecciona Id usuario" class="w-full md:w-14rem">
                </Dropdown>
            
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir clase</button>
 
 
 
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
    const clase=ref({});
    const dias = ref([ ]);
    const horarios = ref([]);
    

    function addClase(){
       axios.post('/api/clase',clase.value)
            .then(response =>{
                console.log(response);
                router.push({ name: 'clase.index' })
            })
            .catch(error=>{
                console.log(error);
            }) 
    }

    onMounted(()=> {
        getUsers();
         // Obtener los días de la API 
         axios.get('/api/dia')
            .then(response => {
                console.log(response);
                dias.value = response.data; 
            })
            .catch(error => {
                console.error('Error al obtener datos:', error);
            });
           
           
            
             
    })
    
    //Función para conseguir horarios después de haber seleccionado el dia de la semana
    function change( value) {
         //Obtener los horarios de la API solo por el id del dia selaccionado
        axios.get('/api/horario/dia/'+value)
            .then(response => {
                console.log(response);
                horarios.value = response.data; 
            })
            .catch(error => {
                console.error('Error al obtener datos:', error);
            });
  }

    


    

</script>




 
 