<?php

#########################################
#
# Copyright (C) 2017 EyesOfNetwork Team
# DEV NAME : Quentin HOARAU
# VERSION : 5.2
# APPLICATION : eonweb for eyesofnetwork project
#
# LICENCE :
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
#########################################
$extraHeaderTags = <<<EOF

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
	.table-responsive {
        margin: 30px 0;
    }
	.table-wrapper {
		min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
	.table-title .btn {
		color: #fff;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td i.edit {
        color: #FFC107;
    }
    table.table td i.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Custom checkbox */
	/*.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {    
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	/*.modal .modal-dialog {
		max-width: 400px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}
</style>
EOF;

require_once("./DB.php");
include("../../header.php");
include("../../side.php");
include("ged_functions.php");


?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Groupes d'equipements</h1>
			<div class="table-title">
				<div class="row">
					<div class="col" style="padding:10px;">
						<a onclick="deleteItem()" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
						<a href="#addEmployeeModal" class="pull-right btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
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
		<div id="addEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="controlleur.php?action=save_type_equipement">
						<div class="modal-header">						
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Ajout Groupe d'equippement</h4>
						</div>
						<div class="modal-body">					
							<div class="form-group">
								<label>Nom</label>
								<input type="text" class="form-control" name='nom' required>
							</div>
							<div class="form-group">
								<label>Nom fichier</label>
								<input type="text" class="form-control" name='chemin_fichier' required>
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
		<!-- Edit Modal HTML -->
		<div id="editEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="controlleur.php?action=edit_type_equipement">
						<div class="modal-header">						
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Mise a jour Groupe d'equippement</h4>
						</div>
						<div class="modal-body">					
							<input type="hidden" name='id'>
							<div class="form-group">
								<label>Nom</label>
								<input type="text" class="form-control" name='nom' required>
							</div>
							<div class="form-group">
								<label>Nom fichier</label>
								<input type="text" class="form-control" name='chemin_fichier' required>
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
			<div class="modal-dialog">
				<div class="modal-content">
				<form method="post" action="controlleur.php?action=delete_type_equipement">
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
$extraFooterTags = "<script> var dataSet =". json_encode(DB::typeEquipement()->tableData()).";".
<<<EOF
/*
	var dataSet = [
    [ "<span class='custom-checkbox'><input type='checkbox' name='options[]' value='1'></span>", "Unity Butler", "Marketing Designer", "San Francisco", "5384", "2009/12/09", "$85,675" ]
];
//*/
 
$(document).ready(function() {
    $('#table_grp_equip').DataTable( {
        data: dataSet,
        columns: [{ 
			title: "<span style='position: relative;left: -3px;'><input type='checkbox' id='selectAll'><label for='selectAll'></label></span>",
			orderable: false
		},{ 
			title: "Nom"
		},{ 
			title: "Chemin du fichier"
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
	$('#editEmployeeModal input[name=nom]').val(item.nom);
	$('#editEmployeeModal input[name=chemin_fichier]').val(item.chemin_fichier);
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


?>
<?php include("../../footer.php"); ?>