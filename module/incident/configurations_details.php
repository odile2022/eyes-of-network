<?php
require_once("./incident_header.php");
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Configuration</h1>
		</div>
		<div class="col-lg-12">
			<h1>Details config</h1>
			<div class="row">
			<?php 
			$id = $_GET['id'];
			$config = DB::configuration()->find($id);
			if($config){ ?>
			<div class="col-lg-12" style="padding:10px;">
				<h2>Config: <?php echo $config['nom_config']; ?></h2>
				<h3>Date: <b><?php echo $config['date']; ?></b> </h3>
				<h3>Appliquée: <?php 
				if ($config['commande_reussie']==2)
					echo 'En cours d\'execution'; 
				else if ($config['commande_reussie']==1)
					echo 'Oui'; 
				else 
					echo 'Non'; ?></h3>
				
				<fieldset class='form-fieldset' style='margin:1em 0'>
					<legend>Liste des equipements concernes</legend>
					<table id="table_conf_equip" class="table table-striped datatable-eonweb-ajax table-condensed table-hover"></table>
				</fieldset>

				<h3>Log d'exécution:</h3>
				<p>Log d'exécution: <?php echo $config['log_execution']; ?></p>
				<h3>Information: </h3>
				<p>Information: <?php echo $config['info']; ?></p>

				<?php }else{ ?>
			<div class="col-lg-12" style="padding:10px;">
				Aucune configuration selectionnée.
			</div>
			<?php } ?>
			</div>
		</div>
	</div> 
	
</div>

<?php

if($config){

$extraFooterTags = "<script> var dataSet =". json_encode(DB::equipement()->configDetailTableData($config['id'])).";".

<<<EOF
 
$(document).ready(function() {
    $('#table_conf_equip').DataTable( {
        data: dataSet,
		paging: false,
        columns: [{ 
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