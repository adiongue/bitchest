<template>
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="currencies-container" v-if="this.currencies !== null">
        <DataTable
          :header-fields="headerFields"
          :data="currencies"
          :basePath="basePath"
          :showId="false"
          imgExtention="png"
        />
      </div>
      <Loader v-else msg="ça arrive !.."/>
    </div>
  </div>
</template>

<script>
import DataTable from '../DataTable'
import Loader from '../Loader.vue'
import axiosInstance from "../utils/AxiosTokenInstance";
export default {
  name: '',
  components: {
    DataTable,
    Loader,
  },
  data: function() {
    return {
      headerFields:['Nom', 'Code','Prix (€)'],//Headers tab
      basePath: 'currency',
      currencies : [],
    }
  },
  methods: {
    async loadCurrencies() {
        axiosInstance.get('/api/currencies')
            .then(response => {
                this.currencies = response.data.filter((currency) => delete currency.price_date);
            })
            .catch(error => {
                console.log(error)
            });;
    },
  },
  mounted() {
    this.loadCurrencies();
  },

}
</script>

<style>

</style>
