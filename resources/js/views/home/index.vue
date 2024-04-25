<template>
    <!--<div class="relative items-top justify-center min-h-screen bg-gray-900 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">-->
    <!--<div class="items-top justify-center min-h-screen bg-gray-900 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">-->
    <div class="items-top justify-center min-h-screen bg-gray-900 dark:bg-gray-900 sm:items-center sm:pt-0">
        <img src="images/portada_boxeo.webp" alt="background" class="background-image"/>
        <br>
        <div>
            <h3 id="titulo-section">TARIFAS</h3>
        </div>
        <section id="tarifas">
        
        
    <div class="card-container">
      <Card style="width: 25rem; overflow: hidden">
        <template #header>
          <div class="card-header">
            <img class="card-logo" alt="logo" src="images/logo_redondo.png" />
          </div>
        </template>
        <template #title>Boxeo Adulto</template>
        <template #subtitle>55 €</template>
        <template #content>
          <p class="m-0">
            Posibilidad de participar en todas las clases para adultos que se realicen en el gimnasio
          </p>
        </template>
        <template #footer>
          <div>Coste de matrícula: 60€</div>
        </template>
      </Card>
     </div>

     <div class="card-container">
        <Card style="width: 25rem; overflow: hidden">
        <template #header>
          <div class="card-header">
            <img class="card-logo" alt="logo" src="images/logo_redondo.png" />
          </div>
        </template>
        <template #title>Boxeo Infantil</template>
        <template #subtitle>45 €</template>
        <template #content>
          <p class="m-0">
            Posibilidad de participar en todas las clases para menores que se realicen en el gimnasio
          </p>
        </template>
        <template #footer>
          <div>Coste de matrícula: 60€</div>
        </template>
      </Card>
     </div>
        </section>
        <AppFooter />
       
    </div>
</template>

<script setup>
import AppFooter from '../../layouts/AppFooter.vue';
</script>

<style scoped>
body {
    font-family: 'Nunito', sans-serif;
}

.background-image{
    width: 100%;
    object-fit: contain;
}

.card-container {
    flex-wrap: wrap; /*Hace que las tarifas se vean una debajo de otra cuando el tamaño de la pantalla se reduce a tamaño de teléfono móvil*/
    display: flex; /*El contenedor se comporta como un bloque, es decir, ocupa todo el espacio horizontal disponible*/
    gap: 40px; /* Espacio entre las tarjetas */
    justify-content: center; /* Centrar horizontalmente */
    margin-top: 20px; /* Margen en la parte superior */
    margin-bottom: 50px; /*margen parte inferiro*/
  }
  
  .card-header {
    background-color: black; /* Fondo negro para la cabecera */
    padding: 20px; /* Espaciado interior */
  }
  
    
  .card-logo {
    display: block;
    margin: 0 auto; /* Centrar horizontalmente */
    max-width: 100%; /* Asegurar que la imagen no sobrepase el ancho del contenedor */
    height: auto; /* Mantener la relación de aspecto */
    object-fit: contain; /* Ajustar la imagen dentro del contenedor sin distorsionar */
  }

  /* Color del texto dentro de las tarjetas */
  .card-container .p,
  .card-container div {
    color: black;
  }

  #tarifas {
    flex-wrap: wrap; /*Hace que las tarifas se vean una debajo de otra cuando el tamaño de la pantalla se reduce a tamaño de teléfono móvil*/
    display: flex; /*El contenedor se comporta como un bloque, es decir, ocupa todo el espacio horizontal disponible*/
    gap: 40px; /* Espacio entre las tarjetas */
    justify-content: center; /* Centrar horizontalmente */
  }

  #titulo-section {
    color: white;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .card-container .Card:hover {
    transform: scale(1.05); /* Aumenta ligeramente la escala */
}

  
 
</style>
