const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "about" */ '../components/Home.vue')
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../components/About.vue')
  },
  {
    path: '/settings',
    name: 'Settings',
    component: () => import('../components/Settings.vue')
  },
  {
    path: '/users',
    name: 'Users',
    component: () => import('../components/users/Users.vue')
  },
  {
    path: '/store',
    name: 'Store',
    component: () => import('../components/Store.vue')
  },
  {
    path: '/wallet',
    name: 'Wallet',
    component: () => import('../components/Wallet.vue')
  },
]

export default routes
