<template>
  <form @submit.prevent="onSubmit">
    <input
      v-model="searchTermInf"
      type="searchInf"
      name="searchInf"
      id="searchInf"
      placeholder="searchInf"
    />
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Cervejas</th>
        </tr>
      </thead>
      <tbody v-for="b in userBreweries.data" :key="b.id">
        <tr>
          <inertia-link :href="route('brewery.beers', { id: b.id })"
            ><td>{{ b.name }}</td>
          </inertia-link>
          <td>{{ b.beers_count }}</td>
        </tr>
      </tbody>
    </table>
  </form>
</template>

<script>
import _ from "lodash";
_.debounce = _.debounce || function () {};
export default {
  name: "InfiniteScroll",

  props: {
    breweries: Object,
  },
  data() {
    return {
      searchTermInf: "",
      userBreweries: this.breweries,
    };
  },
  mounted() {
    window.addEventListener(
      "scroll",
      _.debounce((e) => {
        let pixelsFromBottom =
          document.documentElement.offsetHeight -
          document.documentElement.scrollTop -
          window.innerHeight;

        if (pixelsFromBottom < 200) {
          axios.get(this.userBreweries.next_page_url).then((response) => {
            this.userBreweries = {
              ...response.data,
              data: [...this.userBreweries.data, ...response.data.data],
            };
          });
        }
      }, 100)
    );
  },
  methods: {
    onSubmit() {
      this.$inertia.replace(
        this.route("infinitescroll", { search: this.searchTermInf })
      );
    },
  },
};
</script>