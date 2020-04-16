<template>
  <div class="col-md-8 col-md-offset-2">
    <b-list-group v-for="data in datas">
      <!-- <li v-for="data in datas"> -->
        <b-list-group-item>{{ data.word }}
          <b-badge variant="primary" pill>出現回数({{ data.appear_num }})</b-badge>
          in {{ data.category_id }}
        </b-list-group-item>
    </b-list-group>

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
