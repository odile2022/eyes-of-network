<?php
require_once("./incident_header.php");
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Configuration</h1>
			<div class="table-title">
				<div class="row">
					<div class="col" style="padding:10px;">
						<a onclick="deleteItem()" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
						<a href="#addEmployeeModal" class="pull-right btn btn-success" data-toggle="modal" disabled><i class="material-icons">&#xE147;</i> <span>Ajout Configuration</span></a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="dataTable_wrapper">
				<table id="table_grp_equip" class="table table-striped datatable-eonweb-ajax table-condensed table-hover">
				</table>
		</div>
	</div> 
	<!-- Add Modal HTML -->
	<!--
	<div id="addEmployeeModal" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form method="post" action="controlleur.php?action=save_configuration">
						<div class="modal-header">						
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Ajout Configuration</h4>
						</div>
						<div class="modal-body">				
							<div class="form-group">
								<label>log_execution</label>
								<input type="text" class="form-control" name='log_execution' required>
							</div>
							<div class="form-group">
								<label>Commentaire</label>
								<input type="text" class="form-control" name='commentaire' required>
							</div>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-success" value="Add">
						</div>
					</form>
				</div>
			</div>
		</div>
		-->
		<!-- Edit Modal HTML -->
		<div id="editEmployeeModal" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form method="post" action="controlleur.php?action=edit_configuration">
						<div class="modal-header">						
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Mise a jour Configuration</h4>
						</div>
						<div class="modal-body">					
							<input type="hidden" name='id'>
							<div class="form-group">
								<label>Configuration</label>
								<input type="text" class="form-control" name='configuration' required>
								<input type="hidden" class="commandes" name='commandes' required>
							</div>			
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-info" value="Save">
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Delete Modal HTML -->
		<div id="deleteEmployeeModal" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
				<form method="post" action="controlleur.php?action=delete_configuration">
						<div class="modal-header">						
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Delete Employee</h4>
						</div>
						<div class="modal-body">					
							<p>Are you sure you want to delete these Records?</p>
							<p class="text-warning"><small>This action cannot be undone.</small></p>
							<p class="text-warning" id="deleteItemsContainer" style="word-wrap: break-word"></p>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-danger" value="Delete">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> 
</div>

<?php
$extraFooterTags = "<script> var dataSet =". json_encode(DB::configuration()->tableData()).";".
<<<EOF
 
$(document).ready(function() {
    $('#table_grp_equip').DataTable( {
        data: dataSet,
        columns: [{ 
			title: "<span style='position: relative;left: -3px;'><input type='checkbox' id='selectAll'><label for='selectAll'></label></span>",
			orderable: false
		},{ 
			title: "Configuration"
		},{ 
			title: "Date"
		},{ 
			title: "Commentaire"
		},{ 
			title: "Actions",
			orderable: false
		}]
    } );

    // Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}else{
			$("#selectAll").prop("checked", $('.custom-checkbox input[type="checkbox"]:checked').length == $('.custom-checkbox input[type="checkbox"]').length);
		}
	});
} );

function editItem(btn, id){
	const item = JSON.parse($('#row_data_'+id).val());
	console.log('edit: '+item);
	$('#editEmployeeModal input[name=id]').val(id);
	$('#editEmployeeModal input[name=date]').val(item.date);
	$('#editEmployeeModal input[name=log_execution]').val(item.log_execution);
	$('#editEmployeeModal input[name=commentaire]').val(item.commentaire);
	$('#editEmployeeModal').modal();
}
function deleteItem(btn, id){
	$('#deleteItemsContainer').empty();
	if(id){
		const item = JSON.parse($('#row_data_'+id).val());
		$('#deleteItemsContainer').append(
			"<span class='label label-warning' style='margin: 0.2em'><input type='hidden' name='id[]' value="+item.id+">"+item.nom+"</span>"
		);
	}else{
		$('.row_data_input').each((key, val) => {
			const checked = $(val).children('input:checked').val();
			if(checked){
				const item = JSON.parse($(val).children('input[type=hidden]').val());
				$('#deleteItemsContainer').append(
					"<span class='label label-warning' style='margin: 0.2em'><input type='hidden' name='id[]' value="+item.id+">"+item.nom+"</span>"
				);
			}
		});
	}
	$('#deleteEmployeeModal').modal();
}
</script>
EOF;

include("../../footer.php");

?>