<table>

<?php
	foreach ($placa_prof as $key => $value) {
		echo '<tr>';

		echo '<td> ';
		echo $value;
		echo ' </td>';

		echo '<td> ';
		echo $key ;
		echo ' </td>';

		
		foreach ($placa_Course as $key2 => $value2) {
			if ($value == $value2){
				echo '<td> ';
				echo $key2 ;
				echo ' </td>';
			}
		}
		echo '</tr>';
	}

?>
</table>