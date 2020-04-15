<template>
  <div>
    <h1>ニュース保存数TOP6</h1>
    <!-- <button @click="submitOya">子から親へボタン1</button> -->
    <chart param="1"></chart>
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
