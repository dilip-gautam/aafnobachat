<template>
  <div class="col">
    <div class="card shadow expense-card mt-2">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="card-title p-2 bd-highlight">Expenses Detail</div>
          <div class="d-flex">
            <div class="card-total p-2 bd-highlight">Rs {{totalexpense}}</div>
            <b-button class="btn btn-info btn-add" v-b-modal.modal-2>Add</b-button>

            <b-modal id="modal-2" hide-footer title="Add Details">
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
            <div class="p-2 bd-highlight">{{ data.items }}</div>
            <div class="p-2 bd-highlight">{{ data.amount }}</div>
          </div>
          <span class="trans-date">{{ new Date(data.created_at) | formatDate }}</span>
          <hr>
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
          console.log(response);
        });
      (this.expensedetail = null), (this.expenseamount = null);
    },
    hideModal() {
      this.$refs["test"].hide();
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