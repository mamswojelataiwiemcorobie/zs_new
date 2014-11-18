<div id="zawod">
	<h1>Dodaj zawód po kierunku <?php //echo ;?></h1>
	<?php
	if (!isset($this->request->data['ProfessionsCourse'])){
		echo $this->Form->create();
		echo $this->Form->select(
			'profession_id',
			$courses,
			array('size'=>12, 'multiple' => true)
		);
		echo $this->Form->submit('dodaj', array('div'=>true));	

		echo $this->Form->end(); 
	}
	?>
	<div class="clearfix"></div>
</div>