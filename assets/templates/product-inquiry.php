<div class="product-inquiry-module small-12 column" ng-controller="inquiryController">
  	<div class="product-inquiry small-12 column">
		<button class="product-inquiry-button buttom expand" data-text="Contact Me">Contact Me</button>
		<form class="product-inquiry-form" id="product-inquiry-contact" action="/wp-content/themes/TIC/form-parse/parse-product-inquiry.php" method="POST">
			<fieldset class="on-page-form">
				<div class="small-12 medium-12 column">
				  <span id="company">
				    <input type="text" name="company" placeholder="Company*" ng-value="company" required/>
				  </span>
				</div>
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
					<span id="phone">
				    <input type="text" name="phone" placeholder="Phone*" ng-value="phone" required/>
				  </span>
				</div>
				<div class="small-9 medium-8 column">
				  <span id="city">
				    <input type="text" name="city" placeholder="City*" ng-value="city" required/>
				  </span>
				</div>
				<div class="small-3 medium-4 column">
				  <span id="country">
				    <input type="text" name="state" placeholder="State*" ng-value="state" required/>
				  </span>
				</div>
				<div class="small-12 medium-12 column">
				  <input class='important-input' type='text' name='important-input' id='important-input' autocomplete='off'/>
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
		<button class="product-inquiry-button buttom expand" data-text="Get a Sample">Get a Sample</button>
		<form class="product-inquiry-form" id="product-inquiry-sample" action="/wp-content/themes/TIC/form-parse/parse-product-inquiry.php" method="POST">
			<fieldset class="on-page-form">
				<div class="small-12 medium-12 column">
				  <span id="company">
				    <input type="text" name="company" placeholder="Company*" ng-value="company" required/>
				  </span>
				</div>
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
					<span id="phone">
				    <input type="text" name="phone" placeholder="Phone*" ng-value="phone" required/>
				  </span>
				</div>
				<div class="small-12 medium-12 column">
				  <span id="address">
				    <input type="text" name="address" placeholder="Address*" ng-value="address" required/>
				  </span>
				</div>
				<div class="small-12 medium-12 column">
				  <span id="address">
				    <input type="text" name="building" placeholder="Building/Room" ng-value="address"/>
				  </span>
				</div>
				<div class="small-9 medium-5 column">
				  <span id="city">
				    <input type="text" name="city" placeholder="City*" ng-value="city" required/>
				  </span>
				</div>
				<div class="small-3 medium-3 column">
				  <span id="country">
				    <input type="text" name="state" placeholder="State*" ng-value="state" required/>
				  </span>
				</div>
				<div class="small-3 medium-4 column">
				  <span id="zip">
				    <input type="text" name="zip-code" placeholder="Zip code*" ng-value="zipcode" required/>
				  </span>
				</div>
				<div class="small-12 medium-12 column">
				  <input class='important-input' type='text' name='important-input' id='important-input' autocomplete='off'/>
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
		<button class="product-inquiry-button buttom expand" data-text="Get a Quote">Get a Quote</button>
		<form class="product-inquiry-form" id="product-inquiry-quote" action="/wp-content/themes/TIC/form-parse/parse-product-inquiry.php" method="POST">
			<fieldset class="on-page-form">
				<div class="small-12 medium-12 column">
				  <span id="company">
				    <input type="text" name="company" placeholder="Company*" ng-value="company" required/>
				  </span>
				</div>
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
					<span id="phone">
				    <input type="text" name="phone" placeholder="Phone*" ng-value="phone" required/>
				  </span>
				</div>
				<div class="small-9 medium-8 column">
				  <span id="city">
				    <input type="text" name="city" placeholder="City*" ng-value="city" required/>
				  </span>
				</div>
				<div class="small-3 medium-4 column">
				  <span id="country">
				    <input type="text" name="state" placeholder="State*" ng-value="state" required/>
				  </span>
				</div>
				<div class="small-12 medium-12 column">
				  <input class='important-input' type='text' name='important-input' id='important-input' autocomplete='off'/>
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