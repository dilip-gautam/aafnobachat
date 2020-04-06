<template>
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="p-2 bd-highlight">expenses Detail</div>
          <div class="d-flex">
            <div class="p-2 bd-highlight">Rs {{totalexpense}}</div>
            <b-button class="btn btn-success" v-b-modal.modal-2>Add</b-button>

            <b-modal id="modal-2" title="Add Details">
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
        <div class="d-flex justify-content-between" v-for="data in expense" :key="data.id">
          <div class="p-2 bd-highlight">{{ data.items }}</div>
          <div class="p-2 bd-highlight">{{ data.amount }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '../axios/axios'

export default {
    data() {
    return {
      expense: [],
      expensedetail: null,
      expenseamount: null,
    };
  },
  methods: {
    addexpenses() {
      axios.post('/expense',{
        items: this.expensedetail,
        amount: this.expenseamount,
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
  mounted(){
    axios.get('/expense')
    .then(response => {
     response.data.forEach(element => {
       this.expense.push(element);
     });
       
     });
  }

};
</script>

<style>
</style>