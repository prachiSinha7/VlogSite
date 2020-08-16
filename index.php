<?php require_once("include/DB.php");  ?>
<?php require_once("include/Sessions.php");  ?>
<?php require_once("include/Functions.php");  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Page</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  		<!-- Favicon -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">  
  <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
<style>

  .fa-chevron-right{
  	font-size:10px;
  	transform: translateY(15%);
  	backface-visibility: none;

  }
    
html{
    scroll-behavior: smooth;
}
body{
	background-color:#F2F2F2;
}


.navbar-item:hover{
color:#AE404B!important;
}
.active{
	color:#AE404B!important;
}
.footer{
    list-style: none;
    display: flex;  
}
.fa-footer{
    
    font-size: 30px!important;
    color:#fff;
    background-color: #000;
}
.fa-facebook-official{
	margin: 12px;
    padding: 7px;
    border-radius: 5px;   
}
.fa-instagram{
    margin: 12px;
    padding: 7px;
    border-radius: 5px;
}
.fa-google-plus-official{
    margin: 12px;
    padding: 7px;
    border-radius: 5px;
}
.fa-facebook-official:hover{
    background-color: #3B5998;
    
}

.fa-instagram:hover{
    background: #f09433; 
    background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
    background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
    background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 

   
}

.fa-google-plus-official:hover{
    background-color: #D62408;
}
/*#social_logo{
    transform: translateX(3%);
}
@media only screen and (max-width: 1200px){
	#social_logo{
		transform: translateX(-15%);
	}
}
@media only screen and (max-width: 987px){
	#social_logo{
		transform: translateX(-6%);
	}
}*/

.well{
	background-color:#fff!important;
}


#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 26px;
  border: none;
  outline: none;
  background-color: rgba(100, 100, 100, 0.4);
  color: white;
  cursor: pointer;
  padding: 0 11px;
  border-radius: 4px;
  
}

#myBtn:hover {
	background-color:#AE404B;
}
.i,.fa-angle-up{
    color:#fff;
    
}

</style>
</head>

<body> 

<!--------- banner ----------->
<!----Service Section---->

<!---Posts---->

	<h1 class="title text-center" id="posts"><u>Blogs</u></h1>
	<br>
	<br>
	<br>
	<div class="container" style="margin-top: 10px;">	
	<div class="row">
				<div class="col-md-8">
		<?php	
		global $connectingDB;
		if(isset($_GET["Category"])){
			$Category=$_GET["Category"];
			$ViewQuery="SELECT * FROM admin_panel WHERE category='$Category' ORDER BY datetime desc LIMIT 0,2";
		}else{
		global $connectingDB;	
		$results_per_page = 2;
		$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc";}
		$Execute=mysqli_query($connectingDB,$ViewQuery);
		$number_of_results=mysqli_num_rows($Execute);
		$number_of_pages=ceil($number_of_results/$results_per_page);
		$previous = $number_of_pages-1;
		$next=$number_of_pages+1;
		if(!isset($_GET['page'])){
			$page=1;		
		} else{
			$page = $_GET['page'];
		} 
		global $connectingDB;
		$this_page_first_result=($page-1)*$results_per_page;
		$ViewQuery="SELECT * FROM admin_panel LIMIT ".$this_page_first_result. ',' .$results_per_page;
		$Execute=mysqli_query($connectingDB,$ViewQuery);
		while ($DataRows=mysqli_fetch_array($Execute)){
			$PostId=$DataRows["id"];
			$DateTime= $DataRows["datetime"];
			$Title= $DataRows["title"];
			$Category= $DataRows["category"];
			$Admin= $DataRows["author"];
			$Image= $DataRows["image"];
			$Post= $DataRows["post"]; 
		?>
		<div class="blogpost thumbnail" style="background-color:whitel;">
		<img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>">
		<div class="caption">
		<h1 id="heading"> <?php echo htmlentities($Title); ?> </h1>	<p class="description">Category:<?php echo htmlentities($Category); ?>Published on <?php echo htmlentities($DateTime); ?>  </p>
		<h4 class="post"><?php echo $Post; ?></h4>
		</div>
		</div>
		
		<?php } ?>
		<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php for($page=1;$page<=$number_of_pages;$page++) : ?>
    <li class="page-item"><a class="page-link" href="blog.php?page=<?php echo($page) ?>"><?=$page; ?></a></li>
    <?php endfor; ?>
  </ul>
</nav>
		</div>
		

		
		<div class="col-md-4">
	    <div class="well">
		<h4>Follow Us</h4>
		<ol class="footer" id="social_logo">
                                    <li>
                                    <a href="#">
                                    <div class="float-left f"><i class="fa fa-facebook-official fa-footer" aria-hidden="true"></i></div>
                                    </a>
                                    </li>
                                    <li>
                                    <a href="#">
                                    <div class="float-left i"><i class="fa fa-instagram fa-footer" aria-hidden="true"></i></div>
                                    </a>
                                    </li>
                                    <li>
                                    <a href="#">
                                    <div class="float-left t"><i class="fa fa-google-plus-official fa-footer" aria-hidden="true"></i></div>
                                    </a>
                                    </li>                    
		</ol>
		

        <div class="col-md-12">

</div><br><br>

		
							  <h3>Categories</h3>
							  <br>
							  <br>
                             <?php 
                             global $connectingDB;

		$ViewQuery="SELECT * FROM category ORDER BY datetime desc";
		$Execute=mysqli_query($connectingDB,$ViewQuery);
		while ($DataRows=mysqli_fetch_array($Execute)) {
			$id=$DataRows['id'];
			$Category=$DataRows['name'];
			?>
<a href="index.php?Category=<?php echo $Category; ?>">		
<h4 style="color: blue;"><?php echo $Category."<br>"."<hr>"; ?></h4>
</a>
<?php } ?>

		<h3>Recent Posts</h3>

		<?php
		$connectingDB;
		$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";
		$Execute=mysqli_query($connectingDB,$ViewQuery);
		while ($DataRows=mysqli_fetch_array($Execute)) {
		$PostId=$DataRows["id"];
		$DateTime= $DataRows["datetime"];
		$Title= $DataRows["title"];
		$Image= $DataRows["image"];
		if (strlen($DateTime)>11){
			$DateTime=substr($DateTime,0,11);}
		?>
	<div>
	<img style="margin-top: 10px;margin-left: 10px;" src="Upload/<?php echo htmlentities($Image); ?>" width=70; height=70;>
	<h4 id="heading" style="margin-left: 90px;margin-top: -65px;"><?php echo htmlentities($Title); ?></h4>	
	<p id="description" style="margin-left: 90px;"><?php echo htmlentities($DateTime); ?></p>
	<hr>
</div>

	<?php } ?>


		</div>
		
		</div>
						
		  </div>
	</div>
	</div>

	<!------Client Views----->
</section>	


<!--scroll top button-->
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class=" fa fa-angle-up"></i>  </button>


<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<script type="text/javascript">
    var button = document.getElementById('show_button')
    button.addEventListener('click',hideshow,false);

    function hideshow() {
        document.getElementById('hidden-div').style.display = 'block'; 
        this.style.display = 'none'
    }   
</script>



</body>
</html>