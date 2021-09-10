<template>
  <div class="row currency-container">
    <div class="col-md-6 offset-md-3">
      <div  v-if="this.currency !== null">
        <div class="card">
          <div class="card-body">
            <img :src="imgSrcGenerator(currency.name)" :alt="currency.name" width="30" height="30">
            <h2>{{currency.name}}</h2>
            <p>{{currency.code}}</p>
          </div>
        </div>
        <form action="" method="get">
          <fieldset>
            <legend>Acheter du {{ this.currency.name}}</legend>
              <input type="number" id="quantity" name="quantity" v-model="quantity">
              <span>{{getPriceToBuy()}} &euro;</span>
          </fieldset>
          <button class="btn-submit" type="submit">Acheter</button>
        </form>
      </div>
      <Loader v-else msg="ça arrive !.."/>
    </div>
  </div>
</template>

<script>
import Loader from '../Loader.vue'
export default {
  components:{
    Loader
  },
  data: function() {
    return {
      currency : null,
      transaction : null,
      quantity: 0,
      price: null,
      url : `/api/currency/${this.$route.params.id}`,
      errors: [],
      error: '',
    }
  },
  methods:{
    async loadCurrency() {
      axios.get(this.url)
      .then(response => {
        this.currency = response.data;
      })
      .catch(err => {console.log(err)});
    },
    imgSrcGenerator(name) { 
      let imgName = name.replace(" ", "").toLowerCase(); 
      let src = `../../assets/${imgName}.png`;
      return src;
    },
    getPriceToBuy() {
      let lastPrice = this.currency.prices[0].value;
      return lastPrice * this.quantity;
    }
  },
  mounted(){
    this.loadCurrency();
  },
}
</script>

<style>
  .currency-container{
    margin-top: 3em;
  }
  .card {
    margin-bottom: 2em;
  }
  .btn-submit {
    margin-top: 2em;
  }
</style>