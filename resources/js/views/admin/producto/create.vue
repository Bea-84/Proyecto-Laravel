<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade un nuevo producto</h5>
            </div>



            <!--Enviar form a script-->
            <form @submit.prevent="addProducto">

                <div class="form-group mb-2">
                    <label>Descripción:</label><span class="text-danger"></span>
                    <input v-model="producto.descripcion" class="form-control" type="text" name="descripción" />
                </div>

                <div class="form-group mb-2">
                    <label>Precio:</label><span class="text-danger"> </span>
                    <input v-model="producto.precio" class="form-control" type="text"></input>
                </div>


                <div class="form-group mb-2">
                    <label>imagen:</label><span class="text-danger"></span>
                    <!-- <input v-model="producto.imagen" class="form-control" type="text" name="imagen" /> -->
                    <FileUpload mode="basic" name="demo[]" url="/api/create" accept="image/*"  @upload="onUpload" />
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir producto</button>


            </form>
        </div>
    </div>
</template>


<script setup>
import FileUpload from 'primevue/fileupload';
import { ref, onMounted } from "vue";
import { useRouter } from 'vue-router'
import { useToast } from "primevue/usetoast";
const router = useRouter()
const producto = ref({});
const toast = useToast();

function addProducto() {
    axios.post('/api/producto', producto.value)
        .then(response => {
            console.log(response);
            router.push({ name: 'producto.index' })
        })
        .catch(error => {
            console.log(error);
        })
    }






const onUpload = () => {
    toast.add({ severity: 'info', summary: 'Success', detail: 'File Uploaded', life: 3000 });
}


</script>