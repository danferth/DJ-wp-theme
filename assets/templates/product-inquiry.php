<div class="product-inquiry-module small-12 column" ng-controller="inquiryController">
  	<div class="product-inquiry small-12 column">
		<button class="product-inquiry-button button expand" data-text="Contact Me">Contact Me</button>
		<form class="product-inquiry-form" id="product-inquiry-contact" action="/wp-content/themes/TIC/form-parse/parse-product-inquiry.php" method="POST">
			<fieldset class="on-page-form">
				<div class="small-12 medium-12 column">
				  <span id="company">
				    <input type="text" name="company" placeholder="Company*" ng-value="company" required/>
				  </span>
				</div>
				<div class="small-12 medium-6 column">
            <input type="text" name="first-name" placeholder="First Name*" ng-value="first_name" required/>
				</div>
				<div class="small-12 medium-6 column">
            <input type="text" name="last-name" placeholder="Last Name*" ng-value="last_name" required/>
				</div>
				<div class="small-12 medium-8 column">
            <input type="email" name="email" placeholder="Email*" ng-value="email" required/>
				</div>
				<div class="small-12 medium-4 column">
				    <input type="text" name="phone" placeholder="Phone*" ng-value="phone" required/>
				</div>
				<div class="small-6 medium-6 column">
				    <input type="text" name="city" placeholder="City*" ng-value="city" required/>
				</div>
				<div class="small-3 medium-3 column">
				    <input type="text" name="state" placeholder="State*" ng-value="state" required/>
				</div>
				<div class="small-3 medium-3 column">
				    <input type="text" name="zip-code" placeholder="Zip*" ng-value="zipcode" required/>
				</div>
				<div class="small-12 medium-12 column">
				  <input type='text' name='your-name925htj' id='your-name925htj' placeholder='your name' autocomplete='<?php echo substr(md5(rand()), 0, 7);  ?>'/>
				  <input type="hidden" name="form" value="contact"/>
					<input type="hidden" name="product" ng-value="product" />
					<input type="hidden" name="science" ng-value="science" />
					<input type="hidden" name="path" ng-value="path" />
					<input class="button small expand" type="submit" name="submit" value="Submit" ng-click="setter('product-inquiry-contact')" />
				</div>
				<div class="small-12 column">
				  <p class="disclaimer">* Denotes required field</p>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="product-inquiry small-12 column">
		<button class="product-inquiry-button button expand" data-text="Get a Sample">Get a Sample</button>
		<form class="product-inquiry-form" id="product-inquiry-sample" action="/wp-content/themes/TIC/form-parse/parse-product-inquiry.php" method="POST">
			<fieldset class="on-page-form">
				<div class="small-12 medium-12 column">
				    <input type="text" name="company" placeholder="Company*" ng-value="company" required/>
				</div>
				<div class="small-12 medium-6 column">
            <input type="text" name="first-name" placeholder="First Name*" ng-value="first_name" required/>
				</div>
				<div class="small-12 medium-6 column">
            <input type="text" name="last-name" placeholder="Last Name*" ng-value="last_name" required/>
				</div>
				<div class="small-12 medium-8 column">
            <input type="email" name="email" placeholder="Email*" ng-value="email" required/>
				</div>
				<div class="small-12 medium-4 column">
				    <input type="text" name="phone" placeholder="Phone*" ng-value="phone" required/>
				</div>
				<div class="small-12 medium-12 column">
				    <input type="text" name="address" placeholder="Address*" ng-value="address" required/>
				</div>
				<div class="small-12 medium-12 column">
				    <input type="text" name="building" placeholder="Building/Room" ng-value="building"/>
				</div>
				<div class="small-9 medium-5 column">
				    <input type="text" name="city" placeholder="City*" ng-value="city" required/>
				</div>
				<div class="small-3 medium-3 column">
				    <input type="text" name="state" placeholder="State*" ng-value="state" required/>
				</div>
				<div class="small-3 medium-4 column">
				    <input type="text" name="zip-code" placeholder="Zip*" ng-value="zipcode" required/>
				</div>
				<div class="small-12 medium-12 column">
				  <input type='text' name='your-name925htj' id='your-name925htj' placeholder='your name' autocomplete='<?php echo substr(md5(rand()), 0, 7);  ?>'/>
				  <input type="hidden" name="form" value="sample"/>
					<input type="hidden" name="product" ng-value="product" />
					<input type="hidden" name="science" ng-value="science" />
					<input type="hidden" name="path" ng-value="path" />
					<input class="button small expand" type="submit" name="submit" value="Submit" ng-click="setter('product-inquiry-sample')"/>
				</div>
				<div class="small-12 column">
				  <p class="disclaimer"><b>*</b> Denotes required field</p>
				</div>
			</fieldset>
		</form>
	</div>
	
	<div class="product-inquiry small-12 column">
		<button class="product-inquiry-button button expand" data-text="Get a Quote">Get a Quote</button>
		<form class="product-inquiry-form" id="product-inquiry-quote" action="/wp-content/themes/TIC/form-parse/parse-product-inquiry.php" method="POST">
			<fieldset class="on-page-form">
				<div class="small-12 medium-12 column">
				    <input type="text" name="company" placeholder="Company*" ng-value="company" required/>
				</div>
				<div class="small-12 medium-6 column">
            <input type="text" name="first-name" placeholder="First Name*" ng-value="first_name" required/>
				</div>
				<div class="small-12 medium-6 column">
            <input type="text" name="last-name" placeholder="Last Name*" ng-value="last_name" required/>
				</div>
				<div class="small-12 medium-8 column">
            <input type="email" name="email" placeholder="Email*" ng-value="email" required/>
				</div>
				<div class="small-12 medium-4 column">
				    <input type="text" name="phone" placeholder="Phone*" ng-value="phone" required/>
				</div>
				<div class="small-6 medium-6 column">
				    <input type="text" name="city" placeholder="City*" ng-value="city" required/>
				</div>
				<div class="small-3 medium-3 column">
				    <input type="text" name="state" placeholder="State*" ng-value="state" required/>
				</div>
				<div class="small-3 medium-3 column">
				    <input type="text" name="zip-code" placeholder="Zip*" ng-value="zipcode" required/>
				</div>
				<div class="small-12 medium-12 column">
				  <input type='text' name='your-name925htj' id='your-name925htj' placeholder='your name' autocomplete='<?php echo substr(md5(rand()), 0, 7);  ?>'/>
				  <input type="hidden" name="form" value="quote"/>
					<input type="hidden" name="product" ng-value="product" />
					<input type="hidden" name="science" ng-value="science" />
					<input type="hidden" name="path" ng-value="path" />
					<input class="button small expand" type="submit" name="submit" value="Submit" ng-click="setter('product-inquiry-quote')" />
				</div>
				<div class="small-12 column">
				  <p class="disclaimer">* Denotes required field</p>
				</div>
			</fieldset>
		</form>
	</div>
</div>