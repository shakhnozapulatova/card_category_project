<script>
  import { mapActions, mapGetters, mapMutations, mapState } from 'vuex'

  export default {
    name: 'LoadProductAttributesMixin',
    computed: {
      ...mapGetters('attributes', ['getAttributeByKey']),
      atx () {
        return this.getAttributeByKey('atx')
      },
    },
    created () {
      if (!this.getAttributeByKey('atx').length) {
        this.getOptions('atx')
          .then(({ data }) => {
            const options = this.formatAtxOptions(data.data)
            this.setAttribute({ key: 'atx', data: options })
          })
      }
    },
    methods: {
      ...mapActions('attributes', ['getOptions']),
      ...mapMutations('attributes', ['setAttribute']),
      formatAtxOptions (options) {
        return options.map(option => {
          const formattedOption = {
            id: option.value,
            name: `${option.value} - ${option.name}`,
          }

          if (option.children) {
            formattedOption.children = this.formatAtxOptions(option.children)
          }

          return formattedOption
        })
      },
    },
  }
</script>
