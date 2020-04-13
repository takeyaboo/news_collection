<template>
    <div class="col-md-8 col-md-offset-2">
        <li v-for="data in datas">
          {{ data.create_num }}件
          <br>
          {{ data.created_at }}
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
          var url = '/ajax/news/4';
          axios.get(url).then(function(response){
              self.datas = response.data;
              // console.log()
          });
      }
  }
</script>
