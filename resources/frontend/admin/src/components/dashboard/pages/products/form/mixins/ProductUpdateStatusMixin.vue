<script>
  import { mapState } from 'vuex'

  export default {
    name: 'ProductStatusMixin',
    computed: {
      ...mapState('auth', ['isAdmin']),
      statuses () {
        const statuses = [
          {
            id: 'draft',
            name: 'Черновик',
          },
          {
            id: 'pending',
            name: 'Ожидает модерацию',
          },
        ]

        if (this.isAdmin) {
          statuses.push({
            id: 'published',
            name: 'Опубликован',
          })
        }

        return statuses
      },
    },
  }
</script>

<style scoped>

</style>
