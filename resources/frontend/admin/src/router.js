import Vue from 'vue'
import Router from 'vue-router'
import store from './store'
import auth from './middleware/auth'
import middlewarePipeline from './middleware/middlewarePipeline'

Vue.use(Router)
const router = new Router({
  mode: 'hash',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      component: () => import('@/views/pages/applicationForm/Index'),
      children: [
        {
          name: 'application-form',
          path: '/',
          component: () => import('@/views/pages/applicationForm/Form'),
        },
      ],
    },
    {
      path: '/',
      component: () => import('@/views/pages/Index'),
      children: [
        {
          name: 'login',
          path: 'login',
          component: () => import('@/views/pages/Login'),
        },
      ],
    },
    {
      path: '/',
      component: () => import('@/views/dashboard/Index'),
      name: 'App',
      meta: {
        middleware: [
          auth,
        ],
      },
      children: [
        {
          name: 'home',
          path: 'home',
          component: () => import('@/views/dashboard/Dashboard'),
          meta: {
            middleware: [
              auth,
            ],
          },
        },
        {
          name: 'staff',
          path: 'staff',
          component: () => import('@/views/dashboard/pages/staffs/Index'),
          meta: {
            middleware: [
              auth,
            ],
          },
        },
        {
          name: 'create-staff',
          path: 'create-staff',
          component: () => import('@/views/dashboard/pages/staffs/CreateUpdate'),
        },
        {
          name: 'update-staff',
          path: 'update-staff/:id',
          component: () => import('@/views/dashboard/pages/staffs/CreateUpdate'),
          meta: {
            middleware: [
              auth,
            ],
          },
        },
      ],
    },
    {
      path: '*',
      component: () => import('@/views/pages/Index'),
      children: [
        {
          name: '404 Error',
          path: '',
          component: () => import('@/views/pages/Error'),
        },
      ],
    },
  ],
})

router.beforeEach((to, from, next) => {
  if (!to.meta.middleware) {
    return next()
  }

  if (to.path === '/') {
    return next({
      name: 'home',
    })
  }

  const middleware = to.meta.middleware
  const context = {
    to,
    from,
    next,
    store,
  }

  return middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1),
  })
})
export default router
