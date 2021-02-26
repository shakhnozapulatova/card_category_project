<script>
  import { mapState } from 'vuex'
  import ProductUpdateStatusMixin from '@/components/dashboard/pages/products/form/mixins/ProductUpdateStatusMixin'

  export default {
    name: 'UpdateSchemaMixin',
    mixins: [ProductUpdateStatusMixin],
    data () {
      return {
        fields: [
          {
            component: 'text',
            name: 'name',
            label: 'Наименование',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 6,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.old_name',
            label: 'Наименование (Старое значение)',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
              disabled: true,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'treeselect',
            name: 'data.atx',
            label: 'Код АТХ',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 6,
            },
            options: [],
          },
          {
            component: 'text',
            name: 'data.old_atx',
            label: 'Код АТХ (Старое значение)',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
              disabled: true,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.country_producer',
            label: 'Страна производитель',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 6,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.old_country_producer',
            label: 'Страна производитель (Старое значение)',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
              disabled: true,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.mnn',
            label: 'МНН',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 6,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.old_mnn',
            label: 'МНН (Старое значение)',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
              disabled: true,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'treeselect',
            name: 'data.category',
            label: 'Категория',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
            },
            options: [],
          },
          {
            component: 'select',
            name: 'editor_id',
            label: 'Модератор',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
              disabled: !this.isAdmin,
            },
            options: [],
          },
          {
            component: 'select',
            name: 'status',
            label: 'Статус',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
            },
            options: this.statuses,
          },
        ],
      }
    },
    computed: {
      ...mapState('auth', ['isAdmin']),
    },
    methods: {
      getSchema () {
        return [
          {
            component: 'text',
            name: 'name',
            label: 'Наименование',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 6,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.old_name',
            label: 'Наименование (Старое значение)',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
              disabled: true,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'treeselect',
            name: 'data.atx',
            label: 'Код АТХ',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 6,
            },
            options: [],
            placeholder: 'Код АТХ',
          },
          {
            component: 'text',
            name: 'data.old_atx',
            label: 'Код АТХ (Старое значение)',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
              disabled: true,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.country_producer',
            label: 'Страна производитель',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 6,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.old_country_producer',
            label: 'Страна производитель (Старое значение)',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
              disabled: true,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.mnn',
            label: 'МНН',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 6,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'text',
            name: 'data.old_mnn',
            label: 'МНН (Старое значение)',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 6,
              disabled: true,
            },
            type: 'text',
            placeholder: null,
          },
          {
            component: 'treeselect',
            name: 'data.category',
            label: 'Категория',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 4,
            },
            options: [],
            placeholder: 'Категория',
          },
          {
            component: 'select',
            name: 'status',
            label: 'Статус',
            value: null,
            rule: null,
            attributes: {
              outlined: true,
              cols: 4,
            },
            options: this.statuses,
          },
          {
            component: 'select',
            name: 'editor_id',
            label: 'Модератор',
            value: null,
            rule: 'required',
            attributes: {
              outlined: true,
              cols: 4,
              disabled: !this.isAdmin,
            },
            options: [],
          },
        ]
      },
    },

  }
</script>

<style scoped>

</style>
