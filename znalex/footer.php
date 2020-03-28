<?php

?>
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4 moore">
				<img alt="moore" src="<?php echo get_bloginfo('template_url') ?>/img/images/moore.png"  class="img-fluid">
          </div>
          <div class="col-md-8 moore-text">
            <p>Moore Stephens ZNALEX, s.r.o. je součástí skupiny Moore Stephens v České republice. S více než 220 zkušenými odborníky jsme jednou z největších auditorských, účetních a daňově poradenských firem u nás. Máme kanceláře v Praze, Brně, Českých Budějovicích, Plzni, 
			Domažlicích a Jindřichově Hradci – jsme tak připraveni operativně řešit Vaše každodenní starosti i dlouhodobé strategické cíle. Díky celosvětové přítomnosti Vás zbavíme starostí nejen v České 
			republice, ale také v zahraničí. Vy komunikujete s jednou kontaktní osobou a o nic víc se nemusíte starat.</p>
			<p class="copyright">© ZNALEX 2008</p>
          </div>
        </div>
      </div>
    </footer>


		
		
		<!--wordpress footer-->
	<?php wp_footer(); ?> 

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	
	<script>
		function myMap() {
		var mapProp= {
			center:new google.maps.LatLng(51.508742,-0.120850),
			zoom:5,
		};
		var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
		}
	</script>

	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2oFc9tJFqDiLe0dA_uBtokfEeE2BNL-A&callback=myMap"></script>
    <script src="<?php echo get_bloginfo('template_url') ?>/js/custom.js"></script>
    <script src="<?php echo get_bloginfo('template_url') ?>/js/scrollbar.js"></script>

    <script type="text/javascript" async>
    	jQuery(document).ready(function(){
			jQuery('.scrollbar-inner').scrollbar();
			
		});
    </script>
	
	</body>
</html>