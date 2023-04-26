<template>
  <div id="wrapper" class="height-100">

    <div class="heading marginBottom-lg">
      <h1>Currency exchange</h1>
      <small>Base currency {{ baseCurrency.toUpperCase() }}</small>
    </div>

    <form @submit.prevent="submit">
      <label>Choose currency to buy</label>
      <select class="marginBottom" v-model="currencyToBuy" @change="getCost()">
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
        @change="getCost()"
        @keyup="getCost($event)"
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
      this.getCost();
    },

    methods: {
      submit() {
        axios.post(`/api/orders`, {
          currencyToBuy: this.currencyToBuy,
          costInBaseCurrency: this.costInBaseCurrency,
          currencyToBuyAmount: this.currencyToBuyAmount,
          baseCurrency: this.baseCurrency
        })
        .then(res => {
          if(res.status === 200 || res.status === 201) {
            alert('Order successfuly created. Thank you.');
          } else {
            alert('Sorry, something went wrong.');
          }
        });
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

      getCost(e) {
        if(e && e.target.value === '') {
          this.currencyToBuyAmount = 1;
        }

        axios.get(`api/cost-calculation/${this.baseCurrency}/${this.currencyToBuy}/${this.currencyToBuyAmount}`)
          .then(res => {
            this.costInBaseCurrency = res.data.amount;
          })
          .catch(err => {
            console.log(err.response.data)
          });
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