<script>
  import { mapState } from 'vuex'

  export default {
    name: 'LoadProductAttributesMixin',
    computed: {
      ...mapState('attributes', ['atx']),
      atxOptions () {
        return this.atx
      },
    },
    created () {
      if (!this.atxOptions.length) {
        this.getOptions('atx')
          .then(({ data }) => {
            const options = this.formatAtxOptions(data.data)
            this.setAttribute({ key: 'atx', data: options })
          })
      }
    },
    methods: {
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
