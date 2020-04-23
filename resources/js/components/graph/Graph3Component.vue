<template>
  <div>
    <h1>今日のTOP6</h1>
    <!-- <button @click="submitOya">子から親へボタン1</button> -->
    <chart param="3"></chart>

    <!-- <Home v-show="!loading"></Home> -->

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
