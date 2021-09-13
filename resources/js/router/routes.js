const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "about" */ '../components/views/Home.vue')
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../components/views/About.vue')
  },
  {
    path: '/settings',
    name: 'Settings',
    component: () => import('../components/views/Settings.vue')
  },
  {
    path: '/users',
    name: 'Users',
    component: () => import('../components/views/users/Users.vue')
  },
  {
    path: '/user/:id',
    name: 'User',
    component: () => import('../components/views/users/User.vue')
  },
  {
    path: '/market',
    name: 'Market',
    component: () => import('../components/views/Market.vue')
  },
  {
    path: '/currency/:id',
    name: 'Currency',
    component: () => import('../components/views/Currency.vue')
  },
  {
    path: '/wallet',
    name: 'Wallet',
    component: () => import('../components/views/Wallet.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../components/views/Login.vue')
  },
  {
    path: '/transactions',
    name: 'transactions',
    component: () => import('../components/views/Transactions')
  },
]

export default routes
