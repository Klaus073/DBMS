<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/74f8d9aebc.js" crossorigin="anonymous"></script>
    <title></title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a href="#" class="navbar-brand"><i class="fas fa-university"></i>FAST <b>NUCES</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="student.php">Studen Enrollment </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="courses.php">Add Course</a>
      </li>
      
    </ul>
    
  </div>
</nav>
  <?php if (isset($_POST['form_submitted'])){
//this code is executed when the form is submitted
?>
    <?php
    include("connection.php");
    $course_code=$_POST['course_code'];
    $course_name=$_POST['course_name'];
    $credits=$_POST['course_credits'];
    $s=3;
    echo "$course_code";
    echo "$course_name";

    echo "$credits";
   
  //  $result = mysqli_query($db, "SELECT * FROM posts ");

  //  $stmt = "INSERT INTO avail_courses (id,course_code,course_name,course_credits) VALUES (,$course_code,$course_name,$credits)";
  // // // execute query
  // mysqli_query($db, $stmt);
   
   $stmt = $db->prepare("INSERT INTO avail_courses (course_code, course_name,course_credits) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $course_code,$course_name,$credits);
$stmt->execute();

echo"<h3>Data Inserted Successfully <a href ='courses.php' >Go Back</a></h3>";
?>

 
  <?php

}

else { ?>

  <form action="courses.php" method="POST">
    <h1>Add Courses</h1>
    <br><br>
    <form>
    <div class="form-group">
      <label for="course_code">Course Code</label>
      <input type="text" style="width:400px" name="course_code"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="P19-6015">
      <br><br>
      <label for="roll_no">Course Name</label>
      <input type="text" style="width:400px" name="course_name"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="P19-6015">
      <br><br>
      <label for="roll_no">Credits</label>
     
      <input type="text" style="width:400px" name="course_credits"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="P19-6015">
       <br><br>
      
      </div>
      <input type="hidden" name="form_submitted" value="1" />
      <button value="submit" type='submit' class='btn btn-primary' id="submit">Submit</button>
      </form>
      <?php } ?>
</body>
</html>