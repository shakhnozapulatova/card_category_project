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
    computed: {
      mappedOptions () {
        const temp = []
        for (const status in this.statuses) {
          temp.push({
            id: status,
            name: this.statuses[status],
          })
        }
        return temp
      },
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
