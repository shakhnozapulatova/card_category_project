<script>
  export default {
    name: 'ProductStatusMixin',
    data () {
      return {
        statuses: {
          draft: 'Черновик',
          pending: 'Ожидает модерацию',
          published: 'Опубликован',
        },
      }
    },
    methods: {
      getStatusLabelBySlug (slug) {
        return this.statuses[slug]
      },
    },
  }
</script>

<style scoped>

</style>
