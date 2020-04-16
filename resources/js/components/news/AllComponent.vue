<template>
    <div class="col-md-8 col-md-offset-2">
      <b-list-group v-for="data in datas" >
        <!-- <li v-for="data in datas"> -->
          <b-list-group-item v-bind:href="data.link">{{ data.title }}</b-list-group-item>
        <!-- </li> -->
      </b-list-group>
    </div>
</template>

<script>
  export default {
      data() {
          return {
              perPage: 3,
              currentPage: 1,
              datas: {}
          }
      },
      mounted() {
          var self = this;
          var url = '/ajax/news/2';
          axios.get(url).then(function(response){
              self.datas = response.data;
              // console.log()
          });
      }
  }
</script>
