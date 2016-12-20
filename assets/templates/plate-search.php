<div class='hidden overlay show-for-medium-up'>
	<div class='overlay-content'>

		<div class='row'>
			
			<div class='medium-2 medium-offset-10'>
				<button class='close-overlay button tiny secondary'>close</button>
			</div>
			
			<div class='column small-3'>
				<img src='../wp-content/uploads/products/{{ set.partNum }}_lg.jpg' alt='Thomson well plate part number # {{ set.partNum }}'>
			</div>

			<div class='column small-5'>
				<p class='card-partNum'><b>Part # : </b>{{ set.partNum }}<br/>
					<b>Qty/case : </b>{{ set.qty }}</p>
				<p class='card-stop'><b>Description : </b>{{ set.description }}</p>
				<p ng-hide='notAplate'><b>No. of Wells : </b>{{ set.wellCount }} | <b>Well Vol. : </b>{{ set.wellVolume }}</p>
				<p class='card-stop' ng-hide='notAplate'><b>Well Shape : </b><img src='../wp-content/themes/TIC/images/plate-icons-{{ set.wellShape }}.png' width=25 height=38 /></p>
			</div>
			<div class='column small-4'>
				<p><b>ANSI-SLAS : </b>{{ set.ANSI-SLAS | yesNo }}</p>
				<p><b>Sterile : </b>{{ set.sterile | yesNo }}</p>
				<p ng-show='set.filter'><b>Filter : </b>{{ set.filter }}</p>
				<p class='card-stop' ng-show='set.collectionPlate'><b>Collection Plate : </b>{{ set.collectionPlate }}</p>
				<p class='card-stop'><b>Works with : </b>{{ set.worksWith | tostring }}</p>
				<p ng-show='set.notes'><b>Notes : </b>{{ set.notes }}</p>
			</div>
			
		</div>

	</div>
</div>