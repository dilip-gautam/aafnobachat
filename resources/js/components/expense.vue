<template>
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="p-2 bd-highlight">expenses Detail</div>
          <div class="d-flex">
            <div class="p-2 bd-highlight">Rs {{totalexpense}}</div>
            <b-button class="btn btn-success" v-b-modal.modal-2>Add</b-button>

            <b-modal id="modal-2" hide-footer="true" title="Add Details">
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
          <div class="p-2 bd-highlight">{{ data.detail }}</div>
          <div class="p-2 bd-highlight">{{ data.amount }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      expensedetail: "",
      expenseamount: "",
      expense: [
        {
          id: 1,
          detail: "Transcript nikalda",
          amount: 700,
          date: Date.now()
        },
        {
          id: 2,
          detail: "khaja",
          amount: 300,
          date: Date.now()
        },
        {
          id: 3,
          detail: "scooty servicing",
          amount: 300,
          date: Date.now()
        }
      ]
    };
  },
  methods: {
    addexpenses() {
      console.log(this.expensedetail);
      console.log(typeof this.expenseamount);
      this.expense.push({
        id: 1,
        detail: this.expensedetail,
        amount: parseInt(this.expenseamount, 10),
        date: Date.now()
      });
    }
  },
  computed: {
    totalexpense() {
      let total = 0;
      this.expense.forEach(data => {
        total += data.amount;
      });
      this.$emit('totalexpense',total);
      return total;
    }
  }
};
</script>

<style>
</style>