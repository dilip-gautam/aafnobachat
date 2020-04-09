<template>
  <div class="col">
    <div class="card shadow receiving-card">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="card-title p-2 bd-highlight">Receive Detail</div>
          <div class="d-flex">
            <div class="card-total p-2 bd-highlight">Rs {{totalreceive}}</div>
            <b-button class="btn btn-info btn-add" v-b-modal.modal-3>Add</b-button>

            <b-modal id="modal-3" hide-footer title="Add Details">
              <form @submit.prevent="addreceives">
                <div class="form-group">
                  <label for="item name">Item Name</label>
                  <input type="text" class="form-control" id="item name" v-model="receivedetail" />
                </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input
                    type="number"
                    class="form-control"
                    id="receiveamount"
                    v-model="receiveamount"
                  />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </b-modal>
          </div>
        </h5>
        <div v-for="data in receive" :key="data.id">
          <div class="d-flex justify-content-between">
            <div class="p-2 bd-highlight">{{ data.items }}</div>
            <div class="p-2 bd-highlight">{{ data.amount }}</div>
          </div>
          <span class="trans-date">{{ new Date(data.created_at) | formatDate }}</span>
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
      receive: [],
      receivedetail: null,
      receiveamount: null
    };
  },
  methods: {
    addreceives() {
      axios
        .post("/receive", {
          items: this.receivedetail,
          amount: this.receiveamount
        })
        .then(response => {
          console.log(response);
        });
      (this.receivedetail = null), (this.receiveamount = null);
    },
    hideModal() {
      this.$refs["test"].hide();
    }
  },
  computed: {
    totalreceive() {
      let total = 0;
      this.receive.map(data => {
        total += data.amount;
      });
      this.$emit("totalreceive", total);
      return total;
    }
  },
  watch: {},
  mounted() {
    axios.get("/receive").then(response => {
      response.data.map(element => this.receive.push(element));
    });
  }
};
</script>

<style scoped>
.receiving-card {
  border-top: 9px solid rgb(241, 188, 41, 0.25);
}
</style>