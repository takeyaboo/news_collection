<template>
    <div>
      <transition>
        <div
        class="flash"
        v-show="msg"
        >
          評価を{{ rating2 }}に更新しました。
        </div>
      </transition>
      <div>お気に入り度
        <heart-rating item-size="10" @rating-selected="rating2 = $event" :rating="rating2"></heart-rating>
        <b-button size="sm" variant="outline-primary" v-on:click="evaluate">{{ rating2 }}評価する</b-button>
      </div>
    </div>
</template>

<script>
// import {StarRating} from 'vue-rate-it';
import {HeartRating} from 'vue-rate-it';
export default {
  data () {
    return {
     // rating: this.rate,
     rating2: this.rate2,
     msg: false,
    }
  },
  props: ['rate2','news_id'],
  components: {
    // StarRating,
    HeartRating
  },
  methods: {
    evaluate: function (event) {
      let url = '/ajax/news/' + this.news_id + '/' + this.rating2;
      axios.get(url).then(function(response){
          this.rating2 = response.data;
          // console.log()
      })
      .catch(error => {
        console.log(error.response)
      });
      this.msg = true;
      setTimeout(() => {
        this.msg = false}
        ,3000
      )
    }
  }
}
</script>
<style>
.flash {
  width: 200px;
  height: auto;
}
.v-enter {
  opacity: 0;
}
.v-enter-active {
  transition: opacity 1s
}

.v-leave-active {
  transition: opacity 1s
}
.v-leave-to {
  opacity: 0;
}
</style>
