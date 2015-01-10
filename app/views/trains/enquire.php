<div id="searchDiv" onload="">
	From: <input id="fromStation" type="text" class="auto_station" /><input
		id="fromStationId" type="hidden" /> 
		
	To: <input id="toStation"
		type="text" class="auto_station" /><input id="toStationId"
		type="hidden" />
	<button id="search" type="submit">Find</button>
</div>

<div id="resultDiv" style="width: 80%;">
	<table id="performanceReportTable">
		<thead>
			<tr>
				<th>Dep</th>
				<th>Train No</th>
				<th>Train Name</th>
				<th>Arr</th>
				<th>Time</th>
				<th>Dist</th>
				<th>Rundays</th>
			</tr>
		</thead>
	</table>
</div>


<script type="text/javascript" src="app/public/js/trains/api.js"></script>
<script type="text/javascript">
$(function() {
	var _stations = new Array();
	var searchUrl = "rail/search";
	
	$.getJSON('rail/stations', 
		function(stations) {
			//_stations = stations;
			var station;
			stations.forEach(function(station) {
				//console.log(station);
				stn = new Object;
				stn.label = station.NAME;
				stn.id = station.ID
				_stations.push(stn);
			});
		}, 
		'success'
	);

    $(".auto_station").autocomplete({
        source: _stations,
        open: function( event, ui ) {}
    })
    .on( "autocompleteselect", 
    	function( event, ui ) {
        	//$('#fromStationId').val(ui.content[0].id);
        	$('#'+event.currentTarget.id+'Id').val(ui.item.id);
        } 
    );

    $("#search").click(
    	function() {
    		searchUrl = searchUrl+'?from='+$("#fromStationId").val()+"&to="+$("#toStationId").val();
    		table.fnReloadAjax(searchUrl);
    		//alert( 'Data source: '+table.ajax.url() );
        	/* $.getJSON('trains/search?from='+$("#fromStationId").val()+"&to="+$("#toStationId").val(), 
        			function(trains) {
        				trains.forEach(function(train) {
            				console.log(train);
        				});
        			}, 
        			'success'
        		); */
        }
    );

    var table = $("#performanceReportTable").dataTable({
        	"sAjaxSource": '',
	    	"aoColumns" : [ 
				{
					"mData" : "DEP",
				}, {
					"mData" : "TRAIN_ID",
				}, {
					"mData" : "NAME",
				}, {
					"mData" : "ARR",
				}, {
					"mData" : "TIME",
				}, {
					"mData" : "DIST",
				} , {
					"mData" : "RUNDAYS",
				} 
			]
        });
});
</script>