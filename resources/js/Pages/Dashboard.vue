<template>
  <form @submit.prevent="onSubmit">
    <input
      v-model="searchTerm"
      type="search"
      name="search"
      id="search"
      placeholder="search"
    />
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Cervejas</th>
        </tr>
      </thead>
      <tbody v-for="b in breweries.data" :key="b.id">
        <tr>
          <inertia-link :href="route('brewery.beers', { id: b.id })"
            ><td>{{ b.name }}</td>
          </inertia-link>
          <td>{{ b.beers_count }}</td>
        </tr>
      </tbody>
      <div v-if="!shouldHidePagination" >
        <pagination :data="breweries" />
      </div>
    </table>
  </form>
</template>

<script>
import pagination from "../Shared/pagination.vue";
export default {
  name: "BeerDashboard",
  components: { pagination },
  props: {
    breweries: Object,
  },
  data() {
    return {
      searchTerm: "",
    };
  },
  computed: {
    shouldHidePagination() {
      return !this.breweries.prev_page_url && !this.breweries.next_page_url;
    },
  },
  methods: {
    onSubmit() {
      this.$inertia.replace(
        this.route("dashboard", { search: this.searchTerm })
      );
    },
  },
};
</script>