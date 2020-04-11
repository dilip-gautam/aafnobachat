<template>
  <div class="col">
    <div class="card shadow paying-card">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="card-title p-2 bd-highlight">Paying Detail</div>
          <div class="d-flex">
            <div class="card-total p-2 bd-highlight">{{totalpaying | toCurrency}}</div>
            <b-button class="btn btn-info btn-add" v-b-modal.modal-3>Add</b-button>

            <!-- add a data -->
            <b-modal ref="modal-third" id="modal-4" hide-footer title="Add Details">
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

            <!-- update a data -->
            <b-modal ref="modal-thirdU" id="modal-3U" hide-footer title="Add Details">
              <form @submit.prevent="updatePaying">
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
            <div class="p-2 bd-highlight">{{ data.amount | toCurrency }}</div>
          </div>
          <div class="d-flex justify-content-between">
            <span class="trans-date">{{ new Date(data.created_at) | formatDate }}</span>
            <span>
              <a class="p-2" @click="editPaying(data.id)">
                <font-awesome-icon icon="edit" />
              </a>
              <a class="p-2" @click="deletePaying(data.id)">
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
          // this.$parent.rerun();
          this.paying.push(response.data.data);
          this.$refs["modal-third"].hide();
        });
      (this.payingdetail = null), (this.payingamount = null);
    },
    hideModal() {
      this.$refs["test"].hide();
    },
    editPaying(value) {
      axios.get("/paying/" + value).then(response => {
        (this.index = response.data.data.id),
          (this.payingdetail = response.data.data.items),
          (this.payingamount = response.data.data.amount);
      });
      this.$refs["modal-thirdU"].show();
    },
    updatePaying() {
      axios
        .patch("/paying/" + this.index, {
          items: this.payingdetail,
          amount: this.payingamount
        })
        .then(response => {
          this.paying.forEach(element => {
            if (element.id == this.index) {
              element.items = this.payingdetail;
              element.amount = this.payingamount;
            }
          });

          this.$refs["modal-thirdU"].hide();
        });
    },
    deletePaying(value) {
      axios.delete("/paying/" + value).then(response => {
        this.paying.map((element, index) => {
          if (element.id == value) {
            this.paying.splice(index, 1);
          }
        });
      });
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