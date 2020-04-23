<template>
    <div class="col-md-8 col-md-offset-2">
      <b-list-group v-for="data in getItems">
        <!-- <li v-for="data in datas"> -->
        <b-list-group-item>{{ data.word_create_num }}件<br>
          {{ data.created_at }}</b-list-group-item>
          <!-- <hr> -->
        <!-- </li> -->
      </b-list-group>
      <paginate
        :page-count="getPageCount"
        :page-range="3"
        :margin-pages="2"
        :click-handler="clickCallback"
        :prev-text="'＜'"
        :next-text="'＞'"
        :container-class="'pagination'"
        :page-class="'page-item'">
      </paginate>
    </div>
</template>

<script>
import Paginate from 'vuejs-paginate';

  export default {
      data() {
          return {
              datas: [],
              parPage: 10,
              currentPage: 1,
          }
      },
      components: {
        Paginate,
      },
      methods: {
        clickCallback: function (pageNum) {
           this.currentPage = Number(pageNum);
        }
      },
       computed: {
         getItems: function() {
           var self = this;
           var url = '/ajax/word/4';
           axios.get(url).then(function(response){
               self.datas = response.data;
               // console.log()
           });

          var current = this.currentPage * this.parPage;
          var start = current - this.parPage;
          return this.datas.slice(start, current);

         },
         getPageCount: function() {
          return Math.ceil(this.datas.length / this.parPage);
         }
       },
      mounted() {
      //     var self = this;
      //     var url = '/ajax/word/4';
      //     axios.get(url).then(function(response){
      //         self.datas = response.data;
      //         // console.log()
      //     });
      }
  }
</script>
