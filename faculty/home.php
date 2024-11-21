<?php include('db_connect.php'); ?>
<?php 
function ordinal_suffix1($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
         switch($num % 10){
            case 1: return $num.'st';
            case 2: return $num.'nd';
            case 3: return $num.'rd';
        }
    }
    return $num.'th';
}
$astat = array("Not Yet Started","On-going","Closed");
?>
<style>
  h3{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  }

  .card{
      box-shadow: none;
      background: transparent;
    }

  .callout.callout-info{
    border-left-color: #9b0a1e;
  }

  .icon i{
      color:#9b0a1e;
      padding: 10px 10px 10px 0;
  }

  .inner h3{
    color: #9b0a1e;
  }

  .inner p{
    font-weight: bold;
    color: black;
  }

  .small-box>.inner{
      background-color: white;
      padding: 20px;
    }

    .col-12.col-sm-6.col-md-4{
      box-shadow: none;
    }

    .row{
      margin: 20px;
    }
</style>
<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3>Welcome, <b><?php echo $_SESSION['login_name'] ?>!</h3></b>
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5><b>Academic Year: <span style="color: #dc143c;"><?php echo $_SESSION['academic']['year'].' ('.ordinal_suffix1($_SESSION['academic']['semester']).' Semester)'; ?></span></b></h5>
            <h6><b>Evaluation Status: <span style="color: #dc143c;"><?php echo $astat[$_SESSION['academic']['status']] ?></span></b></h6>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="row">
<div class="col-12 col-sm-6 col-md-4">
    <div class="small-box bg-light shadow-sm border">
        <div class="inner">
            <!-- Get the total unique evaluated students -->
            <h3>
                <?php 
                include 'db_connect.php';
                
                // Get the faculty ID from the session
                $teacher_id = is_array($_SESSION['login_id']) ? $_SESSION['login_id']['id'] : $_SESSION['login_id'];
                
                // Query to get the total number of unique students who evaluated for the specific teacher
                $evaluated_students_query = "
                    SELECT COUNT(DISTINCT r.student_id) AS total_evaluated
                    FROM evaluation_list r
                    LEFT JOIN subject_list sl ON r.subject_id = sl.id
                    LEFT JOIN student_list st ON r.student_id = st.id
                    LEFT JOIN class_list cl ON r.class_id = cl.id
                    LEFT JOIN academic_list a ON r.academic_id = a.id
                    WHERE r.faculty_id = '$teacher_id'
                ";
                
                $result = $conn->query($evaluated_students_query);
                $row = $result->fetch_assoc();
                echo $row['total_evaluated']; 
                ?>
            </h3>
            <p>Total Students Who Evaluated</p>
        </div>
        <div class="icon">
            <i class="fa fa-clipboard-check"></i> <!-- Change icon as needed -->
        </div>
    </div>
</div>

  <?php
      // Assuming $_SESSION['login_id'] holds the ID of the logged-in faculty
      $faculty_id = $_SESSION['login_id'];

      // Step 1: Retrieve class_ids for the logged-in faculty
      $class_id_query = "SELECT id AS class_id FROM class_list WHERE FIND_IN_SET(?, faculty_id)";
      $stmt = $conn->prepare($class_id_query);
      $stmt->bind_param("i", $faculty_id);
      $stmt->execute();
      $result = $stmt->get_result();

      $class_ids = [];
      while ($row = $result->fetch_assoc()) {
          $class_ids[] = $row['class_id'];
      }

      // Check if any class_ids were found
      if (!empty($class_ids)) {
          // Step 2: Count the total number of students in the retrieved classes
          $placeholders = implode(',', array_fill(0, count($class_ids), '?')); // Create placeholders for IN clause
          $total_students_query = "SELECT COUNT(*) AS total_students FROM student_list WHERE class_id IN ($placeholders)";
          $stmt = $conn->prepare($total_students_query);

          // Bind the class_ids dynamically
          $types = str_repeat('i', count($class_ids)); // Generate the type string (all integers)
          $stmt->bind_param($types, ...$class_ids);
          $stmt->execute();
          $result = $stmt->get_result();
          $row = $result->fetch_assoc();

          $total_students = $row['total_students'];
      } else {
          $total_students = 0; // In case no class_ids are found
      }
      ?>

<!-- Display the total students in a card -->
<div class="col-12 col-sm-6 col-md-4">
  <div class="small-box bg-light shadow-sm border">
    <div class="inner">
      <h3><?php echo $total_students; ?></h3>
      <p>Total Students in Your Classes</p>
    </div>
    <div class="icon">
      <i class="fa fa-user-graduate"></i> <!-- Icon for class students -->
    </div>
  </div>
</div>



  <div class="col-12 col-sm-6 col-md-4">
    <div class="small-box bg-light shadow-sm border">
      <div class="inner">
        <!-- Get the total number of subjects for the logged-in user -->
        <h3>
        <?php 
          // Assuming the user is identified by a session variable or similar
          $faculty_id = $_SESSION['login_id']; // Adjust this according to your session setup
          $total_subjects_query = "
            SELECT COUNT(DISTINCT sl.id) AS total_subjects
            FROM subject_teacher st
            JOIN subject_list sl ON st.subject_id = sl.id
            WHERE st.faculty_id = ?"; // Use the correct field that links to the user (faculty_id)
          
          $stmt = $conn->prepare($total_subjects_query);
          $stmt->bind_param("i", $faculty_id);
          $stmt->execute();
          $result = $stmt->get_result();
          $row = $result->fetch_assoc();
          echo $row['total_subjects']; 
        ?>
        </h3>
        <p>Total Subjects</p>
      </div>
      <div class="icon">
        <i class="fa fa-book"></i> <!-- Icon for subjects -->
      </div>
    </div>
  </div>
</div>
