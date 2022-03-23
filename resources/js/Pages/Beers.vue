<template>
<h1>{{ brewery.name}} <inertia-link :href="route('dashboard')">[prev]</inertia-link></h1>
  <table>
    <thead>
      <tr>
        <th>Nome</th>
        <th>ABV</th>
      </tr>
    </thead>
    <tbody v-for="b in beers.data" :key="b.id">
      <tr>
        <td>{{ b.name }}</td>
        <td>{{ b.abv }}</td>
      </tr>
    </tbody>
    <pagination :data='beers'/>
  </table>
</template>

<script>
import pagination from '../Shared/pagination.vue';
export default {
  components: { pagination },
    name: 'Beers',
    props: {
        brewery: Object,
        beers: Object,
    },
};
</script>
