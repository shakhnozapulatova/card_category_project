import auth from '@/middleware/auth'

export default {
  mode: 'hash',
    base: process.env.BASE_URL,
  routes: [
  {
    path: '/login',
    component: () => import('@/layouts/Page'),
    children: [
      {
        name: 'login',
        path: '/',
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
        name: 'home',
        path: 'home',
        component: () => import('@/components/dashboard/pages/products/Index'),
        meta: {
          middleware: [
            auth,
          ],
        },
      },
      {
        name: 'products',
        path: 'products',
        component: () => import('@/components/dashboard/pages/products/Index'),
        meta: {
          middleware: [
            auth,
          ],
        },
      },
      {
        name: 'add-product',
        path: 'add-product',
        component: () => import('@/components/dashboard/pages/products/Create'),
        meta: {
          middleware: [
            auth,
          ],
        },
      },
      {
        name: 'update-product',
        path: 'update-product/:id',
        component: () => import('@/components/dashboard/pages/products/Update'),
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
