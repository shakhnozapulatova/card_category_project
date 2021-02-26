<template>
  <v-container
    fluid
    tag="section"
    class="mt-3"
  >
    <base-material-card
      color="success"
      icon="mdi-account"
      title="Обновление продукта"
      class="px-5 py-3 mb-10"
    >
      <form-base
        v-model="formValue"
        :schema="schema"
        :scope="'create-category'"
        :on-submit="create"
        :loading="loading"
      >
        <template v-slot:data.atx-field="{ field, updateFieldValue }">
          <treeselect-field
            v-model="field.value"
            :name="field.name"
            :label="field.label"
            :options="atx"
            validation-rule="required"
            @input="updateFieldValue"
          />
        </template>
        <template v-slot:editor_id-field="{ field, updateFieldValue }">
          <select-field
            v-model="field.value"
            :name="field.name"
            :label="field.label"
            :options="users"
            validation-rule="required"
            :attributes="field.attributes"
            @input="updateFieldValue"
          />
        </template>
      </form-base>
    </base-material-card>
  </v-container>
</template>

<script>

  import objectPath from 'object-path'
  import FormBase from '@/components/form/FormBase'
  import { mapActions, mapGetters, mapMutations } from 'vuex'
  import SelectField from '@/components/form/fields/SelectField'
  import TreeselectField from '@/components/form/fields/TreeselectField'
  import LoadProductAttributesMixin from '@/components/dashboard/pages/products/mixins/LoadProductAttributesMixin'
  import LoadUsersListMixin from '@/components/dashboard/pages/users/mixins/LoadUsersListMixin'
  import UpdateSchemaFieldMixin from './form/mixins/UpdateSchemaFieldMixin'

  export default {
    name: 'Update',
    components: {
      FormBase,
      TreeselectField,
      SelectField,
    },
    mixins: [LoadProductAttributesMixin, LoadUsersListMixin, UpdateSchemaFieldMixin],
    data () {
      return {
        formValue: '',
        loading: false,
        id: '',
        currentProduct: '',
        schema: [],
      }
    },
    computed: {
      ...mapGetters(['user/users']),
    },
    created () {
      this.id = this.$route.params.id

      // initialize fields
      this.schema = this.getSchema()

      this.getProductById({ id: this.id, params: { with: ['data', 'editor'] } })
        .then(({ data }) => {
          this.currentProduct = data
          this.schema = this.getSchema().map(field => {
            field.value = objectPath.get(this.currentProduct, field.name) || null

            if (field.name === 'editor_id') {
              field.value = objectPath.get(this.currentProduct, 'editor.id')
            }

            return field
          })
        })
        .catch(() => {
          // Todo replace with SweetAlert or default sanckbar
          alert('Извините но вы не можете редактировать этот товар')
        })
    },
    methods: {
      ...mapActions('product', ['getProductById', 'updateProduct', 'updateProductData']),
      ...mapMutations('alert', ['successMessage', 'errorMessage']),
      create () {
        this.loading = true
        this.updateProduct({ id: this.id, data: this.formValue })
          .then(({ data }) => {
            const { id } = data.data
            this.updateProductData({ id, data: this.formValue })
              .then(() => {
                this.successMessage('Продукт обновлен')
                this.loading = false
                this.$router.push({ name: 'products' })
              })
          })
          .catch((error) => {
            this.errorMessage(error)
            this.loading = false
          })
      },
    },
  }
</script>
