<template>
  <main>
      <h1>Gerer les Utilisateurs</h1>
      <DataTable
        :header-fields="headerFields"
        :data="data"
        :basePath="basePath"
        />
  </main>
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
            headerFields:['#', 'Nom', 'Prénom','Pays', 'Email', 'address', 'Admin'],
            basePath: 'users',
            data: {
                "1": {
                    id: 1,
                    name: 'BitChest',
                    firstName: 'BitChest',
                    country: 'US',
                    email: 'test@gmail.com',
                    address: '123 Main St.',
                    admin: true,
                },
                "2": {
                    id: 2,
                    name: 'Test',
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
            axios.get('./api/user').then(response => this.users = response.data);
        }
    },
    mounted() {
        this.loadUsers();
    },
}
</script>

<style>

</style>