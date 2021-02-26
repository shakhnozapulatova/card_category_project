<template>
  <v-container>
    <v-card>
      <data-table ref="productTable" :action="action" :headers="headers" :params="params">
        <template v-slot:item.editor.name="{ item }">
          <tr>
            <td>{{ item.editor ? item.editor.name : 'Отсутствует' }}</td>
          </tr>
        </template>
        <template v-slot:item.status="{ item }">
          <tr>
            <td>{{ getStatusLabelBySlug(item.status) }}</td>
          </tr>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-btn
            class="px-2 ml-1"
            color="blue"
            min-width="0"
            small
            @click="viewFullProductInfo(item)"
          >
            <v-icon small color="white" v-text="'mdi-eye'" />
          </v-btn>
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
            v-show="isAdmin"
            class="px-2 ml-1"
            color="error"
            min-width="0"
            small
            @click="removeProduct(item.id)"
          >
            <v-icon small v-text="'mdi-delete'" />
          </v-btn>
        </template>
      </data-table>
    </v-card>
    <v-dialog v-model="dialog" max-width="768">
      <single-product-info :product="currentProduct">
        <template v-slot:actions>
          <v-card-actions class="justify-end">
            <v-btn
              text
              @click="dialog = false"
            >
              Закрыть
            </v-btn>
          </v-card-actions>
        </template>
      </single-product-info>
    </v-dialog>
  </v-container>
</template>

<script>
  import DataTable from '@/components/dashboard/DataTable'
  import { mapActions, mapMutations, mapState } from 'vuex'
  import headers from '@/components/dashboard/pages/products/table/headers'
  import SingleProductInfo from '@/components/dashboard/pages/products/SingleProductInfo'
  import LoadProductAttributesMixin from '@/components/dashboard/pages/products/mixins/LoadProductAttributesMixin'
  import LoadUsersListMixin from '@/components/dashboard/pages/users/mixins/LoadUsersListMixin'
  import ProductStatusMixin from '@/components/dashboard/pages/users/mixins/ProductStatusMixin'

  export default {
    name: 'Index',
    components: {
      DataTable, SingleProductInfo,
    },
    mixins: [LoadProductAttributesMixin, LoadUsersListMixin, ProductStatusMixin],
    data () {
      return {
        action: 'product/getProductList',
        params: {
          with: ['editor', 'data'],
        },
        headers,
        searchParams: {
          qs: '',
        },
        currentProduct: {},
        dialog: false,
      }
    },
    computed: {
      ...mapState('auth', ['isAdmin', 'isEditor']),
    },
    methods: {
      ...mapActions('product', ['deleteProduct']),
      ...mapActions('attributes', ['getOptions']),
      ...mapMutations('attributes', ['setAttribute']),

      redirectToUpdatePage (productId) {
        this.$router.push({
          name: 'update-product',
          params: {
            id: productId,
          },
        })
      },
      viewFullProductInfo (item) {
        this.currentProduct = item
        this.dialog = true
      },
      async removeProduct (productId) {
        this.deleteProduct(productId)
        await this.$refs.productTable.fetchPosts()
      },
    },
  }
</script>
