<template>
  <nav aria-label="navigation">
    <ul class="pagination pagination-primary">
      <li
        class="page-item"
        :class="[
          link.url === null ? 'disabled' : '',
          link.active ? 'active' : '',
        ]"
        v-for="(link, index) in links"
        :key="index"
      >
        <Link
          class="page-link"
          :href="link.url === null ? '#' : link.url"
          v-html="link.label"
        >
        </Link>
      </li>
    </ul>
  </nav>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },

  props: ["links"],
};
</script>
