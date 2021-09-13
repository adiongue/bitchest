<template>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="currencies-container" v-if="this.transactions !== null">
                <DataTable
                    :header-fields="headerFields"
                    :data="transactions"
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
    name: 'Transactions',
    components: {
        DataTable,
        Loader,
    },
    data: function() {
        return {
            headerFields:['Name', 'Code', 'Type', 'Quantité', 'Prix (€)','Date'],
            basePath: 'transactions',
            transactions : [],
        }
    },
    methods: {
        async loadTransactions() {
            axiosInstance.get('/api/transactions')
                .then(response => {
                    this.transactions = response.data;
                })
                .catch(error => {
                    console.log(error)
                });;
        },
    },
    mounted() {
        this.loadTransactions();
    },

}
</script>

<style>

</style>
