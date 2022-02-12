import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('@/views/Home.vue')
  },
  {
    path: '/add-device',
    name: 'AddDevice',
    component: () => import('@/views/AddDevice.vue')
  },
  {
    path: '/scan-device/:id',
    name: 'ScanDevice',
    component: () => import('@/views/ScanDevice.vue')
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('@/views/Register.vue')
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
