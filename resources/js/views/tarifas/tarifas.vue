<template>
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
  </template>
  
  <script setup>
  </script>
  
  <style scoped>
  .card-container {
    display: flex;
    gap: 40px; /* Espacio entre las tarjetas */
    justify-content: center; /* Centrar horizontalmente */
    margin-top: 100px; /* Margen en la parte superior */
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
  
  body {
    background-color: black; /* Fondo de la página negro */
  }
  </style>
  
