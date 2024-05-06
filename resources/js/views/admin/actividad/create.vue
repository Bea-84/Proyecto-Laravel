<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añadir actividad</h5>
            </div>


            <!--Enviar form a script-->
            <form @submit.prevent="addActividad">

                <div class="form-group mb-2">
                    <label>Nombre:</label><span class="text-danger"> </span>
                    <input v-model="actividad.nombre" class="form-control" type="text" name="nombre" />
                </div>


                <div class="form-group mb-2">
                    <label>Descripcion:</label><span class="text-danger"></span>
                    <textarea v-model="actividad.descripcion" class="form-control" type="text" placeholder="descripcion"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Actividad</button>
            </form>

        </div>
    </div>
</template>


<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from 'vue-router'



const dias = ref([]);
const router = useRouter()
const actividad = ref({});

function addActividad() {
    axios.post('/api/actividad', actividad.value)
        .then(response => {
            console.log(response);
            router.push({ name: 'actividad.index' })
        })
        .catch(error => {
            console.log(error);
        })
}

onMounted(() => {

})





</script>