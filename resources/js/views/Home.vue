<template>
  <div id="app">
    <div class="home mt-5 mb-5">
      <h1 class="text-center">Rs.{{walletmoney}}</h1>
    </div>
    <div class="container">
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
    </div>
    <div class="container mt-4">
      <div class="row">
         <earning @totalearning="earning"></earning>  
         <expense @totalexpense="expense"></expense>
      </div>
      <div class="row mt-4">
        <receive @totalreceive="receiving"></receive>
        <paying @totalpaying="paying"></paying>
      </div>
    </div>
  </div>
</template>
<script>
import earning from '../components/earning';
import expense from '../components/expense';
import receive from '../components/receiving';
import paying from '../components/paying';
export default {
  components: {
    earning,
    expense,
    receive,
    paying,
  },
  data(){
    return{
      totalearning:'',
      totalexpense:'',
      totalreceiving:'',
      totalpaying:''
    }
  },
  methods:{
    earning(e){
        this.totalearning = parseInt(e,10);
    },
     expense(e){
        this.totalexpense = parseInt(e,10);
    },
     receiving(e){
        this.totalreceiving = parseInt(e,10);
    },
     paying(e){
        this.totalpaying = parseInt(e,10);
    }
  },
  computed:{
    walletmoney(){
      return this.totalearning+this.totalreceiving-this.totalexpense-this.totalpaying
    }
  }
};
</script>
