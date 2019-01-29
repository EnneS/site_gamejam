<template>
  <div class="row bg-dark pt-5 pb-5 text-white">
    <div class="container">
      <h1 class="mb-5">Tutoriel</h1>
      <div class="container mt-4" v-for="step in steps">
        <h2>{{ step.name }}</h2>
        <div v-html="step.description">  </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  metaInfo () {
      return { title: 'Tutoriel' }
  },

  data(){
    return{
        steps: [],
    }
  },

  mounted() {
    var _this = this;
    axios.get('/api/steps')
    .then(function(response){
      _this.steps = response.data;
    });
  }
}
</script>

<style lang="css">
</style>
