<template>
  <div id="app">
    <div class="row">
      <div class="col-md-12">
        <div class="app-title">
          aafno
          <span class="bold">Bachat</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col d-flex justify-content-center final-insight-amount">
        <div class="insight-box">
          <div id="wallet-pic">
            <img src="../assets/img/wallet.png" alt />
          </div>
          <span style="font-size: 37px;"></span>
          {{ walletmoney | toCurrency }}
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="insight-card ic-exp">
          <span class="amt">
            {{ totalexpense | toCurrency }}
          </span>
          <span class="title mt-3">Expense</span>
          <div class="icon"></div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="insight-card ic-ear">
          <span class="amt">
            {{ totalearning | toCurrency }}
          </span>
          <span class="title mt-3">Earning</span>
          <div class="icon"></div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="insight-card ic-rec">
          <span class="amt">
            {{ totalreceiving | toCurrency }}
          </span>
          <span class="title mt-3">Receiving</span>
          <div class="icon"></div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="insight-card ic-pay">
          <span class="amt">
            {{ totalpaying | toCurrency }}
          </span>
          <span class="title mt-3">Paying</span>
          <div class="icon"></div>
        </div>
      </div>
    </div>

    <!-- <div class="home mt-3 mb-5">
      <h1 class="text-center">Rs.{{walletmoney}}</h1>
    </div>-->
    <!-- <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rs {{totalexpense}}</h5>
              <p class="card-text">Expense</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rs {{totalearning}}</h5>
              <p class="card-text">Earnings</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rs {{totalreceiving}}</h5>
              <p class="card-text">Receiving</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rs {{totalpaying}}</h5>
              <p class="card-text">Paying</p>
            </div>
          </div>
        </div>
      </div>
    </div>-->
    <div class="container mt-4">
      <div class="row">
        <earning @totalearning="earning" :key="index"></earning>
        <expense @totalexpense="expense" :key="index"></expense>
      </div>
      <div class="row">
        <receive @totalreceive="receiving" :key="index"></receive>
        <paying @totalpaying="paying" :key="index"></paying>
      </div>
    </div>
  </div>
</template>
<script>
import earning from "../components/earning";
import expense from "../components/expense";
import receive from "../components/receiving";
import paying from "../components/paying";
export default {
  components: {
    earning,
    expense,
    receive,
    paying
  },
  data() {
    return {
      index: 0,
      totalearning: "",
      totalexpense: "",
      totalreceiving: "",
      totalpaying: ""
    };
  },
  methods: {
    earning(e) {
      this.totalearning = parseInt(e, 10);
    },
    expense(e) {
      this.totalexpense = parseInt(e, 10);
    },
    receiving(e) {
      this.totalreceiving = parseInt(e, 10);
    },
    paying(e) {
      this.totalpaying = parseInt(e, 10);
    },
    rerun() {
      this.index += 1;
    }
  },
  computed: {
    walletmoney() {
      return (
        this.totalearning +
        this.totalreceiving -
        this.totalexpense -
        this.totalpaying
      );
    }
  }
};
</script>
<style scoped>
.final-insight-amount {
  color: #fff;
  font-size: 48px;
  margin-bottom: 85px;
}

.insight-box {
  background-color: rgba(0, 168, 112, 0.3);
  padding: 9px 55px;
  border-radius: 15px;
}

/* #wallet-pic::after{
    content: url('../../assets/img/wallet.png');
    display: inline-block;
    margin-right: 30px;
} */

#wallet-pic {
  margin-right: 30px;
  height: 38px;
  display: inline-block;
}

#wallet-pic img {
  height: 100%;
  object-fit: cover;
}

.insight-card {
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
  background-color: #fff;
  color: #676767;
  height: 194px;
  border-radius: 10px;
  font-size: 24px;
  font-weight: 500;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  /* width: 90%; */
}

.insight-card .amt {
  font-size: 36px;
  line-height: 20px;
}

.insight-card .rs {
  font-size: 20px;
}

.ic-exp .amt {
  color: #f12944;
}
.ic-ear .amt {
  color: #1a8b56;
}
.ic-rec .amt {
  color: #f1bc29;
}
.ic-pay .amt {
  color: #f129bc;
}

.icon {
  width: 60px;
  height: 60px;
  display: inline-block;
  position: absolute;
  bottom: 10px;
  left: 10px;
}

.ic-exp .icon {
  background: url("../assets/img/exp-icon.png") no-repeat;
}
.ic-ear .icon {
  background: url("../assets/img/ear-icon.png") no-repeat;
}
.ic-rec .icon {
  background: url("../assets/img/rec-icon.png") no-repeat;
}
.ic-pay .icon {
  background: url("../assets/img/pay-icon.png") no-repeat;
}
</style>