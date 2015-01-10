<style>
.ui-listview-filter-inset {
    margin-top: 0;
}
</style>


<div data-role="page" id="page1">
	<div data-role="header">
		<h1>Find Trains</h1>
	</div>

	<div data-role="main" class="ui-content">
		<table>
			<tr>
				<td>
					<ul id="fromStation" data-role="listview" data-filter="true"
						data-inset="true" data-filter-reveal="true"
						data-filter-placeholder="From">
					</ul>
				</td>
			</tr>
			<tr>
				<td><input id="toStation" type="text" /></td>
			</tr>
			<tr>
				<td><button class="ui-btn">Button</button></td>
			</tr>
		</table>

	</div>

	<!-- <div data-role="footer">
    <h1>Footer Text</h1>
  </div> -->



</div>

<script type="text/javascript">
$( document ).on( "pageinit", "#page1", function() {
    $( "#fromStation" ).on( "listviewbeforefilter", function ( e, data ) {
        var $ul = $( this ),
            $input = $( data.input ),
            value = $input.val(),
            html = "";
        $ul.html( "" );
        if ( value && value.length > 2 ) {
            $ul.html( "<li><div class='ui-loader'><span class='ui-icon ui-icon-loading'></span></div></li>" );
            $ul.listview( "refresh" );
            $.ajax({
                url: "stations",
                dataType: "json",
                data: {
                    q: $input.val()
                }
            })
            .then( function ( response ) {
                $.each( response, function ( i, val ) {console.log(val);
                    html += "<li>" + val.NAME + "</li>";
                });
                $ul.html( html );
                $ul.listview( "refresh" );
                $ul.trigger( "updatelayout");
            });
        }
    });
});
</script>