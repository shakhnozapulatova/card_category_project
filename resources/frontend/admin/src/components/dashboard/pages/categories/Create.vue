<template>
  <v-container
    fluid
    tag="section"
    class="mt-3"
  >
    <base-material-card
      color="success"
      icon="mdi-account"
      title="Создание категории"
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
    name: 'SaveCategory',
    components: {
      FormBase,
    },
    data () {
      return {
        schema: [],
        formValue: '',
        loading: false,
      }
    },
    created () {
      this.getCreateForm()
        .then(({ data }) => {
          this.schema = data.form
        })
    },
    methods: {
      ...mapActions('category', ['getCreateForm', 'createCategory']),
      ...mapMutations('alert', ['successMessage', 'errorMessage']),
      create () {
        this.loading = true
        this.createCategory(this.formValue)
          .then(() => {
            this.$router.push({ name: 'categories' })
            this.successMessage('Категория создана')
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
