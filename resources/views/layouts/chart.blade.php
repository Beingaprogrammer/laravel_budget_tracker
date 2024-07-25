<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
$(document).ready(function() {

	// Area chart - Admin

	  var options = {
          series: [{{$totalExpenses}},{{$totalIncome}},{{$balance}}],
          chart: {
          height: 350,
			width: '100%',
          type: 'pie',
        },
        labels: ['Expense','Income','Amount'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#ALL_DETAILS"), options);
        chart.render();

// Expense and Income
        var options = {
          series: [{{$totalExpenses}},{{$totalIncome}}],
          chart: {
          height: 350,
			width: '100%',
          type: 'donut',
        },
         labels: [{{$totalExpenses}},{{$totalIncome}}],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#incomeexpenses"), options);
        chart.render();


	
	
	
	


	
	


});


</script>