<template>
  <div class="row currency-container">
    <div class="col-md-6 offset-md-3">
      <div  v-if="this.currency !== null">
        <div class="card">
          <div class="card-body">
            <img :src="imgSrcGenerator(currency.name)" :alt="currency.name" width="30" height="30">
            <h2>{{currency.name}}</h2>
            <p>{{currency.code}}</p>
            <span>{{price}} €</span>
          </div>
        </div>
        <form @submit.prevent="buyCurrency()">
          <fieldset>
            <legend>Acheter du {{ this.currency.name}}</legend>
              <input type="number" id="quantity" name="quantity" v-model="quantity">
              <span> {{getPriceToBuy()}} &euro;</span>
          </fieldset>
          <button class="btn-submit" type="submit" v-if="this.quantity >= 0">Acheter</button>
        </form>
      </div>
      <Loader v-else msg="ça arrive !.."/>
    </div>
  </div>
</template>

<script>
import Loader from '../Loader.vue'
import axiosInstance from "../utils/AxiosTokenInstance";
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
      axiosInstance.get(this.url)
      .then(response => {
        this.currency = response.data;
        this.price = this.currency.prices[0].value;
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
      return lastPrice.toFixed(2) * this.quantity;
    },
    buyCurrency() {
        let body = {'currency_id': this.currency.id, 'amount': this.quantity};
        axiosInstance.post('/api/buyCurrency', body)
            .then(response => {
                console.log(response.status);
                console.log(response.data);
            })
            .catch(err => {console.log(err)});
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
