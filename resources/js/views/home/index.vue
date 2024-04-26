<template>
  <div class="bg-color">
    <div class="imagen-portada">
      <img src="images/portada_boxeo2.webp" alt="imagen portada" class="img-fluid" />
    </div>

    <div>
      <h3 class="titulo-tarifas">TARIFAS</h3>
    </div>
    <section class="tarifas">
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

    <div class="titulo-clases">
      <h3 style="color: white;">NUESTRAS CLASES</h3>
    </div>

    <section class="clases">
      <div class="card-clase">
        <Galleria :value="images" :responsiveOptions="responsiveOptions" :numVisible="5"
          containerStyle="max-width: 640px">
          <template #item="slotProps">
            <img :src="slotProps.item.itemImageSrc" :alt="slotProps.item.alt" style="width: 100%" />
          </template>

        </Galleria>
      </div>
    </section>

   

  </div>
  <AppFooter />
</template>

<script setup>
import AppFooter from '../../layouts/AppFooter.vue';

import { ref, onMounted } from 'vue';

const images = ref([
  {
    itemImageSrc: 'images/imgclases/1.jpg',
    alt: 'Description for Image 1',
    title: 'Title 1',
  },
  {
    itemImageSrc: 'images/imgclases/2.jpg',
    alt: 'Description for Image 2',
    title: 'Title 2',
  },
  {
    itemImageSrc: 'images/imgclases/3.jpg',
    alt: 'Description for Image 3',
    title: 'Title 3',
  },
  {
    itemImageSrc: 'images/imgclases/4.jpg',
    alt: 'Description for Image 4',
    title: 'Title 4',
  },
  {
    itemImageSrc: 'images/imgclases/5.jpg',
    alt: 'Description for Image 5',
    title: 'Title 5',
  },
  {
    itemImageSrc: 'images/imgclases/6.jpg',
    alt: 'Description for Image 6',
    title: 'Title 6',
  },
  {
    itemImageSrc: 'images/imgclases/7.jpg',
    alt: 'Description for Image 7',
    title: 'Title 7',
  },
  {
    itemImageSrc: 'images/imgclases/8.jpg',
    alt: 'Description for Image 8',
    title: 'Title 8',
  },
  {
    itemImageSrc: 'images/imgclases/9.jpg',
    alt: 'Description for Image 9',
    title: 'Title 9',
  },
  {
    itemImageSrc: 'images/imgclases/10.jpg',
    alt: 'Description for Image 10',
    title: 'Title 10',
  },
]);

const responsiveOptions = ref([
  {
    breakpoint: '1300px',
    numVisible: 4,
  },
  {
    breakpoint: '575px',
    numVisible: 1,
  },
]);

</script>

<style scoped>
.card-container {
  flex-wrap: wrap;
  /*Hace que las tarifas se vean una debajo de otra cuando el tamaño de la pantalla se reduce a tamaño de teléfono móvil*/
  display: flex;
  /*El contenedor se comporta como un bloque, es decir, ocupa todo el espacio horizontal disponible*/
  gap: 40px;
  /* Espacio entre las tarjetas */
  justify-content: center;
  /* Centrar horizontalmente */
  margin-top: 20px;
  /* Margen en la parte superior */
  margin-bottom: 50px;
  /*margen parte inferiro*/
  position: relative;
  display: inline-block;
  transition: transform 0.3s ease;
  border: 1px solid black;
}

.card-container:hover {
  transform: scale(1.1);
  /* Ajusta el valor según lo grande que quieras que se vuelva */
}

.card-container:hover .card {
  box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
  /* Opcional: añadir una sombra al hacer hover */
}

.card {
  width: 25rem;
  overflow: hidden;
}

.card-header {
  background-color: black;
  padding: 20px;
}


.card-logo {
  display: block;
  margin: 0 auto;
  /* Centrar horizontalmente */
  max-width: 100%;
  /* Asegurar que la imagen no sobrepase el ancho del contenedor */
  height: auto;
  /* Mantener la relación de aspecto */
  object-fit: contain;
  /* Ajustar la imagen dentro del contenedor sin distorsionar */
}

/* Color del texto dentro de las tarjetas */
.bg-color {
  background-color: black !important
}

.tarifas {
  flex-wrap: wrap;
  /*Hace que las tarifas se vean una debajo de otra cuando el tamaño de la pantalla se reduce a tamaño de teléfono móvil*/
  display: flex;
  /*El contenedor se comporta como un bloque, es decir, ocupa todo el espacio horizontal disponible*/
  gap: 40px;
  /* Espacio entre las tarjetas */
  justify-content: center;
  /* Centrar horizontalmente */
  background-color: white;
}

.titulo-tarifas {
  color: white;
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;
  background-color: black;
}


.titulo-clases {
  color: white;
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;
  background-color: black;
}

.clases {
  justify-content: center;
  display: flex;
  background-color: black;

}

.card-clase {
  background-color: black;
  margin-top: 20px;
  margin-bottom: 20px;
  width: 600px;
  justify-content: center;
}
</style>
