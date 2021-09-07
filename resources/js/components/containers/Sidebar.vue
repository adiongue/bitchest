<template>
    <div class="sidebar-container">
        <nav class="sidebar">
            <a href="/"  id="logo"><img v-if="siteLogo" :src="siteLogo" alt="app logo" width="120" height="37"></a>
            <div class="sidebar-inner">
                <ul class="nav">
                    <li  class="nav-item" v-for="item in items" :key="item.text">
                        <router-link :to="item.href">{{ item.text }}</router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <button id="toggleButton" @click="toggleReducer()">reduire</button>
    </div>
</template>

<script>
    export default {
        name: 'Sidebar',
        props: {
            siteName: String,
            siteLogo: String,
        },
        data: function() {
            return {
                items: [
                    {
                        text: 'Accue',
                        href: '/'
                    },
                    {
                        text: 'Utilisateurs',
                        href: '/users'
                    },
                    {
                        text: 'Marchés',
                        href: '/store'
                    },
                    {
                        text: 'Portefeuille',
                        href: '/wallet'
                    },
                    {
                        text: 'Paramètres',
                        href: '/settings'
                    },
                    {
                        text: 'About',
                        href: '/about'
                    },
                    {
                        text: 'Login',
                        href: '/login'
                    },
                ]
            }
        },
        methods: {
            toggleReducer: function() {
                document.querySelector('.sidebar').classList.toggle('reduced');

                if(document.querySelector('#toggleButton').innerHTML == 'reduire') {
                    document.querySelector('#toggleButton').innerHTML = "agrandir";
                } else {
                    document.querySelector('#toggleButton').innerHTML = "reduire";
                }
                document.querySelector('#toggleButton').classList.toggle('btn-reduced');
                document.querySelector('.sidebar-container').classList.toggle('container-reduced');
            },
            isActive: function(item) {
                return $router.isActive(item.href)
            }
        }
    }
</script>
<style scoped>

    .router-link-exact-active {
        color: #00b7ff;
        text-decoration: underline;
    }

    #logo {

        background-color: #3c4b84;
        flex-grow: 1;
        padding: 1em 1em 0 1em ;
    }

    .sidebar-container {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 15%;
        text-align: center;
    }
    .sidebar {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        background-color: #3c4b64;
        height: 98vh;
        color: #fff;
    }
    div .sidebar-inner {
        flex-grow: 30;
    }
    div .sidebar-inner ul {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 0;
        margin: 0;
    }
    div .sidebar-inner ul li {
        box-sizing: border-box;
        width: 100%;
        height: 100%;
        list-style: none;
        text-align: center;
        padding: 1em 0 1em 0;
    }
    div .sidebar-inner ul li a{
        display: block;
        box-sizing: border-box;
        width: 100%;
        height: 100%;
        padding: 5px 0 5px 0;

    }

    .nav-item:hover {
        background-color: #4c5f80;
    }

    nav button {
        width: 100%;
        height: 2em;
        cursor: pointer;
    }
    .reduced {
        display: none;
    }
    .btn-reduced {
        display: block;
        float: left;
    }
    .container-reduced {
        width: 5%;
    }

</style>
