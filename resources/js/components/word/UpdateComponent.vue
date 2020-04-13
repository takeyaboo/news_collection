<template>
  <div class="col-md-8 col-md-offset-2">
      <li v-for="data in datas">
        <a v-bind:href="/news_list/ + data.id">{{ data.category_name }}</a>
        ({{ data.rel_word_num }})
      </li>
  </div>
</template>
<script>
  export default {
      data() {
          return {
              datas: {}
          }
      },
      mounted() {
          var self = this;
          var url = '/ajax/word/4';
          axios.get(url).then(function(response){
              self.datas = response.data;
              // console.log()
          });
      }
  }
</script>
