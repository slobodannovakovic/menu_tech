<template>
  <div id="wrapper" class="height-100">

    <div class="heading marginBottom-lg">
      <h1>Currency exchange</h1>
      <small>Base currency {{ baseCurrency.toUpperCase() }}</small>
    </div>

    <form @submit.prevent="submit">
      <label>Choose currency to buy</label>
      <select class="marginBottom" v-model="currencyToBuy" @change="getExchangeRate()">
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
        @change="getExchangeRate()"
        @keyup="getExchangeRate($event)"
        placeholder="Amount"
        class="marginBottom"><br>

      <span>Cost in {{ baseCurrency.toUpperCase() }}</span>
      <input type="text"
        v-model="costInBaseCurrency"
        class="marginBottom"
        readonly><br>

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

    mounted() {
      this.getExchangeRate();
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
      },

      getExchangeRate(e) {
        if(e && e.target.value === '') {
          this.currencyToBuyAmount = 1;
        }

        axios.get(`api/exchange-rates/${this.baseCurrency}-${this.currencyToBuy}`)
          .then(res => {
            this.updateCost(res.data);
          })
          .catch(err => {
            console.log(err.response.data)
          });
      },

      updateCost(exchangeRate) {
        this.costInBaseCurrency = parseInt(this.currencyToBuyAmount) / 
                                  parseFloat(exchangeRate.amount)
      }

      //URADITI SUBMIT FORME I SNIMANJE U BAZU
      //VIDETI NA BACKENDU DA SE VRATE RESOURSE-I
      //TASK ZA CRON - EXCHANGE API I UPDATE BAZE
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