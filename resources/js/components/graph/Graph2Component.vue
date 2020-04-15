<template>
  <div>
    <h1>関連ワード保存数TOP6</h1>
    <!-- <button @click="submitOya">子から親へボタン1</button> -->
    <chart param="2"></chart>
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
