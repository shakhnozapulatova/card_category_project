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
      />
    </base-material-card>
  </v-container>
</template>

<script>
  import FormBase from '@/components/form/FormBase'

  import { mapActions, mapGetters, mapMutations } from 'vuex'
  export default {
    name: 'Update',
    components: {
      FormBase,
    },
    data () {
      return {
        schema: [],
        formValue: '',
        loading: false,
        id: '',
      }
    },
    created () {
      this.id = this.$route.params.id

      this.getProductUpdateForm(this.id)
        .then(({ data }) => {
          this.schema = data.form
        })
    },
    methods: {
      ...mapActions('product', ['getProductUpdateForm', 'updateProduct']),
      ...mapMutations('alert', ['successMessage', 'errorMessage']),
      create () {
        this.loading = true
        this.updateProduct({ id: this.id, data: this.formValue })
          .then(() => {
            this.$router.push({ name: 'products' })
            this.successMessage('Продукт обновлен')
            this.loading = false
          })
          .catch((error) => {
            this.errorMessage(error)
            this.loading = false
          })
      },
    },
  }
</script>
