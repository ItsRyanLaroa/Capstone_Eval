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

// Get the faculty ID from the session
$teacher_id = is_array($_SESSION['login_id']) ? $_SESSION['login_id']['id'] : $_SESSION['login_id'];

// Fetch data for the filter dropdown
$academic_data = $conn->query("
    SELECT DISTINCT CONCAT(year, ' - ', semester) AS academic_term, id
    FROM academic_list
    ORDER BY year DESC, semester ASC
");

// Fetch evaluations with a direct join
$evaluations = $conn->query("
    SELECT 
        sl.subject,
        CONCAT(st.firstname, ' ', st.lastname) AS student_name,
        a.year AS academic_year,
        a.semester AS academic_semester,
        CONCAT(cl.level, ' - ', cl.section) AS class_details,
        cl.curriculum,
        st.avatar
    FROM evaluation_list r
    LEFT JOIN subject_list sl ON r.subject_id = sl.id
    LEFT JOIN student_list st ON r.student_id = st.id
    LEFT JOIN class_list cl ON r.class_id = cl.id
    LEFT JOIN academic_list a ON r.academic_id = a.id
    WHERE r.faculty_id = '$teacher_id'
    ORDER BY a.year DESC, a.semester ASC, st.lastname ASC
");
?>
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="text-center" style="font-weight: bold; color: #dc143c;">Students Who Evaluated</h3>
            <div class="dataTables_length" id="evaluation-table_length" style="max-width: 180px;">
                <label for="academic-filter">Filter by Year & Semester:</label>
                <select id="academic-filter" class="form-control ml-2">
                    <option value="">All</option>
                    <?php while ($row = $academic_data->fetch_assoc()): ?>
                        <option value="<?php echo $row['academic_term']; ?>"><?php echo $row['academic_term']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered styled-table" id="evaluation-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Subject</th>
                        <th>Academic Year</th>
                        <th>Class</th>
                    </tr>
                </thead>
                <tbody id="evaluation-table-body">
                    <?php while ($row = $evaluations->fetch_assoc()): ?>
                    <tr data-academic-term="<?php echo $row['academic_year'] . ' - ' . $row['academic_semester']; ?>">
                        <td><?php echo ucwords($row['student_name']); ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['academic_year'] . ' ' . ordinal_suffix($row['academic_semester']) . ' Semester'; ?></td>
                        <td><?php echo $row['curriculum'] . ' (' . $row['class_details'] . ')'; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .card-header {
 
 border: none;

}
    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }
    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }
    thead th {
        background-color: #9b0a1e;
        color: #f3f3f3;
        font-weight: bold;
    }
    tbody tr:hover {
        background-color: #95d2ec;
    }

    .card-success.card-outline{
        border-top: 3px solid #9b0a1e !important;
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

    .dataTables_length,
    .dataTables_filter {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        font-size: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .dataTables_length select,
    .dataTables_filter input {
        width: 100%;
    }

    .dataTables_length label,
    .dataTables_filter label {
        font-size: 0.75rem;
    }

   
    .dataTables_paginate {
        font-size: 0.75rem;
    }

    .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
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

    .dataTables_length,
    .dataTables_filter {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        font-size: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .dataTables_length select,
    .dataTables_filter input {
        width: 100%;
    }

    .dataTables_length label,
    .dataTables_filter label {
        font-size: 0.75rem;
    }

   
    .dataTables_paginate {
        font-size: 0.75rem;
    }

    .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
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

    .dataTables_length,
    .dataTables_filter {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        font-size: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .dataTables_length select,
    .dataTables_filter input {
        width: 100%;
    }

    .dataTables_length label,
    .dataTables_filter label {
        font-size: 0.75rem;
    }

   
    .dataTables_paginate {
        font-size: 0.75rem;
    }

    .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
}
</style>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#evaluation-table').dataTable();

        // Filter rows based on academic term
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
</script>
