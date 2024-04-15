<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añadir horario</h5>
            </div>
 
              

               <!--Enviar form a script-->
            <form @submit.prevent="addHorario">
                
                <div>Día:</div>
                <div class="card flex justify-content-center">
                    <div class="flex flex-column gap-3">
                        <div
                            v-for="dia in dias"
                            :key=dia.id
                            class="flex align-items-center"
                        >
                            <RadioButton
                                v-model=horario.dia
                                :value=dia.id
                                @input="change($event.target.value)"
                                name="diaSemana"
                            />
                            <label :for=dia.id class="ml-2">{{ dia.diaSemana }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-gorup mb-2">
                    <label>Hora inicio:</label><span class="text-danger"></span>
                    <input v-model="horario.hora_inicio" class="form-control" type="time" name="Hora inicio"/>
                </div>

                <div class="form-gorup mb-2">
                    <label>Hora fin:</label><span class="text-danger"></span>
                    <input v-model="horario.hora_fin" class="form-control" type="time" name="Hora fin"/>
                </div>
 
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Horario</button>
 
 
            </form>
 
        </div>
    </div>
 </template>
 
 
 <script setup>
    import { ref, onMounted } from "vue";
    import { useRouter } from 'vue-router'
    


    const dias = ref([ ]);
    const router = useRouter()
    const horario=ref({});

    function addHorario(){
       axios.post('/api/horario',horario.value)
            .then(response =>{
                console.log(response);
                router.push({ name: 'horario.index' })
            })
            .catch(error=>{
                console.log(error);
            }) 
    }

    onMounted(()=> {
        
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

    
    
    

</script>