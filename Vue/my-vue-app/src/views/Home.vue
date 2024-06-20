<template>
  <div class="container text-center mt-5">
    <h1>Bienvenido</h1>
    <p>Seleccione una opción de frontend:</p>
    <router-link to="/vue" class="btn btn-primary m-2">Vue.js</router-link>
    <router-link to="/laravel" class="btn btn-secondary m-2">Laravel</router-link>
  </div>
</template>

<script>
export default {
  name: 'HomeView'
};
</script>

<style>
.container {
  max-width: 500px;
}
</style>
