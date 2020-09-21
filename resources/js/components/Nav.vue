<template>
  <div>
  <ul class="tabs" v-if="news_disp">
        <li v-on:click="change('1')" v-bind:class="{'active': isActive === '1'}"><a href="/news_vue/1">お気に入り別</a></li>
        <li v-on:click="change('2')" v-bind:class="{'active': isActive === '2'}"><a href="/news_vue/2">ニュース別</a></li>
        <li v-on:click="change('3')" v-bind:class="{'active': isActive === '3'}"><a href="/news_vue/4">集計履歴</a></li>
  </ul>

  <ul class="tabs" v-if="news_disp2">
        <li v-on:click="change('1')" v-bind:class="{'active': isActive === '1'}"><a href="/news_list/all/{{ this.category_id }}">新着順</a></li>
        <li v-on:click="change('2')" v-bind:class="{'active': isActive === '2'}"><a href="/news_list/all/{{ this.category_id }}/asc">古い順</a></li>
        <li v-on:click="change('3')" v-bind:class="{'active': isActive === '3'}"><a href="/news_list/all/{{ this.category_id }}/evaluation">評価順</a></li>
  </ul>

</div>
</template>

<script>
    export default {
      data () {
        return {
        news_disp: false,
        news_disp2: false,
        isActive: '1',
        category_id: '1',
        }
      },
      props: ['news_disp','news_disp2', 'category_id'],
      methods: {
        change: function(num){
          this.isActive = num
        }
      }
    }
</script>
<style>
ul{
    margin: 0;
    padding: 0;
  }
  li{
    list-style: none;
  }
  .tabs {
    overflow: hidden;
  }
  .tabs li,
  .tabs label {
    float: left;
    padding: 10px 20px;
    border: 1px solid #ccc;
    cursor: pointer;
    transition: .3s;
  }
  .tabs li:not(:first-child),
  .tabs label:not(:first-of-type) {
    border-left: none;
  }
  .tabs li.active,
  .tabs :checked + label {
    background-color: #000;
    border-color: #000;
    color: #fff;
    cursor: auto;
  }
  .contents{
    overflow: hidden;
    margin-top: -1px;
  }
  .contents li {
    width: 320px;
    padding: 20px;
    border: 1px solid #ccc;
  }

  .jquery .contents li{
    display: none;
  }
  .jquery .contents li.active {
    display: block;
  }

  .vue_radio input{
    display: none;
  }
</style>
