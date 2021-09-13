<template>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h2>Fond</h2>
                    <p>{{fund}} €</p>
                </div>
            </div>
            <div class="currencies-container" v-if="this.currencies !== null">
                <DataTable
                    :header-fields="headerFields"
                    :data="currencies"
                    :basePath="basePath"
                    :showId="false"
                    imgExtention="png"
                    :sell-currency="sellCurrency"
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
            headerFields:['Nom', 'Code','quantité', 'prix', 'action'],//Headers tab
            basePath: 'wallet',
            currencies : [],
            fund: 0,
        }
    },
    methods: {
        async loadCurrencies() {
            axiosInstance.get('/api/userCurrencies')
                .then(response => {
                    this.currencies = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
            axiosInstance.get('/api/userInfo')
                .then(response => {
                    this.fund = response.data.fund.toFixed(2);
                })
                .catch(error => {
                    console.log(error)
                });
        },
        sellCurrency(currencyId) {
            console.log(currencyId);
            axiosInstance.post('/api/sellCurrency', {"currency_id": currencyId})
                .then(response => {
                    console.log(response.status);
                    console.log(response.data);
                })
                .catch(err => {console.log(err)});
            axiosInstance.get('/api/userCurrencies')
                .then(response => {
                    this.currencies = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
            axiosInstance.get('/api/userInfo')
                .then(response => {
                    this.fund = response.data.fund.toFixed(2);
                })
                .catch(error => {
                    console.log(error)
                });
        }
    },
    mounted() {
        // this.fund = JSON.parse(localStorage.getItem('userData'))['fund']
        this.loadCurrencies();
    },

}
</script>

<style>

</style>
