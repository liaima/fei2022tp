import Vue from 'vue'
import VueRouter from 'vue-router'
import AulasHome from '@/views/AulasHome'
import AulasAbout from '@/views/AulasAbout'
import AulasTools from '@/views/AulasTools'
import CourseCrud from '@/views/course/CourseCrud'
import AddCourse from '@/views/course/AddCourse'
import NotFound from '@/views/NotFound.vue'
Vue.use(VueRouter)

const routes = [
  { path: '/', name: 'home', component: AulasHome },
  { path: '/about', name: 'about', component: AulasAbout },
  { path: '/tools', name: 'tools', component: AulasTools },
  { path: '/tools/course', name: 'course', component: CourseCrud },
  { path: '/tools/course/add_course', name: 'addCourse', component: AddCourse },
  { path: '/404/', component: NotFound },
  { path: '*', redirect: '/404' }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
