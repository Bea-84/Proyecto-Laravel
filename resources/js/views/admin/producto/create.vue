<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade un nuevo producto</h5>
            </div>

            <!--Enviar form a script-->
            <form @submit.prevent="addProducto">

                <div class="form-group mb-2">
                    <label>Nombre:</label><span class="text-danger"></span>
                    <input v-model="producto.nombre" class="form-control" type="text" name="nombre" />
                </div>

                <div class="form-group mb-2">
                    <label>Descripción:</label><span class="text-danger"></span>
                    <input v-model="producto.descripcion" class="form-control" type="text" name="descripción" />
                </div>

                <div class="form-group mb-2">
                    <label>Precio:</label><span class="text-danger"> </span>
                    <input v-model="producto.precio" class="form-control" type="text"></input>
                </div>


                <div class="form-group mb-2">
                    <label class="imagen">imagen:</label><span class="text-danger"></span>
                    <DropZone v-model="producto.img"/>
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir producto</button>


            </form>
        </div>
    </div>
</template>


<script setup>

import DropZone from "@/components/DropZone.vue";
import { ref, onMounted } from "vue";
import { useRouter } from 'vue-router'

const router = useRouter()
const producto = ref({});




function addProducto() {

    let serializedProducto= new FormData()
    for (let item in producto.value) {
        if (producto.value.hasOwnProperty(item)) {
            serializedProducto.append(item, producto.value[item])
        }
    }

    axios.post('/api/producto', serializedProducto, {
        headers: {
            "Content-Type": "multipart/form-data"
        }
    })
    .then(response => {
        console.log(response);
        router.push({ name: 'producto.index' });
    })
    .catch(error => {
        console.error(error);
    });

    }


</script>

<style scoped>
.imagen {
    width: 100px; /* Ancho deseado */
    height: 100px; /* Altura deseada */
    object-fit: cover; /* Para asegurar que la imagen mantenga su relación de aspecto */
}
</style>