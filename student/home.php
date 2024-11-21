<?php include('db_connect.php'); 
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
$astat = array("Not Yet Started","Started","Closed");
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
    border-left-color: #dc143c;
  }

  .icon i{
      color: #9b0a1e;
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
        <h3>Welcome, <span style="font-weight: bold;"><?php echo $_SESSION['login_name'] ?>!</span></h3>
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5><b>Academic Year: <span style="color: #9b0a1e;"><?php echo $_SESSION['academic']['year'].' ('.ordinal_suffix1($_SESSION['academic']['semester']).' Semester)'; ?></span></b></h5>
            <h6><b>Evaluation Status: <span style="color: #9b0a1e;"><?php echo $astat[$_SESSION['academic']['status']] ?></span></h6>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row">
<div class="col-12 col-sm-6 col-md-4">
    <div class="small-box bg-light shadow-sm border">
        <div class="inner">
            <h3>
                <?php 
                // Query to count evaluations for the logged-in user
                $evaluated_count_query = "SELECT COUNT(*) AS total_evaluated 
                                          FROM evaluation_list 
                                          WHERE student_id = {$_SESSION['login_id']} 
                                          AND academic_id = {$_SESSION['academic']['id']}";
                $result = $conn->query($evaluated_count_query);
                $row = $result->fetch_assoc();
                echo $row['total_evaluated']; 
                ?>
            </h3>
            <p>Total Faculty Evaluated</p>
        </div>
        <div class="icon">
            <i class="fa fa-clipboard-check"></i>
        </div>
    </div>
</div>
<?php
// Assuming $_SESSION['login_id'] holds the ID of the logged-in student
$login_id = $_SESSION['login_id'];

// Step 1: Retrieve the class_id for the logged-in student
$class_id_query = "SELECT class_id FROM student_list WHERE id = ?";
$stmt = $conn->prepare($class_id_query);
$stmt->bind_param("i", $login_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Check if class_id was found
if ($row) {
    $class_id = $row['class_id'];

    // Step 2: Count the total number of students in the same class
    $total_students_by_class_query = "SELECT COUNT(*) AS total_students FROM student_list WHERE class_id = ?";
    $stmt = $conn->prepare($total_students_by_class_query);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $total_students = $row['total_students'];
} else {
    $total_students = 0; // In case no class_id is found
}
?>

<div class="col-12 col-sm-6 col-md-4">
  <div class="small-box bg-light shadow-sm border">
    <div class="inner">
      <h3><?php echo $total_students; ?></h3>
      <p>Total students in your class</p>
    </div>
    <div class="icon">
      <i class="fa fa-user-graduate"></i> <!-- Icon for class students -->
    </div>
  </div>
</div>
<div class="col-12 col-sm-6 col-md-4">
    <div class="small-box bg-light shadow-sm border">
        <div class="inner">
            <h3>
                <?php
                // Fetch class_id of the logged-in student
                $class_id_query = "SELECT class_id FROM student_list WHERE id = ?";
                $stmt = $conn->prepare($class_id_query);
                $stmt->bind_param("i", $_SESSION['login_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $class_row = $result->fetch_assoc();

                $class_id = $class_row['class_id'] ?? null;

                if ($class_id) {
                    // Query to count distinct faculty_id with "pending" status for the class
                    $pending_faculty_query = "
                        SELECT COUNT(DISTINCT r.faculty_id) AS total_pending
                        FROM restriction_list r
                        INNER JOIN academic_list al ON al.id = r.academic_id AND al.status = 1
                        LEFT JOIN evaluation_list el ON el.restriction_id = r.id 
                            AND el.academic_id = ? 
                            AND el.student_id = ?
                        WHERE r.class_id = ? AND el.evaluation_id IS NULL
                    ";

                    $stmt = $conn->prepare($pending_faculty_query);
                    $stmt->bind_param("iii", $_SESSION['academic']['id'], $_SESSION['login_id'], $class_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $pending_row = $result->fetch_assoc();

                    // Display the total pending faculty count
                    echo $pending_row['total_pending'] ?? 0;
                } else {
                    echo 0; // No class_id found
                }
                ?>
            </h3>
            <p>Pending Teachers to Evaluate</p>
        </div>
        <div class="icon">
            <i class="fa fa-user-clock"></i> <!-- Icon for pending -->
        </div>
    </div>
</div>

