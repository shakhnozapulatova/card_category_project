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
        component: () => import('@/components/dashboard/pages/staffs/CreateUpdate'),
        meta: {
          middleware: [
            auth,
          ],
        },
      },
      {
        name: 'staff',
        path: 'staff',
        component: () => import('@/components/dashboard/pages/staffs/Index'),
        meta: {
          middleware: [
            auth,
          ],
        },
      },
      {
        name: 'create-staff',
        path: 'create-staff',
        component: () => import('@/components/dashboard/pages/staffs/CreateUpdate'),
      },
      {
        name: 'update-staff',
        path: 'update-staff/:id',
        component: () => import('@/components/dashboard/pages/staffs/CreateUpdate'),
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
