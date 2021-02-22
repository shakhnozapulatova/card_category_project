<template>
  <v-container>
    <v-card>
      <data-table :action="action" :headers="headers" :params="params">
        <template v-slot:item.editor="{ item }">
          <tr>
            <td>{{ item.editor ? item.editor.name : 'Отсутствует ' }}</td>
          </tr>
        </template>
        <template v-slot:item.atx="{ item }">
          <tr>
            <td>{{ findDataObjectByValue(item,'atx').value }}</td>
          </tr>
        </template>
        <template v-slot:item.mnn="{ item }">
          <tr>
            <td>{{ findDataObjectByValue(item,'mnn').value }}</td>
          </tr>
        </template>
        <template v-slot:item.producer="{ item }">
          <tr>
            <td>{{ findDataObjectByValue(item,'country_producer').value }}</td>
          </tr>
        </template>
        <template v-slot:item.category="{ item }">
          <tr>
            <td>
              Категория
              <!--              {{ findDataObjectByValue(item,'category').value }}-->
            </td>
          </tr>
        </template>
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
  import { mapActions, mapGetters, mapMutations } from 'vuex'
  export default {
    name: 'Index',
    components: {
      DataTable,
    },
    data () {
      return {
        action: 'product/getProductList',
        params: {
          with: ['editor', 'data'],
        },
        headers: [
          {
            text: 'Название',
            value: 'name',
          },
          {
            text: 'Модератор',
            value: 'editor',
          },
          {
            sortable: false,
            text: 'Код АТХ',
            value: 'atx',
          },
          {
            sortable: false,
            text: 'МНН',
            value: 'mnn',
          },
          {
            sortable: false,
            text: 'Производитель',
            value: 'producer',
          },
          {
            sortable: false,
            text: 'Категория 5',
            value: 'category',
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
    computed: {
      ...mapGetters({
        getAttributeByKey: 'attributes/getAttributeByKey',
      }),
    },
    created () {
      if (!this.getAttributeByKey('atx')) {
        this.getOptions('atx')
          .then(({ data }) => {
            this.setAttribute({ key: 'atx', data: data.data })
          })
      }
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
      findDataObjectByValue (item, value) {
        return item.data.find((data) => data.name === value)
      },
    },
  }
</script>
