<template>
  <div id="app">
    <div class="container">
      <!-- <div id="nav">
        <router-link to="/">aafnoBachat</router-link>
      </div>
    </div>
      <router-view />-->
      <Home></Home>
    </div>
  </div>
</template>

<script>
import Home from "./views/Home";
export default {
  components: {
    Home
  }
};
</script>

<style>
</style>
