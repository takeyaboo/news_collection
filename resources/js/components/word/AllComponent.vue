<template>
  <div class="col-md-8 col-md-offset-2">
      <li v-for="data in datas">
        {{ data.word }}
        出現回数({{ data.appear_num }})
        in {{ data.category_id }}
        <hr>
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
          var url = '/ajax/word/2';
          axios.get(url).then(function(response){
              self.datas = response.data;
              // console.log()
          });
      }
  }
</script>
