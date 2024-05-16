<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añadir productos</h5>
            </div>



            <!--Enviar form a script-->
            <form @submit.prevent="guardarProducto">

                <div class="form-gorup mb-2">
                    <label>Nombre:</label><span class="text-danger"></span>
                    <input v-model="producto.nombre" class="form-control" type="text" name="nombre" />
                </div>

                <div class="form-gorup mb-2">
                    <label>Descripcion:</label><span class="text-danger"></span>
                    <input v-model="producto.descripcion" class="form-control" type="text" name="descripción" />
                </div>

                <div class="form-group mb-2">
                    <label>Precio:</label><span class="text-danger"> </span>
                    <input v-model="producto.precio" class="form-control" type="text"></input>
                </div>

                <div class="form-group mb-2">
                    <label class="imagen">imagen:</label><span class="text-danger"></span>
                    <!-- <img class="imagen" :src="slotProps.data.media[0]?.original_url"> -->
                    <DropZone v-model="producto.img"/>

                </div>


                <div class="card flex flex-wrap gap-2 justify-content-center">
                    <Button @click="confirm1($event)" label="Guardar" outlined></Button>

                </div>

            </form>

        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";
import { useRouter, useRoute } from 'vue-router';
import DropZone from "@/components/DropZone.vue";

const swal = inject('$swal')
const router = useRouter();
const route = useRoute(); // Usar useRoute() para acceder a los parámetros de la ruta
const id = route.params.id; // Obtener el ID de la ruta
const producto = ref({});



// Obtener datos del producto para editar
onMounted(() => {
    axios.get(`/api/producto/` + id)
        .then(response => {
            producto.value = response.data.data;
            producto.value.img= producto.value.media[0]?.original_url
        })
        .catch(error => {
            console.error("Error al obtener los datos de productos:", error);
        });
});

// Función para guardar cambios
const guardarProducto = () => {
    // Crear un objeto FormData para enviar datos del formulario
    let serializedProducto = new FormData();
    for (let item in producto.value) {
        if (producto.value.hasOwnProperty(item)) {
            serializedProducto.append(item, producto.value[item]);
        }
    }

    // Realizar la solicitud POST para actualizar el producto
    axios.post(`/api/producto/${id}`, serializedProducto, {
        headers: {
            "Content-Type": "multipart/form-data"
        }
    })
    .then(response => {
        console.log("Producto actualizado:", response.data);
        // Redireccionar a la vista de lista de productos u otra vista
        router.push({ name: 'producto.index' });
    })
    .catch(error => {
        console.error("Error al actualizar el producto:", error);
    });
};


//Función para mensaje confirmación
const confirm1 = (event, id, index) => {
    console.log(event);
    swal({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esta acción!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        confirmButtonColor: '#ef4444',
        timer: 20000,
        timerProgressBar: true,
        reverseButtons: true
    })
        .then(result => {
            if (result.isConfirmed) {
                swal({
                    icon: 'success',
                    title: 'Dato modificado'
                })
                guardarProducto(id, index)
            } else {
                swal({
                    icon: 'error',
                    title: 'Error al intentar modificar el prodcuto'
                })
            }
        })

};



</script>