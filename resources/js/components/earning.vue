<template>
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="p-2 bd-highlight">Earnings Detail</div>
          <div class="d-flex">
            <div class="p-2 bd-highlight">Rs {{totalearning}}</div>
            <b-button class="btn btn-success" v-b-modal.modal-1>Add</b-button>

            <b-modal ref="test" id="modal-1" title="Add Details">
              <form @submit.prevent="addEarnings">
                <div class="form-group">
                  <label for="item name">Item Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="item name"
                    v-model="earningdetail"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input
                    type="number"
                    class="form-control"
                    id="expenseamount"
                    v-model="earningamount"
                    required
                  />
                </div>
                <button type="submit" class="btn btn-primary" @click="hideModal">Submit</button>
              </form>
            </b-modal>
          </div>
        </h5>
        <div class="d-flex justify-content-between" v-for="data in earning" :key="data.id">
          <div class="p-2 bd-highlight">{{ data.item }}</div>
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
      earning: [],
      earningdetail: null,
      earningamount: null,
    };
  },
  methods: {
    addEarnings() {
      axios.post('/earning',{
        items: this.earningdetail,
        amount: this.earningamount,
      })
      .then(response => {
        console.log(response);
      });
      (this.earningdetail = null), (this.earningamount = null);
    },
    hideModal() {
      this.$refs["test"].hide();
    }
  },
  computed: {
    totalearning() {
      let total = 0;
      this.earning.map(data => {
        total += data.amount;
      });
      this.$emit("totalearning", total);
      return total;
    }
  },
  watch: {},
  mounted(){
    axios.get('/earning')
    .then(response => {
      console.log(response.data.data)
      response.data.data.map(element=>
      this.earning.push(element));
    })
  }
  
};
</script>

<style>
</style>