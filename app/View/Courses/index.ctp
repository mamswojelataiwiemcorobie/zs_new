<style>
	#d{
		visibility:hidden;
	}
	/*
	@-moz-document url-prefix() {
		select {
			-moz-appearance: none;
			text-indent: 0.01px;
			text-overflow: '';
		}
	}
	*/
	.yadcf-filter-reset-button{
		width: 28px !important;
		height:28px !important;
	}
	.yadcf-filter-wrapper{
		display: block !important;
	}
	.dataTables_filter label{
	font: 50px; 
	font-size: 20;
	height: 57px;
	line-height: 31px;
	}
	.dataTables_filter input{
		width:300px;
	}
	.yadcf-filter-reset-button{
		height: 32px !important;
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


<table id="tKierunki" class="table table-bordered">
	<thead>
		<tr>
			<th>Nr</th>
			<th after="true">Kierunek</th>
			<th>Typ</th>
			<th after="true">Zawód</th>
			<?php //<th after="true">Śr wynagrodzenie</th> ?>
			<?php //echo'<th>Ocena / Śr. w naszym rankingu</th>'; ?>
			
		</tr>
	</thead>
	<tbody>
		
	</tbody>
	<?php unset($course); ?>
</table>