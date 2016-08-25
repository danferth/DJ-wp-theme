<div class="hidden overlay">
	<div class="overlay-content">

		<div class="row">
			
			<div class="small-12 medium-2 medium-offset-7">
				<button class="close-overlay button tiny secondary">close</button>
			</div>
			
			<div class="test small-12 column">
			  <form action="/wp-content/themes/TIC/form-parse/parse-product-overlay.php" method="POST" id="product-overlay-form">
			    
			    <div class="row">
			      <div class="small-12 medium-4 column">
			        <span id="first-name">
			          <input type="text" name="first-name" placeholder="First Name" ng-model="first_name" required/>
			        </span>
		        </div>
			      <div class="small-12 medium-4 column end">
			        <span id="last-name">
			          <input type="text" name="last-name" placeholder="Last Name" ng-model="last_name" required/>
			        </span>
			     </div>
			   </div>
			   
			   <div class="row">
			     <div class="small-12 medium-6 column">
			       <span id="email">
			         <input type="email" name="email" placeholder="email" ng-model="email" required/>
			       </span>
			     </div>
			     <div class="small-12 medium-2 column end">
			       <span id="zipCode">
			         <input type="text" name="zipcode" placeholder="Zip Code" ng-model="zipCode" required/>
			       </span>
			     </div>
			   </div>
			   
			   <div class="row">
			     <div class="small-8 column">
			       <p>Thanks for stopping by!</p>
			       <p>Please complete the above form for more information on <b>Ultra Yield&trade; Flasks for {{ cellLineChoice.label }} Development</b></p>
			     </div>
			   </div>
			   
			   <div class="row">
			     <div class="small-8 column">
			       <input class="button expand" type="submit" value="Submit"/>
			     </div>
			   </div>
			   
			    </form>
			</div>
			
		</div>

	</div>
</div>