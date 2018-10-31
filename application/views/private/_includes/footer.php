<?php defined('BASEPATH') or exit() ; ?>
    <footer>
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-9">
					<nav class="menu_cop">
						<a href="<?php echo base_url(); ?>?/Public_www/terms_of_service">Terms of Service</a>
						<a href="<?php echo base_url(); ?>?/Public_www/privacy_policy">Privacy Policy</a>
						<a href="<?php echo base_url(); ?>?/Public_www/contact_faq">FAQ</a>
						<a href="<?php echo base_url(); ?>?/knowledge-base">Knowledge Base</a>
							  
					</nav>
					<p class="copyright_p">Copyright © 2018 Coinflow</p>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-3">
					<div class="socials footer_social">
						<ul>
							<li  class="facebook"> <a href="https://www.facebook.com/coinflowai/"><i class="fa fa-facebook-f"></i></a></li>
							<li  class="twitter"> <a href="https://twitter.com/coinflow_ai"><i class="fa fa-twitter"></i></a></li>
							<li  class="linkedin"> <a href="https://www.linkedin.com/company/coinflow-ai"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<script>
	$(document).ready(function(){
		
	});
	
	$('.sign_in').click(function(e){
		e.preventDefault();
		window.location = base_url+'clients/login';
	});
	
	$('.new_acc').click(function(e){
		e.preventDefault();
		window.location = base_url+'clients/register';
	});
</script>

</body>
</html>