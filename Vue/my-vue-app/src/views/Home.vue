<template>
  <div class="container mt-5 w-50">
    <h1 class="text-center">Enlaces a los Frameworks</h1>
    <ul class="list-group">
      <li v-for="link in frameworks" :key="link.name" class="list-group-item list-group-item-action list-group-item-light">
        <a :href="resolveLink(link.url)" v-if="isExternalLink(link.url)">{{ link.name }}</a>
        <router-link :to="link.url" v-else>{{ link.name }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import config from '../../config';

export default {
  name: 'HomeView',

  data() {
    return {
      frameworks: [
        { name: 'React', url: `${config.apiUrl}:${config.reactPort}/react` },
        { name: 'Angular', url: `${config.apiUrl}:${config.angularPort}/angular` },
        { name: 'Vue', url: '/vue' },
        { name: 'Laravel', url: 'https://laravel.com' }
      ]
    };
  },
  methods: {
    isExternalLink(url) {
      return url.startsWith('http://') || url.startsWith('https://');
    },
    resolveLink(url) {
      // Optional: Add any additional logic to resolve links
      return url;
    }
  }
};
</script>

<style>
/* Aquí puedes añadir estilos si es necesario */
</style>
