<?php

require_once("./EquipementDB.php");
include("../../header.php");
include("../../side.php");
include("ged_functions.php");


?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Equipements</h1>
			Here >> <?php 
			echo json_encode(EquipementDB::request()->all());//*/ 
			echo "<br/><br/>";
			echo json_encode(EquipementDB::request()->find(2));
			?>
		</div>
	</div> 
</div>

<?php include("../../footer.php"); ?>
