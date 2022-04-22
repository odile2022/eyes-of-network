<?php
require_once("./incident_header.php");
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Work On Equipment</h1>
			<div class="table-title">
				<div class="row">
					<div class="col" style="padding:10px;">
						<a onclick="deleteItem()" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
						<a href="#addFichierConfigModal" class="pull-right btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajout Fichier Configuration</span></a>
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
	<div id="addFichierConfigModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="taches_json_form" method="post" action="controlleur.php?action=save_fichier_configuration">
						<div class="modal-header">						
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Ajout Fichier Configuration</h4>
						</div>
						<div class="modal-body" style="max-height: 400px; overflow-y: scroll;">					
							<div class="form-group">
								<label>Nom</label>
								<input type="text" class="form-control" name='nom' required>
								<input type="hidden" class="commandes" name='commandes' required>
							</div>
							<div class="form-group">
								<label>Variables</label>
								<input type="text" class="form-control" name='variables'>
							</div>
							<div class="form-group">
								<label>Type_equipement</label>
								<input type="text" class="form-control" name='type_equipement' required>
							</div>
							<fieldset class="form-fieldset">
								<legend>
									<i class="delete material-icons" onclick="deleteFormFieldset(this);">&#xE872;</i>
									Tache
								</legend>
								<div class="form-group">
									<label>Libelle</label>
									<input type="text" class="form-control nom_tache_input" name='nom_tache' required>
								</div>
								<div class="form-group">
									<label>Commandes</label>
									<textarea class="form-control commandes_tache_input" name="commandes_tache" rows="3" cols="50"></textarea>
								</div>
							<fieldset>
						</div>
						<div class="modal-footer">
							<input onclick="addFormFieldset('#addFichierConfigModal');" type="button" class="btn btn-primary" style="float: left;" value="Ajouter une tache">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-success" value="Add">
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Edit Modal HTML -->
		<div id="editFichierConfigModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="taches_json_form" method="post" action="controlleur.php?action=edit_fichier_configuration">
						<div class="modal-header">						
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Mise a jour Groupe d'equippement</h4>
						</div>
						<div class="modal-body">					
							<input type="hidden" name='id'>
							<div class="form-group">
								<label>Nom</label>
								<input type="text" class="form-control" name='nom' required>
								<input type="hidden" class="commandes" name='commandes' required>
							</div>
							<div class="form-group">
								<label>Variables</label>
								<input type="text" class="form-control" name='variables'>
							</div>	
							<div class="form-group">
								<label>Type_equipement</label>
								<input type="text" class="form-control" name='type_equipement' required>
							</div>			
						</div>
						<div class="modal-footer">
							<input onclick="addFormFieldset('#editFichierConfigModal');" type="button" class="btn btn-primary" style="float: left;" value="Ajouter une tache">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-success" value="Save">
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Delete Modal HTML -->
		<div id="deleteFichierConfigModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
				<form method="post" action="controlleur.php?action=delete_fichier_configuration">
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
$extraFooterTags = "<script> var dataSet =". json_encode(DB::fichierConfig()->tableData()).";".
<<<EOF
 
$(document).ready(function() {
    $('#table_grp_equip').DataTable( {
        data: dataSet,
        columns: [{ 
			title: "<span style='position: relative;left: -3px;'><input type='checkbox' id='selectAll'><label for='selectAll'></label></span>",
			orderable: false
		},{ 
			title: "Nom"
		},{ 
			title: "Commandes"
		},{ 
			title: "variables"
		},{ 
			title: "Type_equipement"
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
	$('#editFichierConfigModal input[name=id]').val(id);
	$('#editFichierConfigModal input[name=nom]').val(item.nom);
	$('#editFichierConfigModal input[name=type_equipement]').val(item.type_equipement);
	$('#editFichierConfigModal input[name=variables]').val(item.variables);
	$('#editFichierConfigModal input[name=commandes]').val(item.commandes);
	if(item.commandes){
		const commandes = JSON.parse(item.commandes);
		commandes.forEach(function (cmd, index) {
			addFormFieldset('#editFichierConfigModal', cmd)                      
		});
	}
	$('#editFichierConfigModal').modal();
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
	$('#deleteFichierConfigModal').modal();
}

function deleteFormFieldset(btn){
	$(btn).closest('fieldset').remove();
}

function addFormFieldset(formDialogId, task={name:'', commands:''}){
	$(formDialogId).find('.modal-body').append(
		'<fieldset class="form-fieldset"><legend><i class="delete material-icons" onclick="deleteFormFieldset(this);">&#xE872;</i>Tache</legend><div class="form-group"><label>Libelle</label><input type="text" class="form-control nom_tache_input" name="nom_tache" value="'+task.name+'" required></div><div class="form-group"><label>Commandes</label><textarea class="form-control commandes_tache_input" name="commandes_tache" rows="3" cols="50">'+task.commands+'</textarea></div><fieldset>'
	);
}

$('.taches_json_form').on('submit', function (e) {
    const tasks = [];
    $(this).find('.form-fieldset').each((index, elm) => {
        tasks.push({
            'name': $(elm).find('.nom_tache_input').val(),
            'commands': $(elm).find('.commandes_tache_input').val(),
        });
    });
	$(this).find('.commandes').val(JSON.stringify(tasks))
});
</script>
EOF;

include("../../footer.php");

?>