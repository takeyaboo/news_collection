<template>
  <div>
    <Load v-show="loading"></Load>
  </div>
</template>

<script>
import Load from './Loadtemplate';
export default {
  data() {
    return {
      loading: true,
    }
  },
  mounted() {
    setTimeout(() => {
      this.loading = false;
    }, 1000);
  },
  components: {
    Load,
  }
}
</script>
