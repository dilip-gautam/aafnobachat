<template>
  <div class="col">
    <div class="card shadow earning-card mt-2">
      <div class="card-body">
        <h5 class="d-flex justify-content-between">
          <div class="card-title p-2">Earnings Detail</div>
          <div class="d-flex">
            <div class="card-total p-2 bd-highlight">{{ totalearning | toCurrency}}</div>
            <b-button class="btn btn-info btn-add" v-b-modal.modal-1>Add</b-button>

            <!-- add a data -->
            <b-modal ref="modal-first" id="modal-1" hide-footer title="Add Details">
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

            <!-- update a data -->
            <b-modal ref="modal-firstU" id="modal-1U" hide-footer title="Add Details">
              <form @submit.prevent="updateEarning">
                <div class="form-group">
                  <label for="item name">Item Name</label>
                  <input type="text" class="form-control" id="item name" v-model="earningdetail" />
                </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input
                    type="number"
                    class="form-control"
                    id="earningamount"
                    v-model="earningamount"
                  />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </b-modal>
          </div>
        </h5>
        <div v-for="data in earning" :key="data.id">
          <div class="d-flex justify-content-between">
            <span>{{ data.items }}</span>
            <span>{{ data.amount | toCurrency }}</span>
          </div>
          <div class="d-flex justify-content-between">
            <span class="trans-date">{{ new Date(data.created_at) | formatDate }}</span>
            <span>
              <a class="p-2" @click="editItem(data.id)">
                <font-awesome-icon icon="edit" />
              </a>
              <a class="p-2" @click="deleteItem(data.id)">
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
      earning: [],
      earningdetail: null,
      earningamount: null
    };
  },
  methods: {
    addEarnings() {
      axios
        .post("/earning", {
          items: this.earningdetail,
          amount: this.earningamount
        })
        .then(response => {
          this.earning.push(response.data.data);
          this.$refs["modal-first"].hide();
        });
      (this.earningdetail = null), (this.earningamount = null);
    },
    hideModal() {
      this.$refs["modal-first"].hide();
    },
    editItem(value) {
      axios.get("/earning/" + value).then(response => {
        // console.log(response.data.data.id)
        (this.index = response.data.data.id),
          (this.earningdetail = response.data.data.items),
          (this.earningamount = response.data.data.amount);
      });
      this.$refs["modal-firstU"].show();
    },
    updateEarning() {
      axios
        .patch("/earning/" + this.index, {
          items: this.earningdetail,
          amount: this.earningamount
        })
        .then(response => {
          this.earning.forEach(element => {
            // console.log(element.id);
            // console.log(this.index)
            if (element.id == this.index) {
              // console.log('a');
              // console.log('ab');
              element.items = this.earningdetail;
              element.amount = this.earningamount;
            }
          });
          this.$refs["modal-firstU"].hide();
        });
      // console.log('a');
      // console.log('aa');
    },
    deleteItem(value) {
      axios.delete("/earning/" + value).then(response => {
        this.earning.map((element, index) => {
          if (element.id == value) {
            this.earning.splice(index, 1);
          }
        });
      });
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
  mounted() {
    axios.get("/earning").then(response => {
      console.log(response.data.data);
      response.data.data.map(element => this.earning.push(element));
    });
  }
};
</script>

<style scoped>
.earning-card {
  border-top: 9px solid rgb(26, 139, 86, 0.25);
}
</style>