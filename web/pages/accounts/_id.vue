<template>
  <div>
    <div class="container" v-if="loading">loading...</div>

    <div class="container" v-if="!loading">
      <b-card :header="'Welcome, ' + account.name" class="mt-3">
        <b-card-text>
          <div>
            Account: <code>{{ account.id }}</code>
          </div>
          <div>
            Balance:
            <code
            >{{ account.currency === "usd" ? "$" : "€"
              }}{{ account.balance }}</code
            >
          </div>
        </b-card-text>
        <b-button size="sm" variant="success" @click="show = !show"
        >New payment
        </b-button
        >

        <b-button
          class="float-right"
          variant="danger"
          size="sm"
          nuxt-link
          to="/"
        >Logout
        </b-button
        >
      </b-card>

      <b-card class="mt-3" header="New Payment" v-show="show">
        <b-form @submit="onSubmit">
          <b-form-group id="input-group-1" label="To:" label-for="input-1">
            <b-form-input
              id="input-1"
              size="sm"
              v-model="payment.to"
              type="number"
              required
              placeholder="Destination ID"
            ></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-2" label="Amount:" label-for="input-2">
            <b-input-group prepend="$" size="sm">
              <b-form-input
                id="input-2"
                v-model="payment.amount"
                type="number"
                required
                placeholder="Amount"
              ></b-form-input>
            </b-input-group>
          </b-form-group>

          <b-form-group id="input-group-3" label="Details:" label-for="input-3">
            <b-form-input
              id="input-3"
              size="sm"
              v-model="payment.details"
              required
              placeholder="Payment details"
            ></b-form-input>
          </b-form-group>

          <b-button type="submit" size="sm" variant="primary">Submit</b-button>
        </b-form>
      </b-card>

      <b-card class="mt-3" header="Payment History">
        <b-table striped hover :items="transactions"></b-table>
      </b-card>
    </div>
  </div>
</template>

<script lang="ts">
  import axios from "axios";
  import Vue from "vue";

  export default Vue.extend({
    data() {
      return {
        show: false,
        payment: {},

        account: {
          id: null,
          name: '',
          balance: 0,
          currency: 'usd'
        },
        transactions: [{"id": 0, "from": null, "to": null, "details": "", "amount": ""}],

        loading: true
      };
    },

    mounted() {
      this.updateItems();
    },

    methods: {
      onSubmit(evt: Event) {
        let that = this;

        evt.preventDefault();

        axios.post(
          `http://localhost:8000/api/accounts/${
            this.$route.params.id
          }/transactions`,

          this.payment
        );

        that.payment = {};
        that.show = false;

        // update items
        setTimeout(() => {
          that.updateItems();
        }, 200);
      },

      updateItems() {
        const that = this;

        axios
          .get(`http://localhost:8000/api/accounts/${this.$route.params.id}`)
          .then(function (response) {
            if (!response.data) {
              window.location.href = "/"; // can be used that.$router.push("/")
            } else {
              that.account = response.data;

              if (that.account.id && that.transactions[0].id) {
                that.loading = false;
              }
            }
          });

        axios
          .get(
            `http://localhost:8000/api/accounts/${
              that.$route.params.id
            }/transactions`
          )
          .then(function (response) {
            that["transactions"] = response.data;

            let transactions: { "id": number, "from": null, "to": null, "details": string, "amount": string }[] = [];
            for (let i = 0; i < that.transactions.length; i++) {
              that.transactions[i].amount =
                (that.account.currency === "usd" ? "$" : "€") +
                that.transactions[i].amount;

              if (that.account.id != that.transactions[i].to) {
                that.transactions[i].amount = "-" + that.transactions[i].amount;
              }

              transactions.push(that.transactions[i]);
            }

            that.transactions = transactions;

            if (that.account.id && that.transactions[0].id) {
              that.loading = false;
            }
          });
      }
    }
  });
</script>
