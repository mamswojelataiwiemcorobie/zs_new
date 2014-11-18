<style type="text/css">
	.dataTables_filter label{
		font: 50px; 
		font-size: 20;
		height: 57px;
		line-height: 31px;
	}
	.dataTables_filter input{
		width:300px;
	}
	.dataTables_length{
		float: right !important;
	}
	.dataTables_filter{
		float: left !important;
	}
	.dataTables_length label select{
		width: 70;
	}
	.dataTables_info{
		display: none;
	}
	th[after='true']:after{
		content: "\25BC";
		float: right !important;
		//display: inline !important;
		white-space:nowrap;
	}
</style>

<!--<h1>Ranking zawodów</h1>-->
<table id="tZawody" class="table table-bordered">
	<thead>
		<tr>
			<th>Nr</th>
			<th after="true">Zawód</th>
			<th after="true">Śr. wynagrodzenie</th>			
		</tr>
	</thead>
	<tbody>
		
	</tbody>
	<?php unset($profession); ?>
</table>