<!-- Scrolling Effect--> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script>
			$(document).ready(function(){
			// Add smooth scrolling to all links
			$("a").on('click', function(event) {

				// Make sure this.hash has a value before overriding default behavior
				if (this.hash !== "") {
				// Prevent default anchor click behavior
				event.preventDefault();

				// Store hash
				var hash = this.hash;

				// Using jQuery's animate() method to add smooth page scroll
				// The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
				$('html, body').animate({
					scrollTop: $(hash).offset().top
				}, 800, function(){
			
					// Add hash (#) to URL when done scrolling (default click behavior)
					window.location.hash = hash;
				});
				} // End if
			});
			});
	</script>

<div class="container pt-11" id="home" >
	<div class="row g-3 justify-content-center">
		<div class="col-md-12 text-center"> <!-- Home -->
			<img src="<?=base_url('public/sources/assets/images')?>/map.png" class=" rounded w-75">	
		</div>
		<div class="col-md-12 text-start content-fluid text-center fs-4">
			<h1 class="text-dark container-fluid"style="font-size:50px">
				<span class="text-danger fst-italic" style="font-size:50px">A</span>LS Community Literacy Mapping
			</h1>
				<p class="text-dark ">
					The objective of the activity is to determine the number of OSYs and OSAs who need basic education and literacy.
				</p>
				<a href="#faqs">	
				<button type="button" class="btn btn-danger mb-5 ">Learn More</button>
				</a>
		</div>	
	</div>	
</div>
 <!-- About -->
<div class="container-fluid" id="about">
	<div class="row">
		<div class="col-md-12 bg-danger p-5">
				<p class="text-light fs-3 text-center ">
				</p>
		</div>
	</div>	
</div>
 <!-- Goal -->
<div class="container-fluid">
	<div class="row g-3 m-5 justify-content-center fs-4">
		<div class="col-md-10 text-center card shadow p-3 pt-11">
			<h1 class="text-dark px-5">
				<span class="text-danger">O</span>ur Goal in-line with
				Strategic Goal 1 of ALS v2.0
			</h1>
			<h3 class="text-start text-danger pt-4 px-5">Improve ALS literacy Mapping:</h3>
			<p class="text-dark text-start px-5 ">
				Success of the Literacy Mapping 
				depends on the level of effort of the 
				mobile teachers and the willingness of 
				out-of-school individuals to participate 
				in the program. Utilizing information 
				from the Listahanan, this mapping 
				exercise will now be redesigned 
				to focus on barangays with high 
				concentration of potential learners 
				first. This will make efficient use of 
				the efforts of the mobile teachers, and 
				will make tracking the progress of the 
				reach of the program easier.	
			</p>	
		</div>		
	</div>	
</div>
<div class="container">
	<div class="row g-3 m-5">
		<div class="col-md-8 text-start fs-4">
			<h1 class="text-dark px-5">
				<span class="text-danger">L</span>iteracy Mapping held in NCR
			</h1>
			<h3 class=" text-start px-5">Literacy Mapping of Non-Completers of Basic Education in the Region</h3>
			<p class="text-dark text-start fs-3 px-5">
				<i>Memorandum No. 009 s.2018</i>
			</p>
			<p class="text-dark text-start px-5">
				Pursuant to DepEd Order no. 63,s.2017 re:Literacy Mapping 2017, The Deped-National Capital Region through the Curriculum and Learning Management Division (CLMD) will Conduct survey to determine the magnitude of none-competers of Basic Education in the region. This will be Conducted in the Month of Febuary, 2018.
			</p>	
		</div>		
		<div class="col-md-4 text-start fs-4">
			<h3 class=" text-start px-5">The activity aims to:</h3>
			<p class="text-dark text-start px-5">
				<span class="text-danger">A.</span> Identify prospective learners in every barangay in the region:
			</p>
			<p class="text-dark text-start px-5">
				<span class="text-danger">B.</span> Establish the data of non-completers of basic education in the region:
			</p>
			<p class="text-dark text-start px-5">
				<span class="text-danger">C.</span> Determine the total number of ALS learners for every barangay in the regoin.
			</p>	
		</div>		
	</div>	
</div>

 <!-- Zoning Map -->
