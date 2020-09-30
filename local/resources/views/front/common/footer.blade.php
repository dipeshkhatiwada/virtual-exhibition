<footer class="tb35p">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-6">
						<div class="footerblock information">
							<h3 class="h3">Information</h3>
							<ul>
								<li><a href="{{url('/web/article/About-Us')}}">About us</a></li>
								<li><a href="{{url('/web/contact')}}">Contact Us</a></li>
								<li><a href="{{url('/web/article/Term-of-Service')}}">Terms of Service</a></li>
								<li><a href="#">Privacy</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-6">
						<div class="footerblock jobseeker">
							<h3 class="h3">For Individual</h3>
							<ul>
								<li><a href="{{url('/employee/register')}}">Register</a></li>
								<li><a href="#">Search Jobs</a></li>
								<li><a href="{{url('/employee/login')}}">Login</a></li>
								<li><a href="{{url('/web/article/Privacy-Policy-Individual-Account')}}">Privacy Policy</a></li>
								<li><a href="{{url('/faq/individual')}}">FAQ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-6">
						<div class="footerblock employer">
							<h3 class="h3">For Business</h3>
							<ul>
								<li><a href="{{url('/employer/newjob')}}">Post a Job</a></li>
								<li><a href="{{url('/employer/register')}}">Register</a></li>
								<li><a href="{{url('/employer/login')}}">Login</a></li>
								<li><a href="{{url('/web/article/Privacy-Policy-Business-Account')}}">Privacy Policy</a></li>
								<li><a href="{{url('faq/business')}}">FAQ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-6">
						<div class="footerblock contactinfo">
							<h3 class="h3">Contact us</h3>
							<ul>
								<li>{{\App\library\Settings::getSettings()->address}}</li>
								<li>{{\App\library\Settings::getSettings()->telephone}}</li>
								<li>{{\App\library\Settings::getSettings()->email}}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>