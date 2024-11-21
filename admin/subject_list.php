<style>
/* Modern table styling */
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 0;
    border: none;
    color: #333;
    font-weight: 500; /* Add slight boldness */
}

/* Styled table */
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

/* Red table header */
.card-primary.card-outline {
    border-top: none;
}

thead th {
    background-color: #9b0a1e;
    color: #f3f3f3;
    font-weight: bold;
}

/* Card header styling */
.card-header {
    background-color: transparent;
    border-bottom: none;
    padding: .75rem 1.25rem;
    position: relative;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}

.btn-primary {
    color: blue;
    background-color: transparent;
    border: none;
}

.btn-danger {
    color: red;
	background-color: transparent;
    border: none;
}

.card-tools i{
    color: #dc143c;
    font-weight: bold;
}

/* Hover effect for rows */
tbody tr:hover {
    background-color: #95d2ec;
}

.btn-primary{
    color: #007bff;
}

@media (max-width: 770px) {
    .card-body {
        padding: 0.5rem;
        font-size: 0.875rem;
    }
    

    table.styled-table {
        font-size: 0.875rem;
    }

    table.styled-table th,
    table.styled-table td {
        padding: 0.5rem;
    }

    .card-header {
        padding: 0.5rem 1rem;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
    }

    .btn {
        font-size: 0.875rem;
    }

    .new_subject {
        font-size: 0.875rem;
    }

    .dataTables_length {
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .dataTables_filter {
        margin-bottom: .5rem;
        font-size: 0.875rem;
    }

    .dataTables_length,
    .dataTables_filter {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .dataTables_length label,
    .dataTables_filter label {
        font-size: 0.875rem;
    }

    .dataTables_length select,
    .dataTables_filter input {
        width: 100%;
    }

    .dataTables_paginate {
        font-size: 0.875rem;
    }

    .dataTables_paginate .paginate_button {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
}

@media (max-width: 500px) {

    .card-body {
        padding: 0.25rem;
        font-size: 0.75rem; 
    }

    .card-header {
        padding: 0.5rem 1rem;
    }


    table.styled-table {
        font-size: 0.75rem;
    }

    table.styled-table th,
    table.styled-table td {
        padding: 0.25rem; 
    }


    .btn-primary,
    .btn-danger {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
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

    .card-header {
        padding: 0.5rem 1rem;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
    }

    .new_subject {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
}

@media (max-width: 390px) {
    .card-body {
        padding: 0.2rem !important;
        font-size: 0.625rem !important; 
    }

    .card-header {
        padding: 0.2rem 0.5rem !important;
    }

    .card-header .card-tools{
        margin: 5px !important;
    }

    table.styled-table {
        font-size: 0.625rem !important;
    }

    table.styled-table th,
    table.styled-table td {
        padding: 0.2rem !important;
    }

    .btn-primary,
    .btn-danger {
        font-size: 0.625rem !important;
        padding: 0.2rem 0.5rem !important;
    }

    .dataTables_length,
    .dataTables_filter {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        font-size: 0.625rem !important;
        margin-bottom: 0.5rem !important;
    }

    .dataTables_length select,
    .dataTables_filter input {
        width: 100% !important;
    }

    .dataTables_length label,
    .dataTables_filter label {
        font-size: 0.625rem !important; 
    }

    .dataTables_paginate {
        font-size: 0.625rem !important;
    }

    .dataTables_paginate .paginate_button {
        padding: 0.2rem 0.5rem !important;
        font-size: 0.625rem !important;
    }

    .card-header {
        padding: 0.2rem 0.5rem !important;
    }

    .btn-group {
        display: flex !important;
        flex-direction: column !important;
    }

    .new_subject {
        font-size: 0.625rem !important;
        padding: 0.2rem 0.5rem !important;
    }
}

@media (max-width: 412px) {
    .card-body {
        padding: 0.25rem;
        font-size: 0.6875rem;
    }

    .card-header {
        padding: 0.25rem 0.5rem;
    }

    .card-header .card-tools{
        margin: 5px;
    }

    table.styled-table {
        font-size: 0.6875rem;
    }

    table.styled-table th,
    table.styled-table td {
        padding: 0.25rem;
    }

    .btn-primary,
    .btn-danger {
        font-size: 0.6875rem;
        padding: 0.25rem 0.5rem;
    }

    .dataTables_length,
    .dataTables_filter {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        font-size: 0.6875rem;
        margin-bottom: 0.5rem;
    }

    .dataTables_length select,
    .dataTables_filter input {
        width: 100%;
    }

    .dataTables_length label,
    .dataTables_filter label {
        font-size: 0.6875rem; 
    }

    .dataTables_paginate {
        font-size: 0.6875rem;
    }

    .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.5rem;
        font-size: 0.6875rem;
    }

    .card-header {
        padding: 0.25rem 0.5rem;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
    }

    .new_subject {
        font-size: 0.6875rem;
        padding: 0.25rem 0.5rem;
    }
}

</style>


<?php include 'db_connect.php' ?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary new_subject" href="javascript:void(0)">
                    <i class="fa fa-plus"></i> <span style="color: #dc143c; font-weight: bold;">Add New</span>
                </a>
            </div>
        </div>
        <div class="card-body">
        <table class="table tabe-hover table-bordered styled-table" id="list">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="30%">
                    <col width="40%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Code</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM subject_list ORDER BY subject ASC ");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <th class="text-center"><?php echo $i++ ?></th>
                        <td><b><?php echo $row['code'] ?></b></td>
                        <td><b><?php echo $row['subject'] ?></b></td>
                        <td><b><?php echo $row['description'] ?></b></td>
                        <td class="text-center">
                        <div class="btn-group">
                                    <a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_subject">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-flat delete_subject" data-id="<?php echo $row['id'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a class="dropdown-item class_student manage-subject-btn" href="index.php?page=subject_teacher&id=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></a>
                                    </a>
                                </div>
                        </td>
                    </tr>	
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.new_subject').click(function(){
            uni_modal("New subject", "<?php echo $_SESSION['login_view_folder'] ?>manage_subject.php")
        })
        $('.manage_subject').click(function(){
            uni_modal("Manage subject", "<?php echo $_SESSION['login_view_folder'] ?>manage_subject.php?id=" + $(this).attr('data-id'))
        })
        $('.delete_subject').click(function(){
            _conf("Are you sure to delete this subject?", "delete_subject", [$(this).attr('data-id')])
        })
        $('#list').dataTable()
    })

    function delete_subject($id){
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_subject',
            method: 'POST',
            data: {id: $id},
            success: function(resp){
                if(resp == 1){
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function(){
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>
