<template>
  <v-container>
    <v-card>
      <data-table :action="action" :headers="headers" />
    </v-card>
  </v-container>
</template>

<script>
  import DataTable from '@/components/dashboard/DataTable'
  export default {
    name: 'Index',
    components: {
      DataTable,
    },
    data () {
      return {
        action: 'category/getCategoryList',
        headers: [
          {
            text: 'Название',
            value: 'name',
          },
          {
            text: 'Слаг',
            value: 'slug',
          },
          {
            text: 'Порядок',
            value: 'order',
          },
          {
            sortable: false,
            text: 'Действия',
            value: 'actions',
          },
        ],
        searchParams: {
          qs: '',
        },
      }
    },
  }
</script>

<style scoped>

</style>
