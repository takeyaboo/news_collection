<template>
    <div class="col-md-8 col-md-offset-2">
      <b-list-group v-for="data in getItems">
          <b-list-group-item v-bind:href="/word/ + data.id">{{ data.category_name }}
            <b-badge variant="primary" pill>{{ data.rel_word_num }}件</b-badge>
          </b-list-group-item>
      </b-list-group>
      <div class="mt-5">
        <paginate
          :pageCount="getPageCount"
          :containerClass="'pagination'"
          :page-class="'page-item'"
          :page-link-class="'page-link'"
          :prev-class="'page-item'"
          :prev-link-class="'page-link'"
          :next-class="'page-item'"
          :next-link-class="'page-link'"
          :clickHandler="clickCallback">
         </paginate>
     </div>
     <top_button></top_button>
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
           var url = '/ajax/word/1';
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
          // var self = this;
          // var url = '/ajax/word/1';
          // axios.get(url).then(function(response){
          //     self.datas = response.data;
          //     // console.log()
          // });
      }
  }
</script>
