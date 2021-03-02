<template>
  <v-container>
    <v-card>
      {{ atxPath }}
      <div class="d-flex my-5">
        <v-select v-model="searchParams.status"
                  style="max-width: 250px"
                  label="Статус"
                  outlined
                  item-text="name"
                  item-value="id"
                  class="ml-auto"
                  :items="mappedOptions"
        />
        <v-text-field v-model="searchParams.name"
                      style="max-width: 250px"
                      label="Поиск"
                      outlined
                      class="ml-5"
        />
      </div>
      <data-table ref="productTable" :action="action" :headers="headers" :params="params" :search-options="searchParams">
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
  import SelectField from '@/components/form/fields/SelectField'
  import TextField from '@/components/form/fields/TextField'
  import LoadProductAttributesMixin from '@/components/dashboard/pages/products/mixins/LoadProductAttributesMixin'
  import LoadUsersListMixin from '@/components/dashboard/pages/users/mixins/LoadUsersListMixin'
  import ProductStatusMixin from '@/components/dashboard/pages/users/mixins/ProductStatusMixin'

  export default {
    name: 'Index',
    components: {
      DataTable, SingleProductInfo, SelectField, TextField,
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
          name: '',
          status: '',
        },
        currentProduct: {},
        dialog: false,
      }
    },
    computed: {
      ...mapState('auth', ['isAdmin', 'isEditor']),
      atxPath () {
        const atx = this.atx

        // Todo make flexible
        const loop = (arr, target, index, path) => {
          if (arr[index].id === target) {
            path.push({ name: arr[index].name, id: arr[index].id })
          } else if (arr[index].children && arr[index].children.length) {
            path.push({ name: arr[index].name, id: arr[index].id })
            arr[index].children.forEach((_, i, a) => {
              loop(a, target, i, path)
            })

            if (path[path.length - 1].id === arr[index].id) {
              path.pop()
            }
          }
        }

        const getPath = (arr, target) => {
          const path = []
          arr.forEach((_, i, a) => loop(a, target, i, path))
          return path
        }

        console.log(getPath(atx, 'J01CR02'))
        return 1
      },
    },
    created () {
      const pages = [{ name: 'a', id: '1', pages: [{ name: 'b', id: '1.1', pages: [] }, { name: 'c', id: '1.2', pages: [{ name: 'd', id: '1.2.1', pages: [] }] }] }, { name: 'e', id: '2', pages: [] }]
      const loop = (arr, target, index, path) => {
        if (arr[index].id === target) {
          path.push({ name: arr[index].name, id: arr[index].id })
        } else if (arr[index].pages.length) {
          path.push({ name: arr[index].name, id: arr[index].id })
          arr[index].pages.forEach((_, i, a) => {
            loop(a, target, i, path)
          })

          if (path[path.length - 1].id === arr[index].id) path.pop()
        }
      }

      const getPath = (arr, target) => {
        const path = []
        arr.forEach((_, i, a) => loop(a, target, i, path))
        return path
      }
      console.log(getPath(pages, 'a'))
      // console.log(objectPath.get(obj, path))
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

      getPath (obj, item) {
        for (const key in obj) {
          if (obj[key] && typeof obj[key] === 'object') {
            const result = this.getPath(obj[key], item)
            if (result) {
              result.unshift(key)
              return result
            }
          } else if (obj[key] === item) {
            return [key]
          }
        }
      },
    },
  }
</script>
