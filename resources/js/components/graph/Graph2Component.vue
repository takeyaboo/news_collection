<template>
  <div>
    <h1>関連ワード保存数TOP6</h1>
    <chart param="2"></chart>
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
