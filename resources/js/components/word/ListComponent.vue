<template>
    <div class="col-md-8 col-md-offset-2">
      <b-list-group v-for="data in datas">
        <!-- <li v-for="data in datas"> -->
          <b-list-group-item v-bind:href="/word/ + data.id">{{ data.category_name }}
            <b-badge variant="primary" pill>{{ data.rel_word_num }}件</b-badge>
          </b-list-group-item>
        <!-- </li> -->
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
          var url = '/ajax/word/1';
          axios.get(url).then(function(response){
              self.datas = response.data;
              // console.log()
          });
      }
  }
</script>
