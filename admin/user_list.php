<?php include'db_connect.php' ?>
<style>
	.card-success.card-outline{
		border-top: 3px solid #9b0a1e;;
	}

	.card-tools i{
		color: #dc143c;
		font-weight: bold;
	}

	thead th {
    background-color: #9b0a1e;
    color: #f3f3f3;
    font-weight: bold;
}

@media (max-width: 540px) {
        .card-body {
            padding: 10px;
        }

        .card {
            margin: 0 auto;
            width: 90%;
        }

        .card-header {
            padding: 5px;
        }

        .table {
            font-size: 12px;
        }


        .btn-sm {
            font-size: 10px;
            padding: 5px 10px;
        }


        .card-header .card-tools {
            display: flex;
            justify-content: center;
        }

		.card-header .card-tools {
            font-size: 12px;
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
            padding: 8px;
        }

        .card {
            margin: 0 auto;
            width: 95%;
        }

        .card-header {
            padding: 5px;
        }

        .card-tools {
            font-size: 10px;
        }


        .table {
            font-size: 10px;
        }


        .btn-sm {
            font-size: 9px;
            padding: 4px 8px;
        }


        .card-header .card-tools {
            display: flex;
            justify-content: center;
        }

        .card-tools a {
            font-size: 10px;
            padding: 4px 8px;
        }

        
        td, th {
            font-size: 10px;
        }


        td b, th {
            white-space: nowrap; 
            text-overflow: ellipsis;
            overflow: hidden;
        }

		.card-header .card-tools {
            font-size: 12px;
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

	@media (max-width: 414px) {
        .card-body {
            padding: 8px; 
        }

        .card {
            margin: 0 auto; 
            width: 95%; 
        }

        .card-header {
            padding: 5px; 
        }


        .table {
            font-size: 10px; 
        }

        .btn-sm {
            font-size: 9px;
            padding: 4px 8px;
        }


        .card-header .card-tools {
            display: flex;
            justify-content: center;
        }

        .card-tools a {
            font-size: 10px; 
            padding: 4px 8px;
        }

        td, th {
            font-size: 10px;
        }


        td b, th {
            white-space: nowrap; 
            text-overflow: ellipsis;
            overflow: hidden;
        }

		.card-header .card-tools {
            font-size: 12px;
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

	@media (max-width: 390px) {
        .card-body {
            padding: 6px;
        }

        .card {
            margin: 0 auto;
            width: 100%;
        }

        .card-header {
            padding: 4px;
        }


        .table {
            font-size: 9px;
        }


        .btn-sm {
            font-size: 8px;
            padding: 3px 6px;
        }


        .card-header .card-tools {
            display: flex;
            justify-content: center;
        }

        .card-tools a {
            font-size: 9px;
            padding: 3px 6px;
        }


        td, th {
            font-size: 9px;
        }

        td b, th {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .card-header .card-tools a {
            padding: 3px 6px;
            font-size: 8px;
        }

		.card-header .card-tools {
            font-size: 12px;
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
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_user"><i class="fa fa-plus"></i> <span style="color: #dc143c; font-weight: bold;">Add New User</span></a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users order by concat(firstname,' ',lastname) asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['email'] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_user&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
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
	$('.view_user').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> User Details","view_user.php?id="+$(this).attr('data-id'))
	})
	$('.delete_user').click(function(){
	_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
		$('#list').dataTable()
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
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