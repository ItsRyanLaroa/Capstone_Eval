<?php 
include 'db_connect.php';

function ordinal_suffix($num) {
    $num = $num % 100;
    if ($num < 11 || $num > 13) {
        switch ($num % 10) {
            case 1: return $num . 'st';
            case 2: return $num . 'nd';
            case 3: return $num . 'rd';
        }
    }
    return $num . 'th';
}
?>

<div class="col-lg-12">
    <div class="callout callout-info">
        <span style="color: #dc143c"><h3 class="text-center" style="font-weight: bold;">List of teachers you've evaluated</h3></span>
        
        <!-- Academic Year and Semester Filter -->
        <div class="dataTables" id="evaluation-table_length">
            <label for="academic-filter">Year & Semester:</label>
            <select id="academic-filter">
                <option value="">All</option>
                <?php 
                // Fetch academic years and semesters dynamically with additional columns
                $academic_data = $conn->query("
                    SELECT DISTINCT CONCAT(year, ' - ', semester) AS academic_term, id, year, semester
                    FROM academic_list
                    ORDER BY year DESC, semester ASC
                ");
                while ($row = $academic_data->fetch_assoc()): ?>
                    <option value="<?php echo $row['academic_term']; ?>">
                        <?php echo $row['academic_term']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <table class="table table-hover table-bordered styled-table" id="evaluation-table">
            <thead class="bg-gradient-secondary text-white">
                <tr>
                    <th>Faculty Name</th>
                    <th>Subject</th>
                    <th>Academic Year</th>
                    <th>Class</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="evaluation-table-body">
                <?php 
                $student_id = $_SESSION['login_id'];
                $academic_id = $_SESSION['academic']['id'];

                $evaluations = $conn->query("SELECT DISTINCT 
                CONCAT(f.lastname, ', ', f.firstname) AS faculty_name,
                sl.subject,
                a.year AS academic_year,
                a.semester AS academic_semester,
                CONCAT(cl.level, ' - ', cl.section) AS class_details,
                cl.curriculum,
                r.faculty_id,
                f.avatar,
                f.lastname
            FROM evaluation_list r
            LEFT JOIN subject_list sl ON r.subject_id = sl.id
            LEFT JOIN faculty_list f ON r.faculty_id = f.id
            LEFT JOIN class_list cl ON r.class_id = cl.id
            LEFT JOIN academic_list a ON r.academic_id = a.id
            WHERE r.student_id = '$student_id'
            ORDER BY f.lastname ASC");

                while ($row = $evaluations->fetch_assoc()): 
                    $avatar = !empty($row['avatar']) ? 'assets/uploads/' . $row['avatar'] : 'assets/uploads/default_avatar.png';
                ?>
                <tr data-academic-term="<?php echo $row['academic_year'] . ' - ' . $row['academic_semester']; ?>">
                    <td><?php echo ucwords($row['faculty_name']); ?></td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['academic_year'] . ' ' . ordinal_suffix($row['academic_semester']) . ' Semester'; ?></td>
                    <td><?php echo $row['curriculum'] . ' (' . $row['class_details'] . ')'; ?></td>
                    <td><span class="badge badge-success">Completed</span></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
   .badge-success {
    background-color: #ffc107;
    color: #000;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    max-width: 80px;
}

    .bg-gradient-secondary {
        background: #B31B1C linear-gradient(182deg, #b31b1b, #dc3545) repeat-x !important;
        color: #fff;
    }
    .rounded-circle {
        border-radius: 50%;
    }
    #pagination-controls button {
        margin: 0 5px;
        border: none;
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border-radius: 3px;
        cursor: pointer;
    }
    #pagination-controls button.active {
        background-color: #007bff;
    }
    #pagination-controls button:disabled {
        background-color: #d6d6d6;
        cursor: not-allowed;
    }
    .table-hover tbody tr:hover {
        background-color: #f2f2f2;
    }

    .callout.callout-info{
        border-left-color: #9b0a1e;
    }

    @media (max-width: 540px) {
    .callout.callout-info {
        padding: 10px;
        font-size: 14px;
    }

    .btn-info {
        font-size: 12px;
    }

    .card-body {
        padding: 10px;
    }

    .table th, .table td {
        font-size: 12px;
        padding: 8px;
    }

    .font-weight-bold {
        font-size: 14px;
    }

    .ml-3 h5 {
        font-size: 20px;
    }
}
.dataTables_length{
    float: left;
   
    
}

   

@media (max-width: 430px) {
    .callout.callout-info {
        padding: 8px;
        font-size: 12px;
    }

    .input-group.mb-3 {
        max-width: 90%;
    }

    .btn-info {
        font-size: 10px;
        padding: 5px 10px;
    }

    .card-body {
        padding: 8px;
    }

    .table th, .table td {
        font-size: 10px;
        padding: 6px;
    }

    .font-weight-bold {
        font-size: 12px;
    }

    .ml-3 h5 {
        font-size: 18px;
    }
}

@media (max-width: 414px) {
    .callout.callout-info {
        padding: 6px;
        font-size: 10px;
    }

    .input-group.mb-3 {
        max-width: 95%;
    }

    .btn-info {
        font-size: 9px;
        padding: 4px 8px;
    }

    .card-body {
        padding: 6px;
    }

    .table th, .table td {
        font-size: 9px;
        padding: 5px;
    }

    .font-weight-bold {
        font-size: 10px;
    }

    .ml-3 h5 {
        font-size: 16px;
    }
}
</style>

<script>
    $(document).ready(function() {
        $('#evaluation-table').dataTable();

        // Academic Year and Semester Filtering
        $('#academic-filter').on('change', function() {
            const selectedTerm = $(this).val();

            $('#evaluation-table-body tr').each(function() {
                const rowTerm = $(this).data('academic-term');
                if (selectedTerm === "" || rowTerm == selectedTerm) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
   $(document).ready(function() {
        $('#evaluation-table').dataTable();
        
        let rowsPerPage = 5;
        let currentPage = 1;

        $('#search-input').on('keyup', function() {
            let value = $(this).val().toLowerCase();
            filterTableRows(value);
        });

        $('#rows-per-page').on('change', function() {
            rowsPerPage = parseInt($(this).val());
            currentPage = 1;
            paginateTableRows();
        });

        function filterTableRows(query) {
            $('#evaluation-table-body tr').each(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
            });
            paginateTableRows();
        }

        function paginateTableRows() {
            const rows = $('#evaluation-table-body tr');
            const totalRows = rows.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage);
            rows.hide();

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            rows.slice(start, end).show();

            renderPaginationControls(totalPages);
        }

        function renderPaginationControls(totalPages) {
            $('#pagination-controls').empty();

            const prevButton = $('<button></button>')
                .text('Previous')
                .prop('disabled', currentPage === 1)
                .on('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        paginateTableRows();
                    }
                });

            const nextButton = $('<button></button>')
                .text('Next')
                .prop('disabled', currentPage === totalPages)
                .on('click', function() {
                    if (currentPage < totalPages) {
                        currentPage++;
                        paginateTableRows();
                    }
                });

            $('#pagination-controls').append(prevButton);

            for (let i = 1; i <= totalPages; i++) {
                const btn = $('<button></button>')
                    .text(i)
                    .addClass(i === currentPage ? 'active' : '')
                    .on('click', function() {
                        currentPage = i;
                        paginateTableRows();
                    });
                $('#pagination-controls').append(btn);
            }

            $('#pagination-controls').append(nextButton);
        }

        paginateTableRows();
    });
</script>
