<template>
    <div class="col-md-8 col-md-offset-2">
      <b-list-group v-for="data in getItems" >
        <!-- <li v-for="data in datas"> -->
          <b-list-group-item v-bind:href="data.link">{{ data.title }}({{ data.created_at }})オススメ度:{{ data.relativity }}</b-list-group-item>
        <!-- </li> -->
      </b-list-group>
      <!-- <vue-loading></vue-loading> -->
      <!-- <vue-pagination></vue-pagination> -->
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
    </div>
</template>

<script>
  export default {
      data() {
          return {
              datas: [],
              parPage: 50,
              currentPage: 1,
          }
      },
      methods: {
        clickCallback: function (pageNum) {
           this.currentPage = Number(pageNum);
        }
      },
       computed: {
         getItems: function() {
           var self = this;
           var url = '/ajax/news/2';
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
          // var url = '/ajax/news/2';
          // axios.get(url).then(function(response){
          //     self.datas = response.data;
          //     // console.log()
          // });
      }
  }
</script>
