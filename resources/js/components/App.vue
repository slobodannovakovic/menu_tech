<template>
  <h1>Currency exchange</h1>

  <form @submit.prevent="submit">
    <input type="text" v-model="amount" placeholder="Amount">

    <select>
      <option v-for="(currency, index) in currencies"
        :key="index"
        value="{{ currancy.name }}">
        {{ currency.label }}
      </option>
    </select>

    <span>US$</span><input type="text" v-model="dollars">

    <button type="submit">Buy</button>
  </form>
</template>

<script>

  export default {
    data() {
      return {
        amount: 1,
        currencies: [
          {name: 'gbp', label: 'GBP', exchangeRate: 1.2},
          {name: 'jpy', label: 'JPY', exchangeRate: 0},
          {name: 'eur', label: 'EUR', exchangeRate: 0}
        ],
        dollars: 100
      }
    },

    methods: {
      submit() {
        this.dollars = this.amount * this.currencies[0].exchangeRate;
      }    
    }
  }

</script>