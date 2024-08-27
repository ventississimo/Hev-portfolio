<?php
$conn = mysqli_connect('localhost', 'root', '', 'contact_form_db') or die('connection failed.');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$msg = mysqli_real_escape_string($conn, $_POST['message']);

	$select_message = mysqli_query($conn, "SELECT * FROM `contact_submissions` WHERE name = '$name' AND email = '$email' AND message = '$msg'");

	if (!$select_message) {
		die('query failed: ' . mysqli_error($conn));
	}

	if (mysqli_num_rows($select_message) > 0) {
		$message = 'message sent already!';
		
	} else {
		$insert_query = "INSERT INTO `contact_submissions`(name, email, message) VALUES ('$name', '$email', '$msg')";
		if (!mysqli_query($conn, $insert_query)) {
			die('query failed: ' . mysqli_error($conn));
		}
		$message = 'message sent successfully!';
	}
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Ledres Portfolio</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--box icons-->
	<script src="ledres.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
	<script src="https://unpkg.com/scrollreveal"></script>


</head>

<!-- Add this script tag to the bottom of your body element -->
<script>
  // Initialize SmoothScroll
  const scroll = new SmoothScroll('a[href*="#"]', {
    speed: 500, // Set the duration of the scroll animation in milliseconds
    offset: 80 // Set the distance between the top of the page and the target element in pixels
  });

  // Initialize ScrollReveal
  const sr = ScrollReveal({
    origin: 'bottom', // Set the origin of the reveal animation to the bottom of the viewport
    distance: '20px', // Set the distance of the reveal animation
    duration: 1000, // Set the duration of the reveal animation in milliseconds
    delay: 200 // Set the delay before the reveal animation starts in milliseconds
  });
  sr.reveal('.intro, .about, .work, .gallery, .contact', { interval: 200 }); // Add the elements you want to reveal

  // Add click event listeners to all nlinks with a smooth scroll animation
  const nlinks = document.querySelectorAll('.nlink');
  nlinks.forEach(nlink => {
    nlink.addEventListener('click', e => {
      e.preventDefault(); // Prevent default anchor behavior
      const href = nlink.getAttribute('href');
      scroll.animateScroll(document.querySelector(href)); // Scroll smoothly to the target element
    });
  });
</script>


<body>

