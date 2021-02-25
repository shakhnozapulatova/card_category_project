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
            :options="atxOptions"
            validation-rule="required"
            @input="updateFieldValue"
          />
        </template>
      </form-base>
    </base-material-card>
  </v-container>
</template>

<script>

  import FormBase from '@/components/form/FormBase'
  import { mapActions, mapMutations } from 'vuex'
  import schema from '@/components/dashboard/pages/products/form/updateSchema'
  import TreeselectField from '@/components/form/fields/TreeselectField'
  import LoadProductAttributesMixin from '@/components/dashboard/pages/products/mixins/LoadProductAttributesMixin'
  import objectPath from 'object-path'

  export default {
    name: 'Update',
    components: {
      FormBase,
      TreeselectField,
    },
    mixins: [LoadProductAttributesMixin],
    data () {
      return {
        schema,
        formValue: '',
        loading: false,
        id: '',
        currentProduct: '',
      }
    },
    created () {
      this.id = this.$route.params.id

      this.getProductById({ id: this.id, params: { with: 'data' } })
        .then(({ data }) => {
          this.currentProduct = data
          this.schema.forEach(field => {
            field.value = objectPath.get(this.currentProduct, field.name) || null
          })
        })
        .catch(() => {
          alert('Извините но вы не можете редактировать этот товар')
        })
    },
    methods: {
      ...mapActions('product', ['getProductUpdateForm', 'getProductById', 'updateProduct', 'updateProductData']),
      ...mapActions('attributes', ['getOptions']),
      ...mapMutations('alert', ['successMessage', 'errorMessage']),
      ...mapMutations('attributes', ['setAttribute']),
      create () {
        this.loading = true
        this.updateProduct({ id: this.id, data: this.formValue })
          .then(({ data }) => {
            const { id } = data.data
            this.updateProductData({ id, data: this.formValue })
              .then(() => {
                this.successMessage('Продукт обновлен')
                this.loading = false
                // this.$router.push({ name: 'products' })
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
