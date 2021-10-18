<?php
session_start();

if(!(isset($_SESSION['FacultyId'])))
{
    header("location:facultylogin.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>CSE Deparment Portal</title>

    <style type="text/css">
    	
    	.h1
    	{
    		size: 10px;
    		color: darkblue;
    		opacity: initial;
    		text-align: center;
    		padding-top: 0px;
    		padding-bottom: 0px;

    	}

    	.mydiv
    	{
        	background-color: lightcoral;
        	opacity: initial;
    	}

    </style>
    
</head>
<body class="bg-secondary bg-opacity-25">

<form action="#" method="post" name="myform">

	<!-- Header -->
	<header>
	<h1 class="h1"><b>COMPUTER SCIENCE DEPARMENT PORTEL</b></h1>
	</header>

	<!-- Navigation Bar -->    
	<nav class="nav navbar navbar-expand-lg bg-primary bg-opacity-75 navbar-dark sticky-top">

		<div class="container-fluid col-12 ">
		<span class="navbar-brand text-dark active"><img src="<?php echo $_SESSION['FacultyProfile']; ?>" class="rounded-circle" height="30px" width='30px' alt=' ' />
        &nbsp; Welecome <b> <?php echo $_SESSION['FacultyName']; ?> </b> &nbsp; &nbsp; </span>
		
		<button type="button" class="navbar-toggler" data-bs-toggle='collapse' data-bs-target='#menu'>
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="menu">
			<ul class="navbar-nav">
				<li class="nav-item"><a href="facultyprofile.php" class="nav-link"><b>Profile</b></a></li>

				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="AttendenceDropdown" data-bs-toggle='dropdown' aria-expanded='false'>
						<b>Attendence</b>
					</a>
					<ul class="dropdown-menu" aria-labelledby='AttendenceDropdown'>
						<li>
            				<a class="dropdown-item" href="facultymarkattendence.php">Mark Attendence</a>
            			</li>
            			<li>
            				<a class="dropdown-item" href="facultyviewattendence.php">View Attendence</a>
            			</li>
					</ul>
				</li>

				
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="AssignmentDropdown" data-bs-toggle='dropdown' aria-expanded='false'>
						<b>Assignment</b>
					</a>
					<ul class="dropdown-menu" aria-labelledby='AssignmentDropdown'>
						<li>
            				<a class="dropdown-item" href="facultyaddassignment.php">Add Assignment</a>
            			</li>
            			<li>
            				<a class="dropdown-item" href="facultyviewassignment.php">View Assignment</a>
            			</li>
					</ul>
				</li>

				<li class="nav-item"><a href="facultynotice.php" class="nav-link"><b>Notice</b></a></li>
				
				<li class="nav-item"><a href="facultysyllabus.php" class="nav-link"><b>Syllabus</b></a></li>
				
				<li class="nav-item"><a href="#" class="nav-link active"><b>Time Table</b></a></li>
				
				<li class="nav-item"><a href="facultylogout.php" class="nav-link"><b>Logout</b></a></li>
			</ul>
		</div>
		
		</div>
	</nav>

<br/>

<!-- Notice -->
<div class="container">

<?php

$id = $_SESSION['FacultyId'];

echo "<center><span class='h4 text-success'>Timetable : ".$_SESSION['FacultyName']."</span></center><br />";

$link = mysqli_connect('localhost','root','','csedeptdb');

$qry = "select * from faculty_timetable where Fid='$id'";
$resultset = mysqli_query($link,$qry);

$str=<<<TEST
    <table class='bg-secondary bg-opacity-25 table table-bordered' align='center' cellpading='4px'>
    <tr align='center'><th>Period</th><th>MonDay</th><th>TuesDay</th><th>WednesDay</th><th>ThursDay</th><th>Friday</th><th>SaturDay</th></tr>
TEST;

while($code = mysqli_fetch_row($resultset))
{
    $str .="<tr align='center'><th>$code[1]</td>";
    
    for($i = 2; $i<8; $i++)
    {
        $qry1 = "select * from subject where code='$code[$i]'";
        $resultset1 = mysqli_query($link,$qry1);
        
        $name = mysqli_fetch_row($resultset1);
        $n = mysqli_num_rows($resultset1);
        
        if($n)
        $str .= "<td><b> $name[0] Semester </b><br /><i> $name[2] </i></td>";
        else
        $str .= "<td></td>";
        
    }
    $str .="</tr>";
}

$str .="</table>";

echo $str;

mysqli_close($link);

?>

</div>

<br><br>

<!-- Footer -->
<?php include_once('footer.html'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</body>
</html>