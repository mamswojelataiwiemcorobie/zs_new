<div id="erasmus">
	<?php
	if (!isset($this->request->data['Exchange'])){
		echo $this->Form->create();
		echo $this->Form->input('university_id');
		echo $this->Form->input('program', array('value' => 'Erasmus'));
		echo $this->Form->input('kraj');
		echo $this->Form->input('miasto');
		echo $this->Form->input('nazwa_uczelni');
		echo $this->Form->input('nazwa_kierunku');
		echo $this->Form->input('URL');
		echo $this->Form->input('pakiet');
		echo $this->Form->input('waga_pakietu');
		echo $this->Form->submit('dodaj', array('div'=>true));	

		echo $this->Form->end(); 
	}
	?>
	<div class="clearfix"></div>
</div>