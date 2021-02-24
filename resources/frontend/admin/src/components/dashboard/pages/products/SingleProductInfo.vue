<template>
  <div>
    <v-card>
      <v-card-title class="headline" align="center">
        <h3 class="text-center w-100">
          Информация о продукте
        </h3>
      </v-card-title>
      <v-card-text class="good-info">
        <v-row>
          <v-col cols="6">
            <strong>Наименование:</strong>
            <div>{{ product.name }}</div>
          </v-col>
          <v-col cols="6">
            <strong>Наименование (старое значение):</strong>
            <div>{{ product.data.old_name }}</div>
          </v-col>
          <v-col cols="6">
            <strong>Код АТХ:</strong>
            <div>{{ product.data.atx }}</div>
          </v-col>
          <v-col cols="6">
            <strong>Код АТХ (старое значение):</strong>
            <div>{{ product.data.old_atx }}</div>
          </v-col>
          <v-col cols="6">
            <strong>МНН:</strong>
            <div>{{ product.data.mnn }}</div>
          </v-col>
          <v-col cols="6">
            <strong>МНН (старое значение):</strong>
            <div>{{ product.data.old_mnn }}</div>
          </v-col>
          <v-col cols="6">
            <strong>Страна производитель:</strong>
            <div>{{ product.data.country_producer }}</div>
          </v-col>
          <v-col cols="6">
            <strong>Страна производитель (старое значение):</strong>
            <div>{{ product.data.old_country_producer }}</div>
          </v-col>
          <v-col cols="12">
            <strong>Категории</strong>
            <div>
              <div>1. Категория </div>
              <div>2. Категория</div>
              <div>3. Категория</div>
              <div>4. Категория</div>
            </div>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
  export default {
    name: 'SingleProductInfo',
    props: {
      product: {
        type: Object,
        required: true,
      },
    },
  }
</script>

<style lang="scss" scoped>
.good-info {
  * {
    font-size: 1.1rem;
  }
}
</style>
