<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade un nuevo producto</h5>
            </div>
 
              

               <!--Enviar form a script-->
            <form @submit.prevent="addProducto">
                
                <div class="form-group mb-2">
                    <label>Id:</label><span class="text-danger"> </span>
                    <textarea v-model="producto.id" class="form-control" type="text" placeholder="id"></textarea>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>Descripcion:</label><span class="text-danger"></span>
                    <input v-model="producto.descripcion" class="form-control" type="text" name="descripción"/>
                </div>

                <div class="form-group mb-2">
                    <label>Precio:</label><span class="text-danger"> </span>
                    <textarea v-model="producto.precio" class="form-control" type="text" placeholder="precio"></textarea>
                </div>
 
 
                <div class="form-gorup mb-2">
                    <label>imagen:</label><span class="text-danger"></span>
                    <input v-model="producto.imagen" class="form-control" type="text" name="imagen"/>
                </div>
 
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir producto</button>
 
 
            </form>
 
        </div>
    </div>
 </template>
