import Vue from 'vue'
import VueRouter from 'vue-router'
import AulasHome from '@/views/AulasHome'
import AulasAbout from '@/views/AulasAbout'
import AulasTools from '@/views/AulasTools'
import CourseCrud from '@/views/course/CourseCrud'
import AddCourse from '@/views/course/AddCourse'
import EditCourse from '@/views/course/EditCourse'
import TeacherCrud from '@/views/teacher/TeacherCrud'
import AddTeacher from '@/views/teacher/AddTeacher'
import EditTeacher from '@/views/teacher/EditTeacher'

import NotFound from '@/views/NotFound.vue'
Vue.use(VueRouter)

const routes = [
  { path: '/', name: 'home', component: AulasHome },
  { path: '/about', name: 'about', component: AulasAbout },
  { path: '/tools', name: 'tools', component: AulasTools },
  { path: '/tools/teacher', name: 'teacherCrud', component: TeacherCrud },
  { path: '/tools/teacher/add_teacher', name: 'addTeacher', component: AddTeacher },
  { path: '/tools/teacher/edit_teacher', name: 'editTeacher', component: EditTeacher },
  { path: '/tools/course', name: 'courseCrud', component: CourseCrud },
  { path: '/tools/course/add_course', name: 'addCourse', component: AddCourse },
  { path: '/tools/course/edit_course', name: 'editCourse', component: EditCourse },
  { path: '/404/', component: NotFound },
  { path: '*', redirect: '/404' }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
