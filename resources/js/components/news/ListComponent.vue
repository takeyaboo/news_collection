<template>
    <div class="col-md-8 col-md-offset-2">
      <div v-for="data in getItems">
        <b-list-group>
        <!-- <li v-for="data in datas"> -->
          <b-list-group-item v-bind:href="/news_list/ + data.id">{{ data.category_name }}
            <b-badge variant="primary" pill>{{ data.news_store_num }}件</b-badge>
          </b-list-group-item>
        <!-- </li> -->
        </b-list-group>
      </div>
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
          var url = '/ajax/news/1';
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
          // var url = '/ajax/news/1';
          // axios.get(url).then(function(response){
          //     self.datas = response.data;
          //     // console.log()
          // });
      }
  }
</script>
