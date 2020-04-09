
<template>
  <div class="col">
    <div class="card shadow paying-card">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="card-title p-2 bd-highlight">Paying Detail</div>
          <div class="d-flex">
            <div class="card-total p-2 bd-highlight">Rs {{totalpaying}}</div>
            <b-button class="btn btn-info btn-add" v-b-modal.modal-3>Add</b-button>

            <b-modal id="modal-4" hide-footer title="Add Details">
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
        <div v-for="data in paying" :key="data.id">
          <div class="d-flex justify-content-between">
            <div class="p-2 bd-highlight">{{ data.items }}</div>
            <div class="p-2 bd-highlight">{{ data.amount }}</div>
          </div>
          <span class="trans-date">{{ new Date(data.created_at) | formatDate }}</span>
          <hr/>
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
      paying: [],
      payingdetail: null,
      payingamount: null
    };
  },
  methods: {
    addpayings() {
      axios
        .post("/paying", {
          items: this.payingdetail,
          amount: this.payingamount
        })
        .then(response => {
          console.log(response);
        });
      (this.payingdetail = null), (this.payingamount = null);
    },
    hideModal() {
      this.$refs["test"].hide();
    }
  },
  computed: {
    totalpaying() {
      let total = 0;
      this.paying.map(data => {
        total += data.amount;
      });
      this.$emit("totalpaying", total);
      return total;
    }
  },
  watch: {},
  mounted() {
    axios.get("/paying").then(response => {
      response.data.map(element => this.paying.push(element));
    });
  }
};
</script>

<style scoped>
.paying-card {
  border-top: 9px solid rgb(241, 41, 188, 0.25);
}
</style>