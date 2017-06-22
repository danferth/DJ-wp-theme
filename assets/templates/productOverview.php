<div class="hidden overlay-wrap">

	<div class='overlay-content animated row medium-collapse'>

			
	<span class='close-overlay show-for-large-up'><i class="fa fa-close"></i></span>
	<span class='close-overlay-mobile show-for-small-up hide-for-large-up'>close</span>

			
			<div class='card-image small-12 medium-3 column'>
				<img src='../../wp-content/uploads/products/{{ setP.partNum }}_lg.jpg?v=001' alt='Thomson part number # {{ setP.partNum }}'>
			</div>
			
			<div class='overlay-main column small-12 medium-9'>
				
				<!-- ALL HEADER -->
				<div class="card-partNum small-12 column">
					<p class="card-pn" ng-show="setP.partNum"><b>Part #: </b><span ng-bind-html="setP.partNum"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class="card-title" ng-show="setP.title"><b><span ng-bind-html="setP.title"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></b></p>
					<p class="card-description" ng-show="setP.description1"><span ng-bind-html="setP.description1"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class="card-description" ng-show="setP.description2"><span ng-bind-html="setP.description2"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				
				
				<!-- FLASKS -->
				<div class="card-left small-12 medium-6 column" ng-show="isFlask">
					<p ng-show="setP.minVolume"><b>Min Working Volume: </b><span ng-bind-html="setP.minVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.maxVolume"><b>Max Working Volume: </b><span ng-bind-html="setP.maxVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.shakeSpeed"><b>Shake Speed RPM Range: </b><span ng-bind-html="setP.shakeSpeed"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				<div class="card-right small-12 medium-6 column" ng-show="isFlask">
					<p ng-show="setP.membrane"><b>Vent Cap: </b><span ng-bind-html="setP.membrane"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span> | <span ng-bind-html="setP.poreSize"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p><b>Sterile: </b><span ng-bind-html="setP.sterile | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class="card-accessories" ng-show="setP.accessories[0]"><b>Accessories</b><br/><span ng-repeat="l in setP.accessories"><a href="{{ l.url }}" ng-bind-html="l.link"></a><br/></span></p>
				</div>
				
				
				<!-- FILTER VIALS -->
				<div class="card-left small-12 medium-6 column" ng-show="isVial">
					<p ng-show="setP.maxVolume"><b>Fill Volume: </b><span ng-bind-html="setP.maxVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.minVolume"><b>Dead Volume: </b><span ng-bind-html="setP.minVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.membrane"><b>Filter: </b><span ng-bind-html="setP.membrane"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span> | <span ng-bind-html="setP.poreSize"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				<div class="card-right small-12 medium-6 column" ng-show="isVial">
					<p><b>Sterile: </b><span ng-bind-html="setP.sterile | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class="card-accessories" ng-show="setP.accessories[0]"><b>Accessories</b><br/><span ng-repeat="l in setP.accessories"><a href="{{ l.url }}" ng-bind-html="l.link"></a><br/></span></p>
				</div>
				
				
				<!-- TC -->
				<div class="card-left small-12 medium-6 column" ng-show="isTC">
					<p ng-show="setP.direction"><b>Type: </b><span ng-bind-html="setP.direction"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.flask"><b>Flask Compatibility: </b><span ng-bind-html="setP.flask | tostring"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.connection"><b>Connection: </b><span ng-bind-html="setP.connection"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				<div class="card-right small-12 medium-6 column" ng-show="isTC">
					<p><b>Sterile: </b><span ng-bind-html="setP.sterile | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class="card-accessories" ng-show="setP.accessories[0]"><b>Accessories</b><br/><span ng-repeat="l in setP.accessories"><a href="{{ l.url }}" ng-bind-html="l.link"></a><br/></span></p>
				</div>
				
				
				<!-- OTHER -->
				<div class="card-left small-12 medium-6 column" ng-show="isOther">
					<p ng-show="setP.maxVolume"><b>Fill Volume: </b><span ng-bind-html="setP.maxVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.minVolume"><b>Dead Volume: </b><span ng-bind-html="setP.minVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show="setP.membrane"><b>Filter: </b><span ng-bind-html="setP.membrane"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span> | <span ng-bind-html="setP.poreSize"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				<div class="card-right small-12 medium-6 column" ng-show="isOther">
					<p><b>Sterile: </b><span ng-bind-html="setP.sterile | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class="card-accessories" ng-show="setP.accessories[0]"><b>Accessories</b><br/><span ng-repeat="l in setP.accessories"><a href="{{ l.url }}" ng-bind-html="l.link"></a><br/></span></p>
					<p ng-show='setP.worksWith'><b>Works with: </b><span ng-bind-html="setP.worksWith | tostring"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show='setP.notes'><b>Notes: </b><span ng-bind-html="setP.notes"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
				
				
				<!-- WELL PLATES -->
				<div class='card-left column small-12 medium-6' ng-show="isPlate">
					<p ng-hide='notAplate'><b>No. of Wells: </b><span ng-bind-html="setP.wellCount"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span><br/><b>Well Vol.: </b><span ng-bind-html="setP.wellVolume"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p class='card-stop' ng-hide='notAplate'><b>Well Shape: </b><img src='../wp-content/themes/TIC/images/plate-icons-{{ setP.wellShape[0] }}.png' width=25 height=38 /></p>
				</div>
				<div class='card-right column small-12 medium-6' ng-show="isPlate">
					<p><b>ANSI-SLAS: </b><span ng-bind-html="setP.ANSI-SLAS | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p><b>Sterile: </b><span ng-bind-html="setP.sterile | yesNo"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show='setP.filter'><b>Filter: </b><span ng-bind-html="setP.filter"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show='setP.collectionPlate'><b>Collection Plate: </b><span ng-bind-html="setP.collectionPlate"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p><b>Works with: </b><span ng-bind-html="setP.worksWith | tostring"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
					<p ng-show='setP.notes'><b>Notes: </b><span ng-bind-html="setP.notes"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></p>
				</div>
			
			</div>
		</div>
		
	<div class='overlay'></div>
	
</div>