<?php if (isset($message)) { ?>
		<div class="message">
			<?php echo $message; ?>
		</div>
	<?php } ?>

	<!--scrolling-->
	<a href="#home" class="scrollT">
  	<i class='bx bx-chevrons-up'></i>
	</a>
	<header>
			<div class="nav container">
			<!--logo-->
			<a href="#" class="logo">Heaven</a> 
			<!--navigation part-->
			<ul class="navbar">
				<li><a href="#about-me" class="nlink">About Me</a></li> 
				<li><a href="#work-samp" class="nlink">Work Samples</a></li>
				<li><a href="#gallery" class="nlink">Gallery</a></li>
				<li><a href="#contact" class="nlink">Contact</a></li>
				<li><a href="resume.pdf" class="btn" download>Download Resume
							<i class='bx bxs-download'></i></a></li>
			</ul>
			<!--menu-->
			<div class="menu">
				<div class="l1"></div>
				<div class="l2"></div>
				<div class="l3"></div>	
	</header>
	<section class="intro container" id="home">
 		<div class="home-cont">
 			<div class="home-img">
 			<img src="images/me.jpg" alt="me"> 
 		</div>
 		<div class="home-txt">
 			<h3>Greetings!</h3>
 			<h2>I'm <span class="color">Heaven</span></h2>
 			<p>Thank you for taking the time to visit my portfolio. I am thrilled to share my work and professional journey with you.<br> Here's a bit more about me.</p>
 		</div>
 		<div class="socmed">
 			<a href="mailto:hbledres03043@usep.edu.ph"><i class='bx bxl-gmail'></i></a>
			<a href="https://www.facebook.com/hvn.1210"><i class='bx bxl-facebook-circle'></i></a>
			<a href="https://twitter.com/she_eeshh?t=NyZF8j81evXkLAGeTd0e3w&s=09"><i class='bx bxl-twitter' ></i></a>
 		</div>
	</section>

	<section class="about container" id="about-me">
		<h2 class="heading">About</h2>
		<div class="about-cont"> 
			<div class="about-intro">		
			<span>About Me</span>
			<h2>Web Developer,<br>
				DBA & Cyber Security,<br>
				Singer, Dancer & Full-time Musician</h2>
			</div>
			<div class="about-txt">
				<p>As an IT Student, I am passionate about creating websites and have been working in this field for 4 years. My journey in this field began with my older sister teaching me about creating websites and introduced me to different programming languages. Over the years, I have had the privilege of working with a diverse range of clients and projects, allowing me to develop a broad skill set and deep expertise in basic programming and editing. I have honed my skills in creating basic website pages and am always eager to learn and grow. Currently, I am studying various programming language, which has given me the opportunity to create databases, websites and many more.<br></br>

				Outside of my work, I have a variety of hobbies and interests that fuel my creativity and drive to excel. In my free time, I love watching Anime, read light novels, cosplaying, and sleep, which has given me a unique perspective and approach to my work. I believe that these hobbies expands my knowledge about several stuffs and gave me confidence and encourage to deepen my knowlege about the world. Additionally, I can play instruments, sing and dance, which have proven to be valuable assets in my work and personal life.<br></br>

				My approach to work is defined by Kaizen which means to continue improving whether in my personal lives or in  work. Small, incremental improvements over time can lead to significant progress. I believe that God will make a way, and this has been evident in all my experience in life. My dedication and passion have been an asset in my career, allowing me to overcome my weaknesses and challenges in every aspect of my life. I am confident that I can bring this same level of dedication and expertise to any project or team.<br></br>

				This portfolio is a showcase of my best work, highlighting my skills and expertise. I invite you to explore my portfolio and get in touch if you have any questions or would like to discuss a potential collaboration. I look forward to hearing from you and thank you for your time.<br></br></p>
	</section>

	<!-- work samples here. -->
	<section class="work container" id="work-samp">
		<h2 class="heading">Work Samples</h2>
		<div class="work-cont"> 
			<div class="work-box">
				<img src="images/prog1.jpg" alt="" class="work-1">
			</div>
			<div class="work-box">
				<img src="images/prog2.jpg" alt="" class="work-2">
			</div>
			<div class="work-box">
				<img src="images/prog3.jpg" alt="" class="work-3">
			</div>
			<div class="work-box">
				<img src="images/prog4.jpg" alt="" class="work-4">
			</div>
		</div>	
	</section>

	<!-- gallery here. -->
	<section class="gallery container" id="gallery">
		<h2 class="heading">Gallery</h2>
		<div class="gallery-cont"> 
			<div class="gallery-box">
				<img src="images/skill.jpg" alt="" class="img-1">
			</div>
			<div class="work-box">
				<img src="images/skill2.jpg" alt="" class="img-2">
			</div>
			<div class="work-box">
				<img src="images/skill3.jpg" alt="" class="img-3">
			</div>
			<div class="work-box">
				<img src="images/skill4.jpg" alt="" class="img-4">
			</div>
			<div class="gallery-box">
				<img src="images/skill5.jpg" alt="" class="img-5">
			</div>
			<div class="gallery-box">
				<img src="images/skill6.jpg" alt="" class="img-6">
			</div>
			<div class="gallery-box">
				<img src="images/skill7.jpg" alt="" class="img-7">
			</div>
			<div class="gallery-box">
				<img src="images/skill8.jpg" alt="" class="img-8">
			</div>
			<div class="gallery-box">
				<img src="images/skill9.jpg" alt="" class="img-9">
			</div>
			<div class="gallery-box">
				<img src="images/skill10.jpg" alt="" class="img-10">
			</div>
			<div class="gallery-box">
				<img src="images/skill11.jpg" alt="" class="img-11">
			</div>
			<div class="gallery-box">
				<img src="images/skill12.jpg" alt="" class="img-12">
			</div>
		</div>	
		
	</section>

	<section class="contact container" id="contact">
	<h2 class="heading">Contact</h2> 
	<div class="contact-cont"> 
	<!--contact form here.-->
	<form action="" class="contact-form" id="contact-form" method="POST">
		<input type="text" placeholder="Your Name" class="name" name="name" required>
		<input type="email" name="email" id="email" placeholder="Email Address" class="email" required>
		<textarea name="message" id="message" cols="30" rows="10" placeholder="Write your message here..." class="message" required></textarea>
		<input type="submit" value="Send" class="send-btn">
	</form>
	</div>

	 <div class="box-cont">

      <div class="box">
         <h3>Phone</h3>
         <p>+63956-150-3040</p>
      </div>

      <div class="box">
         <h3>Email</h3>
         <p>hbledres03043@usep.edu.ph</p>
      </div>

      <div class="box">
         <h3>Address</h3>
         <p>Matina Crossing, Davao City, Davao Del Sur</p>
      </div>

   </div>

</section>

<section class="footer container" id="footer">
			<div class="socmed">
				<a href="mailto:hbledres03043@usep.edu.ph"><i class='bx bxl-gmail'></i></a>
				<a href="https://www.facebook.com/hvn.1210"><i class='bx bxl-facebook-circle'></i></a>
				<a href="https://twitter.com/she_eeshh?t=NyZF8j81evXkLAGeTd0e3w&s=09"><i class='bx bxl-twitter' ></i></a>
				<a href="https://instagram.com/hvn_1210?igshid=ZGUzMzM3NWJiOQ=="><i class='bx bxl-instagram' ></i></a>
			</div>
			<!--footer links-->
			<div class="footer-link">
			<a href="#">Privacy Policy</a>
			<a href="#">Usage Terms</a>
			<a href="#">Disclaimer</a>
			</div>
			<!--Copyright-->
			<p>&777Ledres</p>
</section>
</body>

</html>