<div class="container-fluid">
	<div class="row bg-light justify-content-center">
			<div class="col-md-11 text-center p-5">
				<h1 class="text-dark">Zoning Maps of Barangays in District 5 Quezon City</h1>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1GZwUULkveT6V-1hrtAUmLxpEDZumSn8d/view" class="text-light"> Bagbag </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1aGVxvw8diQV_E7x2rmrPuJfue6lf7K-W/view" class="text-light"> Capri </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1Aitvxfzv2jVpY9ytZE-99RnFWkZFEamp/view" class="text-light"> Fairview </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1IKgDB4oUM_2g_Ew7fWl1nZgUE_y-iA8X/view" class="text-light" > Greater Lagro </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1IVRFbOYVUg2HHm5pk7WvOj9kN_xuJBjm/view" class="text-light"> Gulod </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1cndVqQERqOkC-QV5Mb1iARMsPgWWmdDK/view"class="text-light"> Kaligayahan </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1ubsf1E8YJlvw_gixZz8k4uuiRAo95eQ4/view" class="text-light"> Nagkaisang Nayon </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1BAknsG-nxezAuRBiztgIm0gZCMb5ao_a/view" class="text-light"> North Fairview </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/10AHUp_jVQ7qBYsjsiUKR4lOjGrz6XTCL/view"class="text-light"> Novaliches Proper </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1EEj8WUgOP8HV5iQaMjofq6SMtcr3DB-W/view" class="text-light"> Pasong Putik Proper </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1dUNp336FUJRiLHHnOxT_wA6-2REqD42v/view" class="text-light"> San Agustin </a> </button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1QJndQEOqnuvPQIkiL06PYOP7j0dRxpEZ/view" class="text-light"> San Bartolome </a></button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/15V4XL4B09srJnYkRf22le0kYLjh1rmgE/view" class="text-light"> Sta. Lucia </a></button>
				<button type="button" class="btn btn-warning mt-3"><a href="https://drive.google.com/file/d/1WdlAzQUnsPq57N86v3VFONZGnS75khWe/view" class="text-light"> Sta. Monica </a> </button>
			</div>

			<div class="col-md-11 text-center pb-5">
				<div class="mapouter text-center container-fluid">
						<div class="gmap_canvas" src="https://maps.google.com/maps?q=Quezon%20City%20Manila&t=&z=13&ie=UTF8&iwloc=&output=embed">
							<iframe class="container-fluid" height="300px" width="500px" src="https://maps.google.com/maps?q=Quezon%20City%20Manila&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
						</div>
				</div>
			</div>

	</div>
</div>
 <!-- ALS Center -->
<div class="container pt-12 p-10 glue-card_inner" >
		<div class="row g-3 ">
				<div class="col-md-4 p-5" >
				<h1 class="text-dark">
					<span class="text-info ">L</span>et's work together through this!
				</h1>
				<h4 class="text-start pt-5"> View available ALS center in your nearest Barangay</h4>
					<a href="barangay">	
					<button type="button" class="btn btn-info mb-5 text-light ">Learn More</button>
					</a>
				</div>
			
			<div class="col-md-8 p-5 text-center justify-content-center ">
				<img src="<?=base_url('public/sources/assets/images')?>/Together.svg" class=" img-fluid rounded w-75">	
			</div>
			
		</div>	
	</div>
<!-- Faqs -->
<div class="container-fluid" id="faqs">
	<div class="row  justify-content-center bg-danger">
		<div class="col-md-10 p-10 text-light">
			<h1 class="text-center text-light">What is Literacy Mapping?</h1>
				<p class=" fs-4"> 
				"Community Language and Literacy Mapping is an inquiry-based method that can be utilized by teachers to place literacy learning in context by connecting students' lived realities to school instruction."
			</p>
			<p class="text-light text-center ">
				-Teaching and Teacher Education
				<span>(Volume 87, January 2020)</span>
			</p>

		</div>
	</div>	
</div>

<div class="container-fluid">
	<div class="row  justify-content-center bg-success">
		<div class="col-md-10 p-10 text-light">
			<h1 class="text-center text-light">What is an OSYA?</h1>
			<p class="text-center fs-3">
				OUT OF SCHOOL YOUTH AND ADULT </p>
				<p class=" fs-4"> 
				The term OSY means 1.) <i>an eligible youth who is a school dropout</i>,
				or 2.) <i>an eligible youth who has recieved a secondary school diploma or its equivalent 
				The term Out of School Youth means an individual.</i>
			</p>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row  justify-content-center bg-info">
		<div class="col-md-10 p-10 text-light">
			<h1 class="text-center text-light">What is ALS?</h1>
			<p class="text-center fs-3">
			ALTERNATIVE LEARNING SYSTEM</p>
				<p class=" fs-4"> 
				The Deparment of Education implements non-formal education programs through the ALS. 
				Non-formal education is defined by UNESCO as “education that is institutionalized, intentional and planned by an education provider. 
				The defining characteristic of non-formal education is that it is an addition, 
				alternative and/or a complement to formal education within the process of the lifelong learning of individuals.
			</p>
			<p class="fs-4 ">
			It is often provided to guarantee the right of access to education for all.
			 Non-formal education can cover programs contributing to adult and youth literacy and education for out-of-school children, 
			 as well as programs on life skills, work skills, and social or cultural development.”
			</p>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row  bg-primary justify-content-center p-5">		
			<h2 class="text-light text-center pt-5">Sign-in here:</h2>
					<div class="col-md-3 card m-5 text-center ">
						<a href="staff/login">
						<div class="card-body">
							<h3 class="card-title">Barangay Staff</h3>
							<img src="<?=base_url('public/sources/assets/images')?>/Staff.svg" class=" img-fluid rounded w-75">
						</div> 
					</div></a>	

							<div class="col-md-3 text-center card m-5 ">
						<a href="coordinator/login">
						<div class="card-body">
						<h3 class="card-title">Barangay Coordinator</h3>
						<img src="<?=base_url('public/sources/assets/images')?>/Coordinator.svg" class=" img-fluid rounded w-75">
						</div>
							</div></a>

							<div class="col-md-3 card m-5 text-center">
						<a href="teacher/login">
						<div class="card-body">
						<h3 class="card-title">Teacher</h3>
						<img src="<?=base_url('public/sources/assets/images')?>/ALSCoordinator.svg" class=" img-fluid rounded w-75">
						</div>
							</div></a>	
						
				
			</div>
		</div>
							
	








