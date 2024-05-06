<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Vista productos</h5>
                    </div>
                    <div>
                        <router-link :to="{name: 'producto.create'}" class="btn btn-success" type="button">Añadir nuevo producto</router-link>    
                    </div>
                    
                    <DataTable :value="producto" tableStyle="min-width: 50rem">
                         <Column field="id" header="Id"></Column>
                         <Column field="descripcion" header="Descripcion"  ></Column>
                         <Column field="precio" header="Precio" ></Column>
                         <Column field="imagen" header="Imagen" ></Column>
                         <Column header="Acciones">
                         <template #body="slotProps">
                         <!-- Botón para editar producto que le pasaremos a la vista edit los datos a través de su id-->
                         <router-link
                                :to="{ name: 'producto.edit', params: { id: slotProps.data.id } }" class="btn btn-primary mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path fill="#ffffff"
                                        d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
                                </svg>
                            </router-link>
                            <!--Botón para eliminar producto-->
                           
                            <Button @click="confirm1($event,slotProps.data.id, slotProps.index)"  class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                    <path fill="#ffffff"
                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                </svg>
                            </Button>
                     
                         </template>
                         </Column>
                     </DataTable>
                </div>
            </div>
        </div>
    </div>
 </template>

 <script setup>
  import {ref, onMounted,inject} from "vue"
  const swal = inject('$swal')
  const producto=ref()

    onMounted(()=>{

    axios.get('/api/producto')
     .then(response =>{
       console.log(response);
       producto.value = response.data;
     })

})

       //Función eliminar producto
       const deleteProducto = (id, index) => {
       
       axios.delete(`/api/producto/${id}`)
           .then(response => {
               console.log("Producto eliminado:", response.data);
               // Mostrar index del array sin el dato eliminado
               producto.value.splice(index, 1);
               
           })
           .catch(error => {
               console.error("Error al eliminar el producto:", error);
           });
   };

   
       //Función para mensaje confirmación
       const confirm1 = (event,id,index) => {
        console.log(event);
        swal({
            title: 'Estás seguro??',
            text: 'No podrás revertir esta acción!',
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
                                title: 'Dato eliminado'
                            })
                    deleteProducto(id,index)
                }else{
                    swal({
                                icon: 'error',
                                title: 'Error al intentar eliminar el dato'
                            })
                }
            })

    };

</script>

<style>


</style>
