<template>
  <div class="col">
    <div class="card shadow receiving-card">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="card-title p-2 bd-highlight">Receive Detail</div>
          <div class="d-flex">
            <div class="card-total p-2 bd-highlight">{{totalreceive | toCurrency}}</div>
            <b-button class="btn btn-info btn-add" v-b-modal.modal-3>Add</b-button>
            <!-- add data -->
            <b-modal ref="modal-fourth" id="modal-3" hide-footer title="Add Details">
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
            <!-- update a data -->
            <b-modal ref="modal-fourthU" id="modal-4U" hide-footer title="Add Details">
              <form @submit.prevent="updateReceive">
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
            <div class="p-2 bd-highlight">{{ data.amount | toCurrency }}</div>
          </div>
          <div class="d-flex justify-content-between">
            <span class="trans-date">{{ new Date(data.created_at) | formatDate }}</span>
            <span>
              <a class="p-2" @click="editReceive(data.id)">
                <font-awesome-icon icon="edit" />
              </a>
              <a class="p-2" @click="deleteReceive(data.id)">
                <font-awesome-icon icon="trash" />
              </a>
            </span>
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
      index: 0,
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
          this.receive.push(response.data.data);
          this.$refs["modal-fourth"].hide();
        });
      (this.receivedetail = null), (this.receiveamount = null);
    },
    hideModal() {
      this.$refs["test"].hide();
    },
    editReceive(value) {
      axios.get("/receive/" + value).then(response => {
        (this.index = response.data.data.id),
          // console.log(response.data.data.items);
          (this.receivedetail = response.data.data.items),
          (this.receiveamount = response.data.data.amount);
      });
      this.$refs["modal-fourthU"].show();
    },
    updateReceive() {
      axios
        .patch("/receive/" + this.index, {
          items: this.receivedetail,
          amount: this.receiveamount
        })
        .then(response => {
          this.receive.forEach(element => {
            if (element.id == this.index) {
              element.items = this.receivedetail;
              element.amount = this.receiveamount;
            }
          });
          this.$refs["modal-fourthU"].hide();
        });
    },
    deleteReceive(value) {
      axios.delete("/receive/" + value).then(response => {
        this.receive.map((element, index) => {
          if (element.id == value) {
            this.receive.splice(index, 1);
          }
        });
      });
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