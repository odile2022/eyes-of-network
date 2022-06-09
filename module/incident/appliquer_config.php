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
				<form id="appliquer_config_form" method="post" action="controlleur.php?action=appliquer_config">
					<div class="dataTable_wrapper">
						<fieldset class='form-fieldset' style='margin:1em 0'>
							<legend>Liste des equipements a considerer</legend>
							<table id="table_conf_equip" class="table table-striped datatable-eonweb-ajax table-condensed table-hover"></table>
							<input type='hidden' name='id_fichier_config' value='<?php echo $id; ?>'>
							<input id="id_equipements" type='hidden' name='id_equipements'>
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
						}
					?>
						</fieldset>
						<div>
							<input id="appliquer-conf-submit-btn" type="submit" class="btn btn-success" value="Appliquer">
							<button id="appliquer-conf-loading-btn" class="btn btn-success" style="padding: 0 12px 6px;visibility: hidden;">
								<div class="lds-spinner" style="position: relative;top: 5px;">
									<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
								</div>
								<span style="display: inline-block;">
									En cours d'execution
								</span>
							</button>
						</div>
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

$extraFooterTags = "<script> var dataSet =". json_encode(DB::equipement()->configTableData($config['type_equipement'])).";".

<<<EOF
$( "#appliquer-conf-submit-btn" ).click(function() {
	$( this).css("display", "none");
	$( "#appliquer-conf-loading-btn" ).css("visibility", "visible");
	
});

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

	$('#appliquer_config_form').submit(function(event){
		const ids = [];
		$('.row_data_input').each((key, val) => {
			const checked = $(val).children('input:checked').val();
			if(checked){
				const id = JSON.parse($(val).children('input[type=hidden]').val());
				ids.push(id);
			}
		});
		console.log(ids);
		if (ids.length) {
			$('#id_equipements').val(JSON.stringify(ids));
		}else{
			alert("Error: Aucune valeur selectionée.");
			event.preventDefault();
		}
	 });

} );

</script>
EOF;
}
include("../../footer.php");

?>