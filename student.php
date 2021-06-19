<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSS only -->
<script src="https://kit.fontawesome.com/74f8d9aebc.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>  
<title>Profile</title>
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
 
 $roll_no=$_POST['roll_no'];
 
 
 include("connection.php");
 include("pdo.php");



 //student info
 $result = $db->prepare("SELECT * FROM student WHERE roll_no = ? ");
 $result->bind_param("s", $roll_no);
 $result->execute();
 $result = $result->get_result();
 // registered courses

 $result1 = $db->prepare("SELECT register.course_code,course_name,course_credits FROM avail_courses join register on avail_courses.course_code= register.course_code where register.roll_no = ?");
 $result1->bind_param("s", $roll_no);
 $result1->execute();
 $result1 = $result1->get_result();
 // available courses

 $query_2 = $conn->prepare('SELECT course_code,course_name,course_credits from avail_courses where course_code not in (select course_code from register  where roll_no=?)');
 $query_2->execute([$roll_no]);
 $result2=$query_2->fetchAll(PDO::FETCH_ASSOC);
//  $result2 = $db->prepare("SELECT course_code,course_name,course_credits from avail_courses where course_code not in (select course_code from register  where roll_no=?");
//  $result2->bind_param("s", $roll_no);
//  $result2->execute();
//  $result2 = $result2->get_result();
 
 

?>
<br><br>

<h1>Student Infomation</h1> 
<div class="test" id="test">

    <table class="table table-white  table-striped">
        <thead class="thead-dark ">
            <tr>
            <th scope="col">Roll No</th>
            <th scope="col">Name</th>
            <th scope="col">Father's Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Contact No</th>
            <th scope="col">Address</th>
            </tr>
        
        </thead>
        <?php  while ($row = mysqli_fetch_array($result))
        { ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $row['roll_no'] ; ?></th>
                        <td><?php echo $row['st_name'] ; ?></td>
                        <td><?php echo $row['f_name'] ; ?></td>
                        <td><?php echo $row['gender'] ; ?></td>
                        <td><?php echo $row['contact'] ; ?></td>
                        <td><?php echo $row['address'] ; ?></td>
                
                    </tr>
                </tbody>
            <?php 
        }?>
    </table>
    <h1>Registered Courses</h1> 
    <table class="table table-white  table-striped">
        <thead class="thead-dark ">
            <tr>
          
            <th scope="col">Course Code</th>
            <th scope="col">Course Name</th>
            <th scope="col">Credits</th>
            
            </tr>
        
        </thead>
        <?php  while ($row1 = mysqli_fetch_array($result1))
        { ?>
                <tbody>
                    <tr>
                       
                        <td><?php echo $row1['course_code'] ; ?></td>
                        <td><?php echo $row1['course_name'] ; ?></td>
                        <td><?php echo $row1['course_credits'] ; ?></td>
                       
                
                    </tr>
                </tbody>
            <?php 
        }?>
    </table>
    
    <h1>Available Courses</h1> 
    
    <table class="table table-white  table-striped">
        <thead class="thead-dark ">
            <tr>
          
            <th scope="col">Course Code</th>
            <th scope="col">Course Name</th>
            <th scope="col">Credits</th>
            <th scope="col">Register</th>
            
            </tr>
        
        </thead>
        
      
        <?php  foreach($result2 as $key=>$row2)
        { ?>
                <tbody>
                    <tr>
                  
                       
                        <td><?php echo $row2['course_code'] ; ?></td>
                        <td><?php echo $row2['course_name'] ; ?></td>
                        <td><?php echo $row2['course_credits'] ; ?></td>
                        <td> <button value="submit" type='submit-course' class='btn btn-primary' name="button" roll_no="<?php echo $roll_no; ?>" code="<?php echo $row2['course_code'] ; ?>" name1="<?php echo $row2['course_name'] ; ?>" cr="<?php echo $row2['course_credits'] ; ?>" id="pop" >Submit</button><td>
                       
                
                    </tr>
                </tbody>
            <?php 
        }?>
    </table>
    </div>
    


<?php

}

else { ?>



<form action="student.php" method="POST"> 
    <h1>Search Student</h1>
     <form>
    <div class="form-group">
      <label for="roll_no"></label>
      <input type="text" style="width:400px" name="roll_no"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="P19-6015">
     <!-- // <input type="text" name="roll_no"  placeholder="p190073" required  size="80"  style="padding: 10px ;" > -->
       <br>
      
      </div>
      <input type="hidden" name="form_submitted" value="1" />
      <button value="submit" type='submit' class='btn btn-primary' id="submit">Submit</button>
      </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    
    
  
<?php } ?>

<script >
// function tstt(id1){
//    // alert(id1,id2);
    
//     var set=id1;
//     var fdata={'info':set,'val2':"demo"};
//     $.ajax
//     ({
//         url:"sc.php",
//         method:"POST",
//         data:fdata,
//         success:function(data){
//             console.log(data);
//             $('cont').html(data)
//             console.log(data);
//         }
//     })
// }
    $(document).on("click","#pop", function() {
     var code=$(this).attr("code");
     var name=$(this).attr("name1");
     var cr=$(this).attr("cr");
     var roll_no=$(this).attr("roll_no");
     var fdata={'code':code,'name':name,'credits':cr,'roll_no':roll_no};
        console.log(code+name+cr);
        $.ajax
    ({
        url:"sc.php",
        method:"POST",
        data:fdata,
        success:function(data){
            console.log(data);
           // $('#test').replaceWith(data)
            console.log(data);
        }
    })
   
});
   

 
</script>
</body>
</html>