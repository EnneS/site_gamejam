<template>
  <div class="row bg-dark pt-5 pb-5 text-white">
    <div class="container">
      <h1 class="mb-5">Barême</h1>
      <div class="container mt-4">
         <object v-if="baremeExists" form="" type="application/pdf" width="100%" height="800px" data="/bareme/bareme.pdf"></object>
         <div v-else class="alert alert-info">
           Le barême n'a pas encore été ajouté.
         </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {

  data(){
    return {
      baremeExists: false,
    }
  },

  created(){
    axios.get('/bareme/bareme.pdf')
    .then((response) => {
      if (response.data[1] == 'P') this.baremeExists = true;
    })
  }
}
</script>

<style lang="css">
</style>
