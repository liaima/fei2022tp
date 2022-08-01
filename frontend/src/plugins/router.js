import Vue from 'vue'
import VueRouter from 'vue-router'
import AulasHome from '@/views/AulasHome'
import AulasAbout from '@/views/AulasAbout'
import ReservationCrud from '@/views/reservation/ReservationCrud'
import AddReservation from '@/views/reservation/AddReservation'
import EditReservation from '@/views/reservation/EditReservation'
import AulasAdmin from '@/views/AulasAdmin'
import CareerCrud from '@/views/career/CareerCrud'
import AddCareer from '@/views/career/AddCareer'
import EditCareer from '@/views/career/EditCareer'
import TeacherCrud from '@/views/teacher/TeacherCrud'
import AddTeacher from '@/views/teacher/AddTeacher'
import EditTeacher from '@/views/teacher/EditTeacher'
import CourseCrud from '@/views/course/CourseCrud'
import AddCourse from '@/views/course/AddCourse'
import EditCourse from '@/views/course/EditCourse'
import ClassroomCrud from '@/views/classroom/ClassroomCrud'
import AddClassroom from '@/views/classroom/AddClassroom'
import EditClassroom from '@/views/classroom/EditClassroom'


import NotFound from '@/views/NotFound.vue'
Vue.use(VueRouter)

const routes = [
  { path: '/', name: 'home', component: AulasHome },
  { path: '/about', name: 'about', component: AulasAbout },
  { path: '/reservation', name: 'reservationCrud', component: ReservationCrud },
  { path: '/reservation/add_reservation', name: 'addReservation', component: AddReservation },
  { path: '/reservation/edit_reservation/:id', name: 'editReservation', component: EditReservation },
  { path: '/admin', name: 'admin', component: AulasAdmin },
  { path: '/admin/teacher', name: 'teacherCrud', component: TeacherCrud },
  { path: '/admin/teacher/add_teacher', name: 'addTeacher', component: AddTeacher },
  { path: '/admin/teacher/edit_teacher/:id', name: 'editTeacher', component: EditTeacher },
  { path: '/admin/career', name: 'careerCrud', component: CareerCrud },
  { path: '/admin/career/add_career', name: 'addCareer', component: AddCareer },
  { path: '/admin/career/edit_career/:id', name: 'editCareer', component: EditCareer },
  { path: '/admin/course', name: 'courseCrud', component: CourseCrud },
  { path: '/admin/course/add_course', name: 'addCourse', component: AddCourse },
  { path: '/admin/course/edit_course/:id', name: 'editCourse', component: EditCourse },
  { path: '/admin/classroom', name: 'classroomCrud', component: ClassroomCrud },
  { path: '/admin/classroom/add_classroom', name: 'addClassroom', component: AddClassroom },
  { path: '/admin/classroom/edit_classroom/:id', name: 'editClassroom', component: EditClassroom },

  { path: '/404/', component: NotFound },
  { path: '*', redirect: '/404' }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
