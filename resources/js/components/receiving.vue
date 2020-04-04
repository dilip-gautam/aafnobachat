<template>
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="p-2 bd-highlight">reveives Detail</div>
          <div class="d-flex">
            <div class="p-2 bd-highlight">Rs {{totalreveive}}</div>
            <b-button class="btn btn-success" v-b-modal.modal-3>Add</b-button>

            <b-modal id="modal-3" hide-footer="true" title="Add Details">
              <form @submit.prevent="addreveives">
                <div class="form-group">
                  <label for="item name">Item Name</label>
                  <input type="text" class="form-control" id="item name" v-model="reveivedetail" />
                </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input
                    type="number"
                    class="form-control"
                    id="reveiveamount"
                    v-model="reveiveamount"
                  />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </b-modal>
          </div>
        </h5>
        <div class="d-flex justify-content-between" v-for="data in reveive" :key="data.id">
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
      reveivedetail: "",
      reveiveamount: "",
      reveive: [
        {
          id: 1,
          detail: "Hemant Dai",
          amount: 1500,
          date: Date.now()
        },
        {
          id: 2,
          detail: "Dilip Gautam",
          amount: 800,
          date: Date.now()
        },
        {
          id: 3,
          detail: "Jitendra Sharma",
          amount: 700,
          date: Date.now()
        }
      ]
    };
  },
  methods: {
    addreveives() {
      console.log(this.reveivedetail);
      console.log(typeof this.reveiveamount);
      this.reveive.push({
        id: 1,
        detail: this.reveivedetail,
        amount: parseInt(this.reveiveamount, 10),
        date: Date.now()
      });
    }
  },
  computed: {
    totalreveive() {
      let total = 0;
      this.reveive.forEach(data => {
        total += data.amount;
        this.$emit('totalreceiving',total);
      });
      return total;
    }
  }
};
</script>

<style>
</style>