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
    path: '/store',
    name: 'Store',
    component: () => import('../components/views/Store.vue')
  },
  {
    path: '/wallet',
    name: 'Wallet',
    component: () => import('../components/views/Wallet.vue')
  },
]

export default routes
