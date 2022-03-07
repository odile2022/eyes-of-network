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


require_once("./DB.php");
include("../../header.php");
include("../../side.php");
include("ged_functions.php");


?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Groupes d'equipements</h1>
		</div>
		<div class="dataTable_wrapper">
			<table id="table_grp_equip" class="table table-striped datatable-eonweb-ajax table-condensed table-hover">
			</table>
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
        columns: [
            { title: "<span class='custom-checkbox'><input type='checkbox' id='selectAll'><label for='selectAll'></label></span>" },
            { title: "Nom" },
            { title: "Chemin du fichier" }
        ]
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
		}
	});
} );
</script>
EOF;


?>
<?php include("../../footer.php"); ?>