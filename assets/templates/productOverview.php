<div class='hidden overlay'>
	<div class='overlay-content'>

		<div class='row'>
			
			<div class='medium-2 medium-offset-10'>
				<button class='close-overlay button tiny secondary'>close</button>
			</div>
			
			<div class='column small-3'>
				<img src='../../wp-content/uploads/products/{{ setP.partNum }}_lg.jpg' alt='Thomson part number # {{ setP.partNum }}'>
			</div>
			
			<div class='column small-9'>
				
				<!-- ALL HEADER -->
				<div class="small-12 column">
					<p class='card-partNum'><b>Part # : </b>{{ setP.partNum }}</p>
					<p><b>Description : </b>{{ setP.description1 }}</p>
					<p><b>Description : </b>{{ setP.description2 }}</p>
				</div>
				
				
				<!-- FLASKS -->
				<div class="small-12 medium-6 column" ng-show="isFlask">
					<p><b>Min Working Volume : </b>{{ setP.minVolume }}</p>
					<p><b>Max Working Volume : </b>{{ setP.maxVolume }}</p>
					<p><b>Average Shake Speed: </b>{{ setP.shakeSpeed }}</p>
				</div>
				<div class="small-12 medium-6 column" ng-show="isFlask">
					<p><b>Vent Cap : </b>{{ setP.membrane }} | {{ setP.poreSize }}</p>
					<p><b>Accessories : </b>{{ setP.accessories }}</p>
					<p><b>Sterile : </b>{{ setP.sterile }}</p>
				</div>
				
				
				<!-- FILTER VIALS -->
				<div class="small-12 medium-6 column" ng-show="isVial">
					<p><b>Fill Volume : </b>{{ setP.maxVolume }}</p>
					<p><b>Dead Volume : </b>{{ setP.minVolume }}</p>
					<p><b>Filter : </b>{{ setP.membrane }} | {{ setP.poreSize }}</p>
				</div>
				<div class="small-12 medium-6 column" ng-show="isVial">
					<p><b>Accessories : </b>{{ setP.accessories }}</p>
					<p><b>Sterile : </b>{{ setP.sterile }}</p>
				</div>
				
				
				<!-- OTHER -->
				<div class="small-12 medium-6 column" ng-show="isOther">
					<h2>other</h2>
					<p><b>Fill Volume : </b>{{ setP.maxVolume }}</p>
					<p><b>Dead Volume : </b>{{ setP.minVolume }}</p>
					<p><b>Filter : </b>{{ setP.membrane }} | {{ setP.poreSize }}</p>
				</div>
				<div class="small-12 medium-6 column" ng-show="isOther">
					<p><b>Accessories : </b>{{ setP.accessories }}</p>
					<p><b>Sterile : </b>{{ setP.sterile }}</p>
				</div>
				
				
				<!-- WELL PLATES -->
				<div class='column small-12 medium-6' ng-show="isPlate">
					<p ng-hide='notAplate'><b>No. of Wells : </b>{{ setP.wellCount }} | <b>Well Vol. : </b>{{ setP.wellVolume }}</p>
					<p class='card-stop' ng-hide='notAplate'><b>Well Shape : </b><img src='../wp-content/themes/TIC/images/plate-icons-{{ setP.wellShape }}.png' width=25 height=38 /></p>
				</div>
				<div class='column small-12 medium-6' ng-show="isPlate">
					<p><b>ANSI-SLAS : </b>{{ setP.ANSI-SLAS | yesNo }}</p>
					<p><b>Sterile : </b>{{ setP.sterile | yesNo }}</p>
					<p ng-show='setP.filter'><b>Filter : </b>{{ setP.filter }}</p>
					<p class='card-stop' ng-show='setP.collectionPlate'><b>Collection Plate : </b>{{ setP.collectionPlate }}</p>
					<p class='card-stop'><b>Works with : </b>{{ setP.worksWith | tostring }}</p>
					<p ng-show='setP.notes'><b>Notes : </b>{{ setP.notes }}</p>
				</div>
			
			</div>
		</div>
	</div>
</div>