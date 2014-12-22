<div class="kieruneks form">
	<h1>Lista kierunków uniwersytetu</h1>
		<div class="panel-group" id="accordion">
		<?php foreach($kursy as $faculty_id =>$kierunek):?>    
		  <div class="panel panel-default">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $faculty_id;?>">
				  <?php echo $wydzialy[$faculty_id];?> <?php	echo $this->Html->link("Delete", array('action'=>'delete_faculty',  $faculty_id, $university), array('class'=> "pull-right")); ?>
				</a>
			  </h4>
			</div>
			<div id="collapse_<?php echo $faculty_id;?>" class="panel-collapse collapse">
				<div class="">
					<?php echo $this->Form->create('CourseonUniversity', array('action' => 'update')); 
						echo $this->Form->hidden('university_id', array('value' => $university));?>
					<form class="form">
						<div class="table-responsive">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr><th rowspan="2">Nazwa</td><th colspan="2">licencjackie</td><th colspan="2">inżynierskie</td><th colspan="2">magisterskie</td><th rowspan="2"></td></tr>
									<tr><th>sta</td><th>nie</td><th>sta</td><th>nie</td><th>sta</td><th>nie</td></tr>
								</thead>
								<tbody>  
								<?php foreach($kierunek as $course_id => $kkierunek):?>
									<tr>
										<td><?php echo $nazwy_kursow[$course_id];?></td>
										<?php if(isset($kkierunek[1][1])):?><td>
											<?php echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.1.1', array('value' => 1, 'checked'=>'true'));?></td>
											<?php else : ?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.1.1', array('value' => 1));?></td><?php endif;?>
										<?php if(isset($kkierunek[1][2])):?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.1.2', array('value' => 1, 'checked'=>'true'));?></td><?php else : ?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.1.2', array('value' => 1));?></td><?php endif;?>
										<?php if(isset($kkierunek[2][1]) ):?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.2.1', array('value' => 1, 'checked'=>'true'));?></td><?php else : ?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.2.1', array('value' => 1));?></td><?php endif;?>
										<?php if(isset($kkierunek[2][2])):?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.2.2', array('value' => 1, 'checked'=>'true'));?></td><?php else : ?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.2.2', array('value' => 1));?></td><?php endif;?>
										<?php if(isset($kkierunek[3][1])):?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.3.1', array('value' => 1, 'checked'=>'true'));?></td><?php else : ?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.3.1', array('value' => 1));?></td><?php endif;?>
										<?php if(isset($kkierunek[3][2])):?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.3.2', array('value' => 1, 'checked'=>'true'));?></td><?php else : ?><td><?php
											 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.3.2', array('value' => 1));?></td><?php endif;?>
										<td >
										<?php 	//echo $this->Html->link(    "Edit",   array('action'=>'edit', $kkierunek['id']) ); ?> | 
										<?php	echo $this->Html->link(    "Delete", array('action'=>'delete_course', $faculty_id, $course_id, $university)); ?>
										</td>
									</tr>
									<?php endforeach; ?>
									<?php unset($kkierunek); ?>
								</tbody>
							</table>
						</div>
						<?php echo $this->Form->end('Update'); ?>
					</form>
					
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>  
<div class="dodaj_kierunki">              
	<h3>
		<?php	echo $this->Html->link("Dodaj nowe kierunki", array('action'=>'addm', $university)); ?>
	</h3>
	<h3>
		<?php	echo $this->Html->link("Dodaj nowe wydziały", array('controller'=>'faculties', 'action'=>'add_faculties', $university)); ?>
	</h3>
</div>