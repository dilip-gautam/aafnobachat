
<template>
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="p-2 bd-highlight">payings Detail</div>
          <div class="d-flex">
            <div class="p-2 bd-highlight">Rs {{totalpaying}}</div>
            <b-button class="btn btn-success" v-b-modal.modal-3>Add</b-button>

            <b-modal id="modal-4" hide-footer="true" title="Add Details">
              <form @submit.prevent="addpayings">
                <div class="form-group">
                  <label for="item name">Item Name</label>
                  <input type="text" class="form-control" id="item name" v-model="payingdetail" />
                </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input
                    type="number"
                    class="form-control"
                    id="payingamount"
                    v-model="payingamount"
                  />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </b-modal>
          </div>
        </h5>
        <div class="d-flex justify-content-between" v-for="data in paying" :key="data.id">
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
      payingdetail: "",
      payingamount: "",
      paying: [
        {
          id: 1,
          detail: "Bishal Gaire",
          amount: 250,
          date: Date.now()
        },
        {
          id: 2,
          detail: "Ankit Karki",
          amount: 150,
          date: Date.now()
        },
        {
          id: 3,
          detail: "Alima Subedi",
          amount: 100,
          date: Date.now()
        }
      ]
    };
  },
  methods: {
    addpayings() {
      console.log(this.payingdetail);
      console.log(typeof this.payingamount);
      this.paying.push({
        id: 1,
        detail: this.payingdetail,
        amount: parseInt(this.payingamount, 10),
        date: Date.now()
      });
    }
  },
  computed: {
    totalpaying() {
      let total = 0;
      this.paying.forEach(data => {
        total += data.amount;
      });
      this.$emit('totalpaying',total);
      return total;
    }
  }
};
</script>

<style>
</style>