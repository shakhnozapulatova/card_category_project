import auth from '@/middleware/auth'

export default {
  mode: 'hash',
    base: process.env.BASE_URL,
  routes: [
  {
    path: '/',
    component: () => import('@/layouts/Page'),
    children: [
      {
        name: 'login',
        path: 'login',
        component: () => import('@/components/pages/Login'),
      },
    ],
  },
  {
    path: '/',
    component: () => import('@/layouts/Dashboard'),
    name: 'App',
    meta: {
      middleware: [
        auth,
      ],
    },
    children: [
      {
        name: 'categories',
        path: 'categories',
        component: () => import('@/components/dashboard/pages/categories/Index'),
        meta: {
          middleware: [
            auth,
          ],
        },
      },
      {
        name: 'add-category',
        path: 'add-category',
        component: () => import('@/components/dashboard/pages/categories/Create'),
        meta: {
          middleware: [
            auth,
          ],
        },
      },
      {
        name: 'update-category',
        path: 'update-category/:id',
        component: () => import('@/components/dashboard/pages/categories/Update'),
        meta: {
          middleware: [
            auth,
          ],
        },
      },
      {
        name: 'users',
        path: 'users',
        component: () => import('@/components/dashboard/pages/users/Index'),
        meta: {
          middleware: [
            auth,
          ],
        },
      },
      {
        name: 'add-user',
        path: 'add-user',
        component: () => import('@/components/dashboard/pages/users/Create'),
      },
      {
        name: 'update-user',
        path: 'add-user/:id',
        component: () => import('@/components/dashboard/pages/users/Update'),
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
    component: () => import('@/layouts/Page'),
    children: [
      {
        name: '404 Error',
        path: '',
        component: () => import('@/components/pages/Error'),
      },
    ],
  },
],
}
