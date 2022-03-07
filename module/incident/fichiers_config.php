<?php

require_once("./DB.php");
include("../../header.php");
include("../../side.php");
include("ged_functions.php");


?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Fichier de configuration</h1>
			Here >> <?php 
			echo json_encode(DB::fichierConfig()->all());//*/ 
			echo "<br/><br/>";
			echo json_encode(DB::fichierConfig()->find(2));
			?>
		</div>
	</div> 
</div>

<?php include("../../footer.php"); ?>
