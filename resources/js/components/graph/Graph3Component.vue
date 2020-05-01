<template>
  <div>
    <h1>今日のTOP6</h1>
    <chart param="3"></chart>
    <top_button></top_button>
  </div>
</template>

<script>
import Chart from './Chart';

export default {
  components: {
    Chart,
  }
}
</script>
