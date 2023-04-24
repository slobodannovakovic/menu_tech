<template>
  <div id="wrapper" class="height-100">

    <div class="heading marginBottom-lg">
      <h1>Currency exchange</h1>
      <small>Base currency {{ baseCurrency.toUpperCase() }}</small>
    </div>

    <form @submit.prevent="submit">
      <label>Choose currency to buy</label>
      <select class="marginBottom" v-model="currencyToBuy">
        <option v-for="(currency, index) in currencies"
          :key="index"
          :value="currency.name">
          {{ currency.label }}
        </option>
      </select><br>

      <label>Enter amount</label>
      <input type="number"
        min="1"
        v-model="currencyToBuyAmount"
        placeholder="Amount"
        class="marginBottom"><br>

      <span>Cost in {{ baseCurrency.toUpperCase() }}</span>
      <input type="text" v-model="costInBaseCurrency" class="marginBottom"><br>

      <button type="submit">Buy</button>
    </form>
  </div>
</template>

<script>

  export default {
    data() {
      return {
        currencies: [],
        currencyToBuy: 'eur',
        currencyToBuyAmount: 1,
        costInBaseCurrency: 0,
        baseCurrency: 'usd'
      }
    },

    created() {
      this.getCurrencies();
    },

    methods: {
      submit() {
        alert('submitting');
      },

      getCurrencies() {
        axios.get('api/currencies')
          .then(res => {
            let availableCurrencies = res.data.filter(currency => {
              return currency.name !== this.baseCurrency;
            });

            this.currencies = availableCurrencies;
          });
      }
    }
  }

</script>

<style>

  * {
    padding: 0;
    margin: 0;
  }

  body {
    height: 100vh;
  }

  .height-100 {
    height: 100%;
  }

  #wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .heading {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .marginBottom {
    margin-bottom: 1rem;
  }

  .marginBottom-lg {
    margin-bottom: 3rem;
  }

</style>