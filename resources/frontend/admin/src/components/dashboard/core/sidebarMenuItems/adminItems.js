export default [
  {
    icon: 'mdi-view-dashboard',
    title: 'mainPage',
    to: '/home',
  },
  {
    icon: 'mdi-shape-outline ',
    title: 'Категории',
    group: '',
    children: [
      {
        to: 'categories',
        avatar: 'mdi-clipboard-outline',
        title: 'Список категорий',
      },
      {
        to: 'add-category',
        avatar: 'mdi-clipboard-outline',
        title: 'Создать категорию',
      },
    ],
  },
  {
    icon: 'mdi-ab-testing',
    title: 'Продукты',
    group: '',
    children: [
      {
        to: 'products',
        title: 'Список продуктов',
      },
      {
        to: 'add-category',
        title: 'Создать продукт',
      },
    ],
  },
]
