<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirects the user to the log in page
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Ledres Portfolio</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--box icons-->
	<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
	<script src="https://unpkg.com/scrollreveal"></script>


</head>


<body>

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
				<li><a href="login.php" class="btn">Logout</a></li>
			</ul>

			<div class="menu-icon">
				<div class="l1"></div>
				<div class="l2"></div>
				<div class="l3"></div>
			</div>
			
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
			<a href="https://www.facebook.com/profile.php?id=100085081058807"><i class='bx bxl-facebook-circle'></i></a>
			<a href="https://twitter.com/she_eeshh?t=NyZF8j81evXkLAGeTd0e3w&s=09"><i class='bx bxl-twitter' ></i></a>
 		</div>
	</section>

<!--About here.-->
<?php
// Replace the placeholder values with your actual database credentials
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ledres_db';

// Create a connection
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the About Me content from the database
$query = "SELECT title, description FROM about_me";
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result) {
    // Fetch the row from the result
    $row = mysqli_fetch_assoc($result);

    // Assign the values to variables
    $aboutTitle = $row['title'];
    $aboutDescription = $row['description'];

    // Free the result set
    mysqli_free_result($result);
} else {
    // Query failed, handle the error
    // ...
}

// Close the database connection
mysqli_close($connection);
?>

<section class="about container" id="about-me">
	<h2 class="heading">About</h2>
	<div class="about-cont">
		<div class="about-intro">
			<span>About Me</span>
			<h2><?php echo $aboutTitle; ?></h2>
		</div>
		<div class="about-txt">
			<p><?php echo $aboutDescription; ?></p>
		</div>
	</div>
</section>


	<!-- work samples here. -->
<section class="work container" id="work-samp">
    <h2 class="heading">Work Samples</h2>
    <div class="work-cont">
        <?php
        $workImagesDir = "images/portfolio/work/"; // Directory path for work sample images

        // Get all work sample image files in the directory
        $workImages = glob($workImagesDir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

        foreach ($workImages as $workImage) {
            echo '<div class="work-box">';
            echo '<a href="' . $workImage . '">';
            echo '<img src="' . $workImage . '" alt="" class="work-1"></a>';
            echo '</div>';
        }
        ?>
    </div>
</section>

<!-- gallery here. -->
<section class="gallery container" id="gallery">
    <h2 class="heading">Gallery</h2>
    <div class="gallery-cont">
        <?php
        $galleryImagesDir = "images/portfolio/gallery/"; // Directory path for gallery images

        // Get all gallery image files in the directory
        $galleryImages = glob($galleryImagesDir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

        foreach ($galleryImages as $galleryImage) {
            echo '<div class="gallery-box">';
            echo '<a href="'. $galleryImage . '">';
            echo '<img src="' . $galleryImage . '" alt="" class="img-1"></a>';
            echo '</div>';
        }
        ?>
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
         <p>+63912-345-6789</p>
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
				<a href="https://www.facebook.com/profile.php?id=100085081058807"><i class='bx bxl-facebook-circle'></i></a>
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

<script>
let menu = document.querySelector('.menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
	navbar.classList.toggle("open-menu");
	menu.classList.toggle("move");
}

// Smooth scrolling to top function
function scrollToTop() {
  var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
  if (currentScroll > 0) {
    window.requestAnimationFrame(scrollToTop);
    window.scrollTo(0, currentScroll - (currentScroll / 10));
  }
}

// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
  // Get the scrollT element
  var scrollT = document.querySelector(".scrollT");

  // Add a click event listener to the scrollT element
  scrollT.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default jump-to-anchor behavior

    // Scroll smoothly to the top of the page
    scrollToTop();
  });
});
// Smooth scrolling function
function smoothScroll(target, duration) {
  var targetElement = document.querySelector(target);
  var targetPosition = targetElement.offsetTop;
  var startPosition = window.pageYOffset || document.documentElement.scrollTop;
  var distance = targetPosition - startPosition;
  var startTime = null;

  function animation(currentTime) {
    if (startTime === null) startTime = currentTime;
    var timeElapsed = currentTime - startTime;
    var scrollAmount = easeInOutQuad(timeElapsed, startPosition, distance, duration);
    window.scrollTo(0, scrollAmount);
    if (timeElapsed < duration) requestAnimationFrame(animation);
  }

  function easeInOutQuad(t, b, c, d) {
    t /= d / 2;
    if (t < 1) return c / 2 * t * t + b;
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
  }

  requestAnimationFrame(animation);
}

// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
  // Get the navigation links
  var navLinks = document.querySelectorAll(".nlink");

  // Add a click event listener to each navigation link
  navLinks.forEach(function(link) {
    link.addEventListener("click", function(event) {
      event.preventDefault(); // Prevent the default jump-to-anchor behavior
      var target = this.getAttribute("href");
      var duration = 1000; // Adjust the duration as per your preference
      
      // Close any open mobile menu if applicable
      var mobileMenu = document.querySelector(".navbar");
      mobileMenu.classList.remove("open");
      
      // Scroll to the target section
      smoothScroll(target, duration);
    });
  });
});


</script>
</body>


<!--submit form to database sa true lang -->
<?php
$conn = mysqli_connect('localhost', 'root', '', 'ledres_db') or die('connection failed.');

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
</html>

