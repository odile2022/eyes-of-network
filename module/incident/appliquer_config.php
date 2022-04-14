<?php
require_once("./incident_header.php");
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Appliquer une configuration</h1>
			<div class="row">
			<?php 
			$id = $_GET['id'];
			$config = DB::fichierConfig()->find($id);
			if($config){ ?>
			<div class="col-lg-12" style="padding:10px;">
				<h2>Config: <?php echo $config['nom']; ?></h2>
				<form class="taches_json_form" method="post" action="controlleur.php?action=save_fichier_configuration">
					<div class="dataTable_wrapper">
						<fieldset class='form-fieldset' style='margin:1em 0'>
							<legend>Liste des equipements a considerer</legend>
							<table id="table_conf_equip" class="table table-striped datatable-eonweb-ajax table-condensed table-hover"></table>
						</fieldset>
					<?php
						if($config['variables']){
							$vars = explode(',',trim($config['variables']));
							echo "<fieldset class='form-fieldset' style='margin:1em 0'>"; 
							echo "<legend>Valeurs des variables</legend>"; 
							foreach ($vars as $v){
							?>
								<div class="form-group">
									<label><?php echo $v; ?></label>
									<input type="text" class="form-control" name='vars[<?php echo $v; ?>]' required>
								</div>
							<?php 
							}
							?>
								</fieldset>
								<div>
									<input type="submit" class="btn btn-success" value="Appliquer">
								</div>
							<?php 
						}
					?>
				</div>
				</form>
				<?php }else{ ?>
			<div class="col-lg-12" style="padding:10px;">
				Aucun fichier de config selectionne.
			</div>
			<?php } ?>
			</div>
		</div>
	</div> 
	
</div>

<?php

if($config){

$extraFooterTags = "<script> var dataSet =". json_encode(DB::equipement()->configTableData($id)).";".

<<<EOF
 
$(document).ready(function() {
    $('#table_conf_equip').DataTable( {
        data: dataSet,
		paging: false,
        columns: [{ 
			title: "<span style='position: relative;left: -3px;'><input type='checkbox' id='selectAll'><label for='selectAll'></label></span>",
			orderable: false
		},{ 
			title: "Adresse IP"
		},{ 
			title: "Nom"
		},{ 
			title: "Description"
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

</script>
EOF;
}
include("../../footer.php");

?>