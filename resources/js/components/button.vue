<template>
  <div class="Page-Btn" v-on:click="scrollTop">
    TOP
  </div>
</template>

<script>
export default {
  methods: {
    scrollTop: function(){
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    }
  }
}
</script>
<style>
.Page-Btn{
  position: fixed;
  right: 14px;
  bottom: 14px;
  width: 4.5rem;
  height: 4.5rem;
  line-height: 4rem;
  text-align: center;
  border-radius: 50%;
  background: #5bc8ac;
}
.Page-Btn-Icon{
  color: #fff;
  font-size: 16px;
}
</style>
