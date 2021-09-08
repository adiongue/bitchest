<template>
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="currencies-container" v-if="this.currencies !== null">
        <DataTable 
          :header-fields="headerFields"
          :data="currencies"
          :basePath="basePath"
          img="png"
        />
      </div>
      <Loader v-else msg="ça arrive !.."/>
    </div>
  </div>
</template>

<script>
import DataTable from '../DataTable'
import Loader from '../Loader.vue'
export default {
  name: '',
  components: {
    DataTable,
    Loader,
  },
  data: function() {
    return {
      headerFields:['Nom', 'Code','Prix ($)'],//Headers tab
      basePath: 'currencies',
      currencies : {
        0:{
          id: 0,
          name:'Bitcoin',
          code: 'BTC',
          price: 40000.086
        },
        1:{
          id: 1,
          name:'Ethereum',
          code: 'ETH',
          price: 20000.56
        },
        2:{
          id: 2,
          name:'Ripple',
          code: 'XRP',
          price: 10000.086
        },
        3:{
          id: 3,
          name:'BitcoinCash',
          code: 'BCH',
          price: 40.78
        },
        4:{
          id: 4,
          name:'Cardano',
          code: 'ADA',
          price: 0.98
        },
      },
    }
  },
  methods: {
    async loadCurrencies() {
      axios.get('/api/currencies').then(response => this.currencies = response.data);
    },

  }

}
</script>

<style>

</style>