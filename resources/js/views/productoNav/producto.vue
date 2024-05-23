<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <!-- <h5 class="card-title">Nuestros productos</h5> -->
                    </div>
                   

                    <DataTable class="table" :value="producto" tableStyle="min-width: 50rem">
                        <Column field="nombre" header="Nombre"></Column>
                        <Column field="descripcion" header="Descripcion"></Column>
                        <Column field="precio" header="Precio"></Column>
                        <Column field="imagen" header="Imagen">
                            <template #body="slotProps">
                            <img class="imagen" :src="slotProps.data.media[0]?.original_url">
                            </template>
                        </Column>
                       
                    </DataTable>
                </div>
            </div>
        </div>
    </div>
    <AppFooter class="footer"/>
</template>

<script setup>

import AppFooter from '../../layouts/AppFooter.vue';

import { ref, onMounted, inject } from "vue"

const producto = ref()

onMounted(() => {

    axios.get('/api/producto')
        .then(response => {
            console.log(response);
            producto.value = response.data;
        })

})




</script>

<style scoped>
.imagen {
    width: 100px; /* Ancho deseado */
    height: 100px; /* Altura deseada */
    object-fit: cover; /* Para asegurar que la imagen mantenga su relación de aspecto */
}

.footer {
    margin-top: 15%; /*Espacio entre la tabla y el footer*/ 
}

.table {
    margin-left: 10%; /* Centrar la tabla dejando margen izquierdo*/
    width: 80%; /* Ancho de la tabla*/
}

</style>
