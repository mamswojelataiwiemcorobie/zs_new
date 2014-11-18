<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<style>

	.odd, .even{

		height: 135px !important;

	}

	td{

		text-align:center !important; 

	    vertical-align:middle !important;

	}

	th{

		padding: 3px 18px 3px 10px !important;

	}

	tr.even:hover{

		background: rgba(0, 0, 0, 0)  !important; 

	}

	tr.odd:hover{

		background: rgba(0, 0, 0, 0)  !important; 

	}

	th:nth-child(2){

		border-right-style: none !important;

	}

	th:nth-child(3){

		border-left-style: none !important;

	}

	td:nth-child(2){

		border-right-style: none !important;

		background-color: #fff !important;

	}

	td:nth-child(3){

		border-left-style: none !important;

		text-align: left !important; 

		background-color: #fff !important;

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

	.dataTables_length{

		float: right !important;

	}

	.dataTables_filter{

		float: left !important;

	}

	.dataTables_length label select{

		width: 70;

	}

	tbody tr td{

		background-color: #fff !important;

	}


	td[class=' sorting_1']{

		background-color: #f54828 !important;

	}

	td .sorting_1{

		background-color: #f54828 !important;

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

	th[after='inline']:after{

		content: "   \25BC";

		//float: right !important;

		white-space: nowrap;

	}

	th[after='inline']{

		white-space: nowrap;

	}

</style>

<section class="intro-note topspace10">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Znajdź i porównaj <span class="colortext">uczelnię</span> wpisując dowolne kryteria.</h1>
          <p>MIASTO, KIERUNEK STUDIÓW, NAZWĘ SZKOŁY WYŻSZEJ LUB JEJ KOMNINACJE </p>
        </div>
      </div>
    </div>
   </section>
    <!-- /.intro-note end-->


<div class="span12">

	<table id="tUni" class="table table-bordered table-striped dataTable has-columns-hidden">

		<thead>

			<tr>

				<th>Nr</th>

				<th></th>

				<th after="true" data-class="expand">Nazwa</th>
				<th after="" >Publiczna</th>

				<th after="true"  data-hide="phone">Miasto</th>

				<th after="true"  data-hide="phone,tablet">Typ szkoły</th>

				<?php

				/*

				<th data-hide="phone,tablet">id</th>

				<th data-hide="phone,tablet">rĹ›</th>

				<th data-hide="phone,tablet">ok3</th>

				<th data-hide="phone,tablet">NR4</th>

				<th data-hide="phone,tablet">ST</th>



				<!-- <th>Ocena / Ĺšr. w naszym rankingu</th> -->

				*/

				?>

			</tr>

		</thead>

		 <tbody>

		 

		</tbody>

	<?php unset($university); ?>

	</table>

</div>