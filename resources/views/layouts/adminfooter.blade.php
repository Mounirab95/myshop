<div class="col-sm-12">
				<p class="back-link">Le site creer par |MA</p>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
	<script src="{{asset('frontendadmin')}}/js/jquery-1.11.1.min.js"></script>
	<script src="{{asset('frontendadmin')}}/js/bootstrap.min.js"></script>
	<script src="{{asset('frontendadmin')}}/js/chart.min.js"></script>
	<script src="{{asset('frontendadmin')}}/js/chart-data.js"></script>
	<script src="{{asset('frontendadmin')}}/js/easypiechart.js"></script>
	<script src="{{asset('frontendadmin')}}/js/easypiechart-data.js"></script>
	<script src="{{asset('frontendadmin')}}/js/bootstrap-datepicker.js"></script>
	<script src="{{asset('frontendadmin')}}/js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>