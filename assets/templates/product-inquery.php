<div class="hidden overlay">
	<div class="overlay-content">

		<div class="row">
			
			<div class="small-12 medium-2 medium-offset-7">
				<button class="close-overlay button tiny secondary">close</button>
			</div>
			
			<div class="test small-12 column">
			  <form>
			    
			    <div class="row">
			      <div class="small-12 medium-4 column">
			        <input type="text" name="fname" placeholder="First Name" ng-model="fname"/>
		        </div>
			      <div class="small-12 medium-4 column end">
			        <input type="text" name="lname" placeholder="Last Name" ng-model="lname"/>
			     </div>
			   </div>
			   
			   <div class="row">
			     <div class="small-12 medium-6 column">
			       <input type="email" name="email" placeholder="email" ng-model="email"/>
			     </div>
			     <div class="small-12 medium-2 column end">
			       <input type="text" name="zipcode" placeholder="Zip Code" ng-model="zipCode"/>
			     </div>
			   </div>
			   
			   <div class="row">
			     <div class="small-8 column">
			       <?php echo "Hello from PHP!"; ?>
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