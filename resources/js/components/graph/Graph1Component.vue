<template>
  <div>
    <h1>ニュース保存数TOP6</h1>
    <chart param="1"></chart>
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
