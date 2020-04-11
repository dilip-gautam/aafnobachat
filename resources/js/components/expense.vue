<template>
  <div class="col">
    <div class="card shadow expense-card mt-2">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="card-title p-2 bd-highlight">Expenses Detail</div>
          <div class="d-flex">
            <div class="card-total p-2 bd-highlight">{{ totalexpense | toCurrency }}</div>
            <b-button class="btn btn-info btn-add" v-b-modal.modal-2>Add</b-button>

            <b-modal ref="modal-second" id="modal-2" hide-footer title="Add Details">
              <form @submit.prevent="addexpenses">
                <div class="form-group">
                  <label for="item name">Item Name</label>
                  <input type="text" class="form-control" id="item name" v-model="expensedetail" />
                </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input
                    type="number"
                    class="form-control"
                    id="expenseamount"
                    v-model="expenseamount"
                  />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </b-modal>
          </div>
        </h5>
        <div v-for="data in expense" :key="data.id">
          <div class="d-flex justify-content-between">
            <span>{{ data.items }}</span>
            <span>{{ data.amount | toCurrency }}</span>
          </div>
          <div class="d-flex justify-content-between">
            <span class="trans-date">{{ new Date(data.created_at) | formatDate }}</span>
            <a @click="deleteExpense(data.id)">
              <font-awesome-icon icon="trash" />
            </a>
          </div>
          <hr />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../axios/axios";

export default {
  data() {
    return {
      testa: [],
      expense: [],
      expensedetail: null,
      expenseamount: null
    };
  },
  methods: {
    addexpenses() {
      axios
        .post("/expense", {
          items: this.expensedetail,
          amount: this.expenseamount
        })
        .then(response => {
          this.expense.push(response.data.data);
          this.$refs["modal-second"].hide();
        });
      (this.expensedetail = null), (this.expenseamount = null);
    },
    deleteExpense(value) {
      axios.delete("/expense/" + value).then(response => {
        this.expense.map((element, index) => {
          if (element.id == value) {
            this.expense.splice(index, 1);
          }
        });
      });
    }
  },
  computed: {
    totalexpense() {
      let total = 0;
      this.expense.map(data => {
        total += data.amount;
      });
      this.$emit("totalexpense", total);
      return total;
    },
    deleteItem(value) {
      axios.delete("/earning/" + value).then(response => {
        this.earning.map((element, index) => {
          if (element.id == value) {
            this.earning.splice(index, 1);
          }
        });
      });
    }
  },
  watch: {},
  mounted() {
    axios.get("/expense").then(response => {
      response.data.forEach(element => {
        this.expense.push(element);
      });
    });
  }
};
</script>

<style scoped>
.expense-card {
  border-top: 9px solid rgb(241, 41, 68, 0.25);
}
</style>