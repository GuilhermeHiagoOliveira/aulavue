<template>
  <nav>
    <inertia-link v-if="data.prev_page_url" :href="data.prev_page_url"
      >Prev</inertia-link
    >
    <inertia-link v-for="link in cleanLinks" :key="link.label" :href="link.url">
      {{ link.label }}
    </inertia-link>
    <inertia-link v-if="data.next_page_url" :href="data.next_page_url"
      >Next</inertia-link
    >
  </nav>
</template>

<script>
export default {
  name: "Pagination",
  props: {
    data: Object,
  },
  computed: {
    cleanLinks() {
      const cleanLinks = [...this.data.links];
      cleanLinks.shift();
      cleanLinks.pop();
      return cleanLinks;
    },
  },
};
</script>
