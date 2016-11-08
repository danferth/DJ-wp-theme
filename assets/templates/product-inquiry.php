<div class="product-inquiry-module small-12 column" ng-controller="inquiryController">

	<div class="product-inquiry small-12 column">
		<button class="product-inquiry-button buttom expand" data-text="Get a Sample">Get a Sample</button>
		<form class="product-inquiry-form" id="product-inquiry-sample" action="/wp-content/themes/TIC/form-parse/parse-product-inquiry.php" method="POST">
			<fieldset class="on-page-form">
				<div class="small-12 medium-6 column">
					<span id="first-name">
            <input type="text" name="first-name" placeholder="First Name*" ng-value="first_name" required/>
          </span>
				</div>
				<div class="small-12 medium-6 column">
					<span id="last-name">
            <input type="text" name="last-name" placeholder="Last Name*" ng-value="last_name" required/>
          </span>
				</div>
				<div class="small-12 medium-8 column">
					<span id="email">
            <input type="email" name="email" placeholder="Email*" ng-value="email" required/>
          </span>
				</div>
				<div class="small-12 medium-4 column">
					<span id="zip-code">
            <input type="text" name="zip-code" placeholder="Zip Code*" ng-value="zip_code" required/>
          </span>
				</div>
				<div class="small-12 medium-8 column">
				  <input type="text" name="phone" placeholder="Phone" ng-value="phone"/>
				</div>
				<div class="small-12 medium-4 column">
				  <input type="hidden" name="form" value="sample"/>
					<input type="hidden" name="industry" ng-value="industry.label" />
					<input type="hidden" name="product" ng-value="product" />
					<input type="hidden" name="path" ng-value="path" />
					<input class="button small" type="submit" name="submit" value="Submit" ng-click="setter('product-inquiry-sample')"/>
				</div>
				<div class="small-12 column">
				  <p class="disclaimer">* Required Field</p>
				</div>
			</fieldset>
		</form>
	</div>
	
	<div class="product-inquiry small-12 column">
		<button class="product-inquiry-button buttom expand" data-text="Get a Quote">Get a Quote</button>
		<form class="product-inquiry-form" id="product-inquiry-quote" action="/wp-content/themes/TIC/form-parse/parse-product-inquiry.php" method="POST">
			<fieldset class="on-page-form">
				<div class="small-12 medium-6 column">
					<span id="first-name">
            <input type="text" name="first-name" placeholder="First Name*" ng-value="first_name" required/>
          </span>
				</div>
				<div class="small-12 medium-6 column">
					<span id="last-name">
            <input type="text" name="last-name" placeholder="Last Name*" ng-value="last_name" required/>
          </span>
				</div>
				<div class="small-12 medium-8 column">
					<span id="email">
            <input type="email" name="email" placeholder="Email*" ng-value="email" required/>
          </span>
				</div>
				<div class="small-12 medium-4 column">
					<span id="zip-code">
            <input type="text" name="zip-code" placeholder="Zip Code*" ng-value="zip_code" required/>
          </span>
				</div>
				<div class="small-12 medium-8 column">
				  <input type="text" name="phone" placeholder="Phone" ng-value="phone"/>
				</div>
				<div class="small-12 medium-4 column">
				  <input type="hidden" name="form" value="quote"/>
				  <input type="hidden" name="industry" ng-value="industry.label" />
					<input type="hidden" name="product" ng-value="product" />
					<input type="hidden" name="path" ng-value="path" />
					<input class="button small" type="submit" name="submit" value="Submit" ng-click="setter('product-inquiry-quote')" />
				</div>
				<div class="small-12 column">
				  <p class="disclaimer">* Required Field</p>
				</div>
			</fieldset>
		</form>
	</div>
	
	<div class="product-inquiry small-12 column">
		<button class="product-inquiry-button buttom expand" data-text="Contact Me">Contact Me</button>
		<form class="product-inquiry-form" id="product-inquiry-contact" action="/wp-content/themes/TIC/form-parse/parse-product-inquiry.php" method="POST">
			<fieldset class="on-page-form">
				<div class="small-12 medium-6 column">
					<span id="first-name">
            <input type="text" name="first-name" placeholder="First Name*" ng-value="first_name" required/>
          </span>
				</div>
				<div class="small-12 medium-6 column">
					<span id="last-name">
            <input type="text" name="last-name" placeholder="Last Name*" ng-value="last_name" required/>
          </span>
				</div>
				<div class="small-12 medium-8 column">
					<span id="email">
            <input type="email" name="email" placeholder="Email*" ng-value="email" required/>
          </span>
				</div>
				<div class="small-12 medium-4 column">
					<span id="zip-code">
            <input type="text" name="zip-code" placeholder="Zip Code*" ng-value="zip_code" required/>
          </span>
				</div>
				<div class="small-12 medium-8 column">
				  <input type="text" name="phone" placeholder="Phone" ng-value="phone"/>
				</div>
				<div class="small-12 medium-4 column">
				  <input type="hidden" name="form" value="contact"/>
				  <input type="hidden" name="industry" ng-value="industry.label" />
					<input type="hidden" name="product" ng-value="product" />
					<input type="hidden" name="path" ng-value="path" />
					<input class="button small" type="submit" name="submit" value="Submit" ng-click="setter('product-inquiry-contact')" />
				</div>
				<div class="small-12 column">
				  <p class="disclaimer">* Required Field</p>
				</div>
			</fieldset>
		</form>
	</div>
</div>