<?php 

// Function to get ordinal suffix
function ordinal_suffix($num) {
    $num = $num % 100; // protect against large numbers
    if ($num < 11 || $num > 13) {
        switch ($num % 10) {
            case 1: return $num . 'st';
            case 2: return $num . 'nd';
            case 3: return $num . 'rd';
        }
    }
    return $num . 'th';
}

// Initialize variables from GET parameters
$rid = isset($_GET['rid']) ? $_GET['rid'] : '';
$faculty_id = isset($_GET['fid']) ? $_GET['fid'] : '';
$subject_id = isset($_GET['sid']) ? $_GET['sid'] : '';

// Fetch restrictions with evaluations if they exist and academic status is active
$restriction = $conn->query("
    SELECT 
        r.id, 
        s.id as sid, 
        f.id as fid, 
        concat(f.firstname, ' ', f.lastname) as faculty, 
        s.code, 
        s.subject, 
        el.evaluation_id as evaluation_id
    FROM restriction_list r
    INNER JOIN faculty_list f ON f.id = r.faculty_id
    INNER JOIN subject_list s ON s.id = r.subject_id
    INNER JOIN academic_list al ON al.id = r.academic_id AND al.status = 1
    LEFT JOIN evaluation_list el ON el.restriction_id = r.id 
        AND el.academic_id = {$_SESSION['academic']['id']} 
        AND el.student_id = {$_SESSION['login_id']}
    WHERE r.academic_id = {$_SESSION['academic']['id']}
        AND r.class_id = {$_SESSION['login_class_id']}
");

?>

<div class="col-lg-12">
    <div class="row">
        <div class="col-md-3" style="margin-bottom:20px;">
            <div class="list-group">
                <?php 
                $displayed_ids = []; // Array to track displayed IDs
                while ($row = $restriction->fetch_array()):
                    if (!in_array($row['id'], $displayed_ids)) { // Check if ID has already been displayed
                        $displayed_ids[] = $row['id']; // Add ID to the array
                ?>
                <a class="list-group-item list-group-item-action <?php echo isset($rid) && $rid == $row['id'] ? 'active' : '' ?>" 
                    href="./index.php?page=evaluate&rid=<?php echo $row['id'] ?>&sid=<?php echo $row['sid'] ?>&fid=<?php echo $row['fid'] ?>"
                    <?php echo $row['evaluation_id'] ? 'style="pointer-events: none;"' : ''; ?>>
                    <?php echo ucwords($row['faculty']) . ' - (' . $row["code"] . ') ' . $row['subject'] ?>
                    <?php if ($row['evaluation_id']): ?>
                        <span class="badge badge-success evaluated">
                            <i class="fa fa-check"></i> Done
                        </span>
                    <?php else: ?>
                        <span class="badge badge-warning">Not Evaluated</span>
                    <?php endif; ?>
                </a>
                <?php 
                    } // End of ID check
                endwhile; ?>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <b>Evaluation Questionnaire for Academic: <span style="color: #dc143c; font-weight: bold;"><?php echo $_SESSION['academic']['year'] . ' ' . (ordinal_suffix($_SESSION['academic']['semester'])) ?></span></b>
                    <div class="card-tools"></div>
                </div>
                <div class="card-body">
                    <fieldset class="border border-info p-2 w-100">
                        <h3><span style="font-weight: bold;">Rating Legend</span></h3>
                        <p>
                            <span style="color: #dc143c; font-weight: bold;">5</span> - Strongly Agree <span style="color: #007bff; font-weight: bold;"> | </span>
                            <span style="color: #dc143c; font-weight: bold;">4</span> - Agree <span style="color: #007bff; font-weight: bold;"> | </span>
                            <span style="color: #dc143c; font-weight: bold;">3</span> - Uncertain <span style="color: #007bff; font-weight: bold;"> | </span>
                            <span style="color: #dc143c; font-weight: bold;">2</span> - Disagree <span style="color: #007bff; font-weight: bold;"> | </span>
                            <span style="color: #dc143c; font-weight: bold;">1</span> - Strongly Disagree
                        </p>
                    </fieldset>
                    <form id="manage-evaluation">
                        <input type="hidden" id="selected-faculty-id" value="<?php echo isset($rid) ? $rid : ''; ?>">
                        <input type="hidden" name="class_id" value="<?php echo $_SESSION['login_class_id'] ?>">
                        <input type="hidden" name="faculty_id" value="<?php echo $faculty_id ?>">
                        <input type="hidden" name="restriction_id" value="<?php echo $rid ?>">
                        <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>">
                        <input type="hidden" name="academic_id" value="<?php echo $_SESSION['academic']['id'] ?>">

                        <?php 
                        $q_arr = array();
                        $criteria = $conn->query("SELECT * FROM criteria_list WHERE id IN 
                            (SELECT criteria_id FROM question_list WHERE academic_id = {$_SESSION['academic']['id']}) 
                            ORDER BY abs(order_by) ASC");
                        while ($crow = $criteria->fetch_assoc()):
                        ?>
                        <table class="table table-condensed">
                            <thead>
                                <tr class="bg-gradient-secondary">
                                    <th class="p-1"><b><?php echo $crow['criteria'] ?></b></th>
                                    <th class="text-center">1</th>
                                    <th class="text-center">2</th>
                                    <th class="text-center">3</th>
                                    <th class="text-center">4</th>
                                    <th class="text-center">5</th>
                                </tr>
                            </thead>
                            <tbody class="tr-sortable">
                                <?php 
                                $questions = $conn->query("SELECT * FROM question_list 
                                    WHERE criteria_id = {$crow['id']} 
                                    AND academic_id = {$_SESSION['academic']['id']} 
                                    ORDER BY abs(order_by) ASC");
                                while ($row = $questions->fetch_assoc()):
                                    $q_arr[$row['id']] = $row;
                                    $isEvaluated = isset($row['evaluation_id']) && $row['evaluation_id'] > 0;
                                ?>
                                <tr class="bg-white">
                                    <td class="p-1" width="40%"><?php echo $row['question'] ?>
                                        <input type="hidden" name="qid[]" value="<?php echo $row['id'] ?>">
                                    </td>
                                    <?php for ($c = 1; $c <= 5; $c++): ?>
                                    <td class="text-center">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="rate[<?php echo $row['id'] ?>]" id="qradio<?php echo $row['id'] . '_' . $c ?>" value="<?php echo $c ?>" <?php echo $isEvaluated ? 'disabled' : ''; ?>>
                                            <label for="qradio<?php echo $row['id'] . '_' . $c ?>"></label>
                                        </div>
                                    </td>
                                    <?php endfor; ?>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <?php endwhile; ?>

                        <fieldset class="border border-info p-2 w-100 mt-4">
                            <legend class="w-auto">Additional Feedback</legend>
                            <p>Please provide any additional comments or feedback here:</p>
                            <textarea name="feedback" class="form-control" rows="4" placeholder="Enter your feedback here..."></textarea>
                        </fieldset>

                        <div class="card-tools mt-3">
                            <button class="btn btn-sm btn-flat btn-primary bg-gradient-primary mx-1" form="manage-evaluation" id="submit-evaluation" disabled>Submit Evaluation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #9b0a1e;
        border-color: black;
    }

    .card-info.card-outline {
        border-top: 3px solid #9b0a1e !important;
    }

    .border-info {
        border-color: #dc143c !important;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .bg-gradient-secondary {
        background: #007bff !important;
        color: #fff;
    }

   .evaluated {
    color: white; 
    cursor: not-allowed; 
    pointer-events: none; /* Disables any interaction with the element */
    user-select: none; /* Prevents text selection */
}

.evaluated .badge {
    cursor: not-allowed;
}

.evaluated input[type="radio"] {
    pointer-events: none; /* Disables radio buttons */
}

.evaluated label {
    pointer-events: none; /* Prevents clicking on the label */
}

.evaluated:hover {
    background-color: transparent; /* Prevents hover effect */
}

    .evaluated { color: white; cursor: not-allowed; } .evaluated .badge { cursor: not-allowed; }

    .bg-gradient-secondary {
    background: #9b0a1e !important;
    color: #fff;
}

@media(max-width: 540px){
    .card{
        margin-top: 10px;
    }
}

@media (max-width: 480px) {
    .card-body table {
        font-size: 12px;
    }

    .card-body table th, 
    .card-body table td {
        padding: 4px;
    }

    .card-body table th {
        font-size: 10px;
    }

    .card-body table td {
        font-size: 10px;
    }

	.card-body table tr{
		font-size: 10px;
	}

    .card-body table .icheck-success {
        font-size: 10px;
    }

    .card-body {
        overflow-x: auto;
    }

    .card-body table {
        width: 100%;
        table-layout: fixed;
    }

}

@media (max-width: 480px) {

    .col-md-8 .card-header {
        font-size: 14px;
        padding: 8px 10px;
    }

	.col-md-8 .card-header .card-tools {
		margin-top: 5px;
		margin-right: 5px;
    }

    .col-md-8 .card-header b {
        font-size: 14px;
    }


    .col-md-8 .card-header .card-tools button {
        font-size: 12px;
        padding: 5px 8px;
    }
    

    .col-md-8 .card-body {
        padding: 10px;
    }

	.col-md-8 .card-body fieldset {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
    }


    .col-md-8 .card-body fieldset legend {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 8px; 
    }
}

</style>


<script>
    $(document).ready(function () {
        // Function to check form completion
        function checkFormCompletion() {
            let allAnswered = true;

            // Check if a faculty is selected
            const facultySelected = $('#selected-faculty-id').val() !== '';

            // Check if all questions are answered
            $('input[type="radio"]').each(function () {
                const name = $(this).attr('name');
                if (!$('input[name="' + name + '"]:checked').length) {
                    allAnswered = false;
                    return false; // Exit loop early
                }
            });

            // Enable or disable the submit button based on conditions
            $('#submit-evaluation').prop('disabled', !(allAnswered && facultySelected));
        }

        // Update faculty selection on click
        $('.list-group-item-action').on('click', function () {
            const selectedFacultyId = $(this).attr('href').split('rid=')[1].split('&')[0];
            $('#selected-faculty-id').val(selectedFacultyId);
            checkFormCompletion();
        });

        // Check form completion when radio buttons are changed
        $('input[type="radio"]').on('change', checkFormCompletion);

        // Initial check
        checkFormCompletion();

        // Form submission
        $('#manage-evaluation').submit(function (e) {
            e.preventDefault();

            // Final validation
            if ($('#selected-faculty-id').val() === '') {
                alert("Please select a faculty from the list.");
                return;
            }

            start_load();
            $.ajax({
                url: 'ajax.php?action=save_evaluation',
                data: $(this).serialize(),
                method: 'POST',
                success: function (resp) {
                    if (resp == 1) {
                        alert_toast("Evaluation successfully submitted", 'success');
                        setTimeout(function () {
                            window.location.href = './index.php?page=evaluate';
                        }, 1500);
                    }
                }
            });
        });
    });
</script>
