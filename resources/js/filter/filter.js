import Vue from 'vue'
import moment from 'moment'

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment((value)).format("MMM Do YY")
  }
});

Vue.filter('toCurrency', function (value) {
  if (typeof value !== "number") {
      return value;
  }
  var formatter = new Intl.NumberFormat('en-IN', {
      style: 'currency',
      currency: 'INR',
  });
  return formatter.format(value);
});
