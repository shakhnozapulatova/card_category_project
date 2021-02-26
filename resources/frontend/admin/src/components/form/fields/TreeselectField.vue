<template>
  <validation-provider
    v-slot="{ errors }"
    tag="div"
    :rules="validationRule"
    :name="label"
    class="treeselect-container"
    :vid="name"
  >
    <div class="treeselect-component">
      <label
        class="treeselect-label"
        :class="{
          'has-errors': errors.length
        }"
        v-text="label"
      />
      <treeselect
        ref="treeSelect"
        :class="{
          'has-errors': errors.length
        }"
        :value="value"
        :options="formattedOptions"
        :normalizer="normalizer"
        no-options-text="Нет доступных опций"
        no-results-text="Нет доступных опций"
        v-bind="attributes"
        :placeholder="label"
        @input="updateValue"
      />
      <div class="v-text-field" style="padding-top: 8px;">
        <div v-show="errors.length" class="v-text-field__details">
          <div class="v-messages theme--light error--text" role="alert">
            <div v-for="(error, index) in errors" :key="index" class="v-messages__wrapper">
              <div class="v-messages__message pl-3">
                {{ error }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </validation-provider>
</template>

<script>
  import Treeselect from '@riophae/vue-treeselect'
  import '@riophae/vue-treeselect/dist/vue-treeselect.css'
  import FieldMixin from '@/components/form/mixins/FieldMixin'
  export default {
    name: 'TreeselectField',
    components: {
      Treeselect,
    },
    mixins: [FieldMixin],
    props: {
      normalizer: {
        type: Function,
        default: (node) => {
          return {
            id: node.id,
            label: node.name,
            children: node.children,
          }
        },
      },
      options: {
        type: Array,
        default: () => [],
      },
    },
    computed: {
      formattedOptions () {
        return this.formatOptions(this.options)
      },
    },
    methods: {
      formatOptions (options) {
        return options.map(option => {
          const formattedOption = {
            id: option.id,
            name: option.name,
          }

          if (option.children) {
            formattedOption.children = this.formatOptions(option.children)
          }

          return formattedOption
        })
      },
    },
  }
</script>

<style lang="scss">
.treeselect-component {
  > * {
    transition: .25s all;
  }
}
.treeselect-label.has-errors {
  color: rgb(255, 82, 82) !important;
}
.treeselect-component .vue-treeselect__control {
  padding-top: 15px;
  padding-bottom: 15px;
  border-radius: 4px;
}
.treeselect-component .vue-treeselect__placeholder,
.vue-treeselect__single-value {
  line-height: 22px;
}
.treeselect-container {
  position: relative;
}
.treeselect-container .treeselect-label{
    position: absolute;
    top: -10px;
    z-index: 1;
    background: white;
    left: 8px;
    color: rgba(0, 0, 0, 0.6);
    font-size: 13px;
    padding-right: 3px;
    padding-left: 2px;
  }
.treeselect-component {
  .vue-treeselect__control {
    border-color: rgba(0, 0, 0, 0.42);
  }
  .has-errors {
    .treeselect-label {
      color: rgb(255, 82, 82);
    }
    .vue-treeselect__control {
      border-color: rgb(255, 82, 82);
      border-width: 2px;

      .vue-treeselect-helper-zoom-effect-off {
        color: rgb(255, 82, 82);
      }
      &:hover {
        border-color: rgb(255, 82, 82);
        border-width: 2px;
      }

      svg {
        fill: rgb(255, 82, 82);
      }
    }
  }
}

.treeselect-component.vue-treeselect--open-below:not(.vue-treeselect--append-to-body) .vue-treeselect__menu-container {
  /* position: relative; */
  top: -20%;

}
.treeselect-component .vue-treeselect__menu{
  border-radius: 4px;
  box-shadow: 0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);

}
.treeselect-component .vue-treeselect__menu > div > div > div{
 padding: 10px;
}
.treeselect-component.vue-treeselect--focused .vue-treeselect__control{
  border-color: var(--v-primary-base)!important;
  box-shadow: none;
}
.treeselect-component .vue-treeselect__option--selected{
  background: var(--v-primary-lighten5)!important;
  color: var(--v-primary-base)!important;
}
</style>
