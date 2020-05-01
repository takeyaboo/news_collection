<template>
    <div>
      <star-rating item-size="10" read-only=1 @rating-selected="rating = $event" :rating="rating"></star-rating>
      <div>お気に入り度
        <heart-rating item-size="10" @rating-selected="rating2 = $event" :rating="rating2"></heart-rating>
        <b-button size="sm" variant="outline-primary" v-on:click="evaluate">{{ rating2 }}評価する</b-button>
      </div>
    </div>
</template>

<script>
import {StarRating} from 'vue-rate-it';
import {HeartRating} from 'vue-rate-it';
export default {
  data () {
    return {
     rating: this.rate,
     rating2: this.rate2,
    }
  },
  props: ['rate','rate2','news_id'],
  components: {
    StarRating,
    HeartRating
  },
  methods: {
    evaluate: function (event) {
      var url = '/ajax/news/' + this.news_id + '/' + this.rating2;
      axios.get(url).then(function(response){
          this.rating2 = response.data;
          // console.log()
      })
      .catch(error => {
        console.log(error.response)
      });
    }
  }
}
</script>
