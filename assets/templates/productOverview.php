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
				<div class="card-partNum small-12 column">
					<p class="card-pn" ng-show="setP.partNum"><b>Part # : </b><span ng-bind-html="setP.partNum"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class="card-title" ng-show="setP.title"><b><span ng-bind-html="setP.title"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></b></p>
					<p class="card-description" ng-show="setP.description1"><span ng-bind-html="setP.description1"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class="card-description" ng-show="setP.description2"><span ng-bind-html="setP.description2"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				
				
				<!-- FLASKS -->
				<div class="card-left small-12 medium-6 column" ng-show="isFlask">
					<p ng-show="setP.minVolume"><b>Min Working Volume : </b><span ng-bind-html="setP.minVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.maxVolume"><b>Max Working Volume : </b><span ng-bind-html="setP.maxVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.shakeSpeed"><b>Average Shake Speed: </b><span ng-bind-html="setP.shakeSpeed"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				<div class="card-right small-12 medium-6 column" ng-show="isFlask">
					<p ng-show="setP.membrane"><b>Vent Cap : </b><span ng-bind-html="setP.membrane"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span> | <span ng-bind-html="setP.poreSize"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.accessories[0]"><b>Accessories : </b><span ng-repeat="l in setP.accessories"><a class="card-link" href="{{ l.url }}">{{ l.link }}</a></span></p>
					<p><b>Sterile : </b><span ng-bind-html="setP.sterile | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				
				
				<!-- FILTER VIALS -->
				<div class="card-left small-12 medium-6 column" ng-show="isVial">
					<p ng-show="setP.maxVolume"><b>Fill Volume : </b><span ng-bind-html="setP.maxVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.minVolume"><b>Dead Volume : </b><span ng-bind-html="setP.minVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.membrane"><b>Filter : </b><span ng-bind-html="setP.membrane"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span> | <span ng-bind-html="setP.poreSize"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				<div class="card-right small-12 medium-6 column" ng-show="isVial">
					<p ng-show="setP.accessories[0]"><b>Accessories : </b><span ng-repeat="l in setP.accessories"><a class="card-link" href="{{ l.url }}">{{ l.link }}</a></span></p>
					<p><b>Sterile : </b><span ng-bind-html="setP.sterile | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				
				
				<!-- OTHER -->
				<div class="card-left small-12 medium-6 column" ng-show="isOther">
					<p ng-show="setP.maxVolume"><b>Fill Volume : </b><span ng-bind-html="setP.maxVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.minVolume"><b>Dead Volume : </b><span ng-bind-html="setP.minVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.membrane"><b>Filter : </b><span ng-bind-html="setP.membrane"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span> | <span ng-bind-html="setP.poreSize"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				<div class="card-right small-12 medium-6 column" ng-show="isOther">
					<p ng-show="setP.accessories[0]"><b>Accessories : </b><span ng-repeat="l in setP.accessories"><a class="card-link" href="{{ l.url }}">{{ l.link }}</a></span></p>
					<p><b>Sterile : </b><span ng-bind-html="setP.sterile | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				
				
				<!-- WELL PLATES -->
				<div class='card-left column small-12 medium-6' ng-show="isPlate">
					<p ng-hide='notAplate'><b>No. of Wells : </b><span ng-bind-html="setP.wellCount"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span> | <b>Well Vol. : </b><span ng-bind-html="setP.wellVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class='card-stop' ng-hide='notAplate'><b>Well Shape : </b><img src='../wp-content/themes/TIC/images/plate-icons-{{ setP.wellShape }}.png' width=25 height=38 /></p>
				</div>
				<div class='card-right column small-12 medium-6' ng-show="isPlate">
					<p><b>ANSI-SLAS : </b><span ng-bind-html="setP.ANSI-SLAS | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p><b>Sterile : </b><span ng-bind-html="setP.sterile | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show='setP.filter'><b>Filter : </b><span ng-bind-html="setP.filter"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show='setP.collectionPlate'><b>Collection Plate : </b><span ng-bind-html="setP.collectionPlate"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p><b>Works with : </b><span ng-bind-html="setP.worksWith | tostring"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show='setP.notes'><b>Notes : </b><span ng-bind-html="setP.notes"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
			
			</div>
		</div>
	</div>
</div>