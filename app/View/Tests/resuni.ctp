	<?php 
				pr($uni1);
			echo '1';
			pr($uni2);
			echo '1';
			?>

	<div class="info-box-inner">
	<?php 
		echo $this->Form->create('tests', array('action' => 'resuni', 'class' => 'form-inline', 'role' => 'form',
			'controler' => 'xx'
			));
		echo $this->Form->input('University.id', array(
										
										'div' => 'form-group',
										'class' => 'form-control',
											'type' => 'select',
											'options' => $options,
											'selected' => $university['University']['id'],
										'label' => array(
											'class' => 'sr-only',
											'text' => 'Pierwsza szkoła'
										)
										));

		echo $this->Form->input('University.id2', array(
										'div' => 'form-group',
										'class' => 'form-control',
										'style' => '"width: 100px"',
											'type' => 'select',
											'options' => $options,
											'selected' => $university2['University']['id'],
											'empty' => '(wybierz szkołe)',
										'label' => array(
											'class' => 'sr-only',
											'text' => 'Druga szkoła'
										)
										));
		?>
		<div class="p-b-center">
			<?php 
			echo $this->Form->button('<i class="icon-th"></i>&nbsp;Porównaj', array('type' => 'submit', 'class' => 'btn btn-default'));
			echo $this->Form->end();


			pr($this->data);
			echo '1';

			pr($university);
			echo '1';
			pr($university2);
			?>


		</div>