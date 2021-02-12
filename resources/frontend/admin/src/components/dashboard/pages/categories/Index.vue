<template>
  <v-container>
    <v-card>
      <data-table ref="table" :action="action" :headers="headers">
        <template v-slot:item.actions="{ item }">
          <v-btn
            class="px-2 ml-1"
            color="success"
            min-width="0"
            small
            @click="updateCategory(item)"
          >
            <v-icon small v-text="'mdi-pencil'" />
          </v-btn>
          <v-btn
            class="px-2 ml-1"
            color="error"
            min-width="0"
            small
            @click="deleteCat(item.id)"
          >
            <v-icon small v-text="'mdi-delete'" />
          </v-btn>
        </template>
      </data-table>
    </v-card>
  </v-container>
</template>

<script>
  import DataTable from '@/components/dashboard/DataTable'
  import { mapActions } from 'vuex'
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
            text: 'Идентификатор',
            value: 'id',
          },
          {
            text: 'Идентификатор родительской категории',
            value: 'parent_id',
          },
          {
            text: 'Название',
            value: 'name',
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
    methods: {
      ...mapActions('category', ['deleteCategory']),
      updateCategory (item) {
        this.$router.push({
          name: 'update-category',
          params: {
            id: item.id,
          },
        })
      },
      deleteCat (id) {
        this.deleteCategory(id)
        this.$refs.table.fetchPosts()
      },
    },
  }
</script>
