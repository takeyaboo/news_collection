<template>
    <div class="col-md-8 col-md-offset-2">
      <div v-for="data in datas">
        <b-list-group>
        <!-- <li v-for="data in datas"> -->
          <b-list-group-item v-bind:href="/news_list/ + data.id">{{ data.category_name }}
            <b-badge variant="primary" pill>{{ data.news_store_num }}件</b-badge>
          </b-list-group-item>
        <!-- </li> -->
        </b-list-group>
      </div>
      
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
          var url = '/ajax/news/1';
          axios.get(url).then(function(response){
              self.datas = response.data;
              // console.log()
          });
      }
  }
</script>
