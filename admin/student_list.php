<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_student"><i class="fa fa-plus"></i> <span style="color: #dc143c; font-weight: bold;">Add New Student</span></a>
			</div>
		</div>
		<div class="card-body">
		<table class="table tabe-hover table-bordered styled-table" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>School ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Year & Section</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$class= array();
					$classes = $conn->query("SELECT id,concat(curriculum,' ',level,' - ',section) as `class` FROM class_list");
					while($row=$classes->fetch_assoc()){
						$class[$row['id']] = $row['class'];
					}
					$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM student_list order by concat(firstname,' ',lastname) asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo $row['school_id'] ?></b></td>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['email'] ?></b></td>
						<td><b><?php echo isset($class[$row['class_id']]) ? $class[$row['class_id']] : "N/A" ?></b></td>
						<td><b><?php echo $row['status'] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_student" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_student&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_student" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
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
.card-success.card-outline {
    border-top: none;
}
.card-tools i{
    color: #dc143c;
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

/* Button styles */
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

/* Hover effect for rows */
tbody tr:hover {
    background-color: #95d2ec;
}

@media (max-width: 540px) {
    .card-body {
        padding: 0.25rem;
        font-size: 0.75rem;
    }

    .table {
        font-size: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .styled-table tbody tr td {
        padding: 0.25rem;
    }

    .btn, .btn-sm {
        font-size: 0.7rem;
        padding: 0.25rem 0.4rem;
    }


    .card-header {
        padding: 0.5rem;
    }

    .dropdown-menu {
        font-size: 0.7rem;
        padding: 0.5rem 0;
    }

    .dropdown-item {
        padding: 0.25rem 0.5rem;
    }


    thead th {
        padding: 0.25rem;
        font-size: 0.75rem;
    }


    tbody tr {
        height: 35px;
    }


    .text-center {
        text-align: center;
    }


    .btn-flat {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }


    .card-outline {
        border-width: 1px;
    }


    th, td {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }


    .dropdown-toggle {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }

    .card-header .card-tools{
        margin-right: 3px;
        margin-top: 3px;
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
    .card-body {
        padding: 0.1rem;
        font-size: 0.55rem;
        overflow-x: auto;
        width: 100%;
    }

    .table {
        font-size: 0.55rem;
        margin-bottom: 0.1rem;
        min-width: 600px; 
    }

    .styled-table tbody tr td {
        padding: 0.1rem;
    }

    .btn, .btn-sm {
        font-size: 0.55rem;
        padding: 0.1rem 0.25rem;
    }

    .dropdown-menu {
        font-size: 0.55rem;
        padding: 0.1rem 0;
    }

    .dropdown-item {
        padding: 0.1rem 0.25rem;
    }

    thead th {
        padding: 0.1rem;
        font-size: 0.75rem;
    }


    tbody tr {
        height: 24px;
    }


    .text-center {
        text-align: center;
    }

    .btn-flat {
        font-size: 0.55rem;
        padding: 0.1rem 0.25rem;
    }


    .dropdown-toggle {
        font-size: 0.55rem;
        padding: 0.1rem 0.25rem;
    }
  
    body {
        margin: 0;
        padding: 0;
    }

    .card {
        margin: 0; 
        width: 100%; 
    }


    .table, .card-body, .card-header {
        width: 100%;
    }


    .dropdown-divider {
        margin: 0.2rem 0;
    }

    .text-info {
        font-size: 0.6rem;
    }


    tbody tr td, tbody tr th {
        padding: 0.1rem 0.2rem;
    }


    .table-bordered, .card-outline {
        border-width: 0;
    }

    .card-header .card-tools{
        margin-right: 3px;
        margin-top: 3px;
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
	$(document).ready(function(){
	$('.view_student').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> student Details","<?php echo $_SESSION['login_view_folder'] ?>view_student.php?id="+$(this).attr('data-id'))
	})
	$('.delete_student').click(function(){
	_conf("Are you sure to delete this student?","delete_student",[$(this).attr('data-id')])
	})
		$('#list').dataTable()
	})
	function delete_student($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_student',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>