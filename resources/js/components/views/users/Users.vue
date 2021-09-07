<template>
  <div class="users-container">
      <h1>Gerer les Utilisateurs</h1>
      <DataTable
        :header-fields="headerFields"
        :data="users"
        :basePath="basePath"
        />
  </div>
</template>

<script>
import DataTable from '../../DataTable'
export default {
    name: 'Users',
    components: {
        DataTable,
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
        loadUsers() {
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