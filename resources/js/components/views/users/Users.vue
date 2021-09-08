<template>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="users-container" v-if="this.users !== null">
                <h1>Gerer les Utilisateurs</h1>
                <DataTable 
                    :header-fields="headerFields"
                    :data="users"
                    :basePath="basePath"
                    />
            </div>
            <Loader v-else msg="ça arrive !.."/>
        </div>
    </div>
</template>

<script>
import Loader from '../../Loader.vue'
import DataTable from '../../DataTable'
export default {
    name: 'Users',
    components: {
        DataTable,
        Loader,
    },
    data: function() {
        return {
            headerFields:['#', 'Nom', 'Prénom','Pays', 'Email', 'address', 'Admin'],//Headers tab
            basePath: 'user',
            users : null,
            data: {
                "1": {
                    id: 1,
                    lastName: 'BitChest',
                    firstName: 'BitChest',
                    country: 'US',
                    email: 'test@gmail.com',
                    address: '123 Main St.',
                    admin: true,
                },
                "2": {
                    id: 2,
                    lastName: 'Test',
                    firstName: 'jose',
                    country: 'France',
                    email: 'tes@gmail.com',
                    address: '12 avenue de la republique',
                    admin: false,
                },
            },
        }
    },
    methods: {
        async loadUsers() {
            axios.get('/api/users').then(response => this.users = response.data);
        }
    },
    mounted() {
        this.loadUsers();
    },
}
</script>

<style>

</style>