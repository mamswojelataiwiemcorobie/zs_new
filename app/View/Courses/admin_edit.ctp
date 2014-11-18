<div id="kieruenk">
	<h1>Edytuj kierunek</h1>
	<?php
	if (!isset($this->request->data['Exchange'])){
		echo $this->Form->create();
		echo $this->Form->input('nazwa');
		echo $this->Form->input('courses_type_id');
		echo $this->Form->input('placa');
		echo $this->Form->input('opis');
		echo $this->Form->input('srednia');
		echo $this->Form->input('rank');
		echo $this->Form->submit('dodaj', array('div'=>true));	

		echo $this->Form->end(); 
	}
	?>
	<div class="clearfix"></div>
</div>