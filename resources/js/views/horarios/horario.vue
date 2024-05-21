<template>
    <div class="schedule-table">
      <table>
        <thead>
          <tr>
            <th>Horario</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>10:00-11:00</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
          </tr>
          <tr>
            <td>16:30-17:30</td>
            <td></td>
            <td>Boxeo</td>
            <td></td>
            <td>Boxeo</td>
            <td></td>
          </tr>
          <tr>
            <td>17:30-18:30</td>
            <td></td>
            <td>Boxeo School Boys</td>
            <td></td>
            <td>Boxeo School Boys</td>
            <td>Boxeo</td>
          </tr>
          <tr>
            <td>18:30-19:30</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
          </tr>
          <tr>
            <td>20:30-21:30</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
            <td>Boxeo</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <AppFooter class="footer"/>
  </template>
  
  <script setup>
    import AppFooter from '../../layouts/AppFooter.vue';
  </script>
  
      <style scoped>
    .schedule-table {
      margin-top: 10%; /* Margen en la parte superior */
      width: 100%;
      overflow-x: auto; /* Agrega barras de desplazamiento horizontal en pantallas pequeñas */
    }

    .schedule-table table {
      width: 100%; /* Ancho de la tabla */
      border-collapse: collapse;
      color: black; /* Color del texto */
    }

    .schedule-table th,
    .schedule-table td {
      border: 1px solid black; /* Color de las líneas */
      padding: 10px; /* Ajusta el tamaño del padding */
      text-align: center;
    }

    .schedule-table th {
      background-color: black; /* Fondo negro para las celdas de encabezado */
      color: white; /* Color del texto del encabezado */
    }

    .footer {
      margin-top: 15%;
    }

    @media screen and (max-width: 768px) {
      .schedule-table table {
        width: auto; /* Ajusta el ancho automáticamente */
      }
    }
    </style>

  