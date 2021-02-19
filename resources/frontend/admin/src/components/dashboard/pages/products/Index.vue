<template>
  <v-container>
    <v-card>
      <data-table :action="action" :headers="headers">
        <template v-slot:item.actions="{ item }">
          <v-btn
            class="px-2 ml-1"
            color="success"
            min-width="0"
            small
            @click="redirectToUpdatePage(item.id)"
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
        action: 'product/getProductList',
        headers: [
          {
            text: 'Название',
            value: 'name',
          },
          {
            text: 'Старое название',
            value: 'old_name',
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
      ...mapActions('product', ['deleteProduct']),
      redirectToUpdatePage (productId) {
        this.$router.push({
          name: 'update-product',
          params: {
            id: productId,
          },
        })
      },
    },
  }
</script>
