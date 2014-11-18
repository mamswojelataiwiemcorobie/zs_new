<style>

	.odd, .even{

		height: 80px !important;

	}

	td{

		text-align:center !important; 

	    vertical-align:middle !important;

	}

	th:nth-child(2){

		border-right-style: none !important;

	}

	th:nth-child(3){

		border-left-style: none !important;

	}

	td:nth-child(2){

		border-right-style: none !important;

	}

	td:nth-child(3){

		border-left-style: none !important;

		text-align: left !important; 

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





<?php 

//$this->Cookie->write('name', 'Larry', true, '2 weeks');

//echo $this->Form->input('remember_me', array('label' => 'Zapamiętaj mnie', 'type' => 'checkbox'));

//echo $cookie;

?>





<section class="intro-note topspace10">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Porównaj polskie <span class="colortext">miasta </span>akademickie.</h1>
          <p>Ceny życia, ilość studentów, stopa bezrobocia i szkoły wyższe.</p>
        </div>
      </div>
    </div>
   </section>
    <!-- /.intro-note end-->



<table id="cities" class="table table-bordered" >

	<thead>

		<tr>

			<th>Nr</th>	

			<th></th>	

			<th after="true">Miasto</th>

			<th after="true">Cena za miejsce w pokoju</th>

			<th after="true">Cena za pokój 1os</th>

			<th after="true">bilet 20-min</th>

			<th after="true">bilet miesięczny</th>

			<th after="true">Cena za obiad</th>

			<th after="true">Wsk. bezrobocia [%]</th>

			<th after="true">Liczba studentów</th>

			<th after="true">Śr. wynagrodzenie</th>



			<?php 

			//echo'<th>Ocena / Śr. w naszym rankingu</th>';

			?>

		</tr>

	</thead>

	 <tbody>

	 

	</tbody>

</table>



