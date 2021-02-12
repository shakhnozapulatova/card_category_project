<template>
  <v-container
    fluid
    tag="section"
    class="mt-3"
  >
    <base-material-card
      color="success"
      icon="mdi-account"
      title="Обновление категории"
      class="px-5 py-3 mb-10"
    >
      <form-base
        v-model="formValue"
        :schema="schema"
        :scope="'update-category'"
        :on-submit="update"
      />
    </base-material-card>
  </v-container>
</template>

<script>
  import FormBase from '@/components/form/FormBase'

  import { mapActions, mapMutations } from 'vuex'
  export default {
    name: 'Update',
    components: {
      FormBase,
    },
    data: () => ({
      schema: [],
      formValue: '',
      id: '',
    }),
    created () {
      this.id = this.$route.params.id
      this.getUpdateForm(this.id)
        .then(({ data }) => {
          this.schema = data.form
        })
    },
    methods: {
      ...mapActions('category', ['getUpdateForm', 'updateCategory']),
      ...mapMutations('alert', ['errorMessage', 'successMessage']),
      update () {
        this.loading = true
        this.updateCategory({ id: this.id, params: this.formValue })
          .then(() => {
            this.$router.push({ name: 'categories' })
            this.successMessage('Категория создана')
            this.loading = true
          })
          .catch((error) => {
            this.errorMessage(error)
          })
      },
    },
  }
</script>
