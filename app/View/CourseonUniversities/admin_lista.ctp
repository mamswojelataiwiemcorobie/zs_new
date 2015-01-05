<div class="kieruneks form">
	<?php if (!empty($kursy)) :?>
		<h1>Lista kierunków <?php if ($university['University']['university_type_id'] == 1):?>uniwersytetu <?php else:?>szkoły <?php endif;?><?php echo $university['University']['nazwa']; ?></h1>
		<div class="panel-group" id="accordion">
		<?php foreach($kursy as $faculty_id =>$kierunek):?>    
		  <?php if (!empty($wydzialy)):?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $faculty_id;?>">
						  <?php echo $wydzialy[$faculty_id];?> 
						  <?php echo $this->Html->link("Delete", array('action'=>'delete_faculty',  $faculty_id, $university['University']['id']), array('class'=> "pull-right")); ?>
						</a>
					</h4>
				</div>
				<div id="collapse_<?php echo $faculty_id;?>" class="panel-collapse collapse">
				<?php endif; ?>
					<div class="">
						<?php if ($university['University']['university_type_id'] == 3):?>
							<table class="table table-striped table-hover table-bordered">	
								<thead>
									<tr><th rowspan="2">Nazwa</td><th rowspan="2"></td></tr>
								</thead>
								<tbody>  
								<?php foreach($kierunek as $course_id => $kkierunek):?>
									<tr>
										<td><?php echo $nazwy_kursow[$course_id];?></td>
										<td><?php	echo $this->Html->link( "Delete", array('action'=>'delete_course', $course_id, $university['University']['id'], $faculty_id)); ?></td>
									</tr>
									<?php endforeach; ?>
									<?php unset($kkierunek); ?>
								</tbody>
							</table>
						<?php else: ?>
							<?php echo $this->Form->create('CourseonUniversity', array('action' => 'update')); 
								echo $this->Form->hidden('university_id', array('value' => $university['University']['id']));?>
							<form class="form">
								<div class="table-responsive">
									<table class="table table-striped table-hover table-bordered">										
										<thead>
											<tr>
												<th rowspan="3">Nazwa</td>
												<?php if ($university['University']['university_type_id'] == 1):?><th colspan="10">Studia</td><?php else:?><th colspan="4">Szkoła</td><?php endif;?>
												<th rowspan="3"></th>
											</tr>
											<tr>
												<?php if ($university['University']['university_type_id'] == 1):?>
													<th colspan="2">licencjackie</td><th colspan="2">inżynierskie</td><th colspan="2">magisterskie</td><th colspan="2">pod</td><th colspan="2">j.mag</td>
												<?php else:?>
													<th colspan="2">1let</td><th colspan="2">2let</td>
												<?php endif;?>
											</tr>
											<tr>
												<?php if ($university['University']['university_type_id'] == 1):?>
													<th>sta</td><th>nie</td><th>sta</td><th>nie</td><th>sta</td><th>nie</td><th>sta</td><th>nie</td><th>sta</td><th>nie</td>
												<?php else:?>
													<th>sta</td><th>nie</td><th>sta</td><th>nie</td>
												<?php endif;?>
											</tr>
										</thead>
										<tbody>  
										<?php foreach($kierunek as $course_id => $kkierunek):?>
											<tr>
												<td><?php echo $nazwy_kursow[$course_id];?></td>
												<?php if ($university['University']['university_type_id'] == 1):?>
													<?php if(isset($kkierunek[1][1])):?>
														<td><?php echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.1.1', array('value' => 1, 'checked'=>'true', 'class' => 'cc1'));?></td>
													<?php else : ?>
														<td><?php echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.1.1', array('value' => 1,'class' => 'cc1'));?></td><?php endif;?>
													<?php if(isset($kkierunek[1][2])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.1.2', array('value' => 1, 'checked'=>'true', 'class' => 'cc2'));?></td>
													<?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.1.2', array('value' => 1, 'class' => 'cc2'));?></td><?php endif;?>
													<?php if(isset($kkierunek[2][1]) ):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.2.1', array('value' => 1, 'checked'=>'true', 'class' => 'cc3'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.2.1', array('value' => 1, 'class' => 'cc3'));?></td><?php endif;?>
													<?php if(isset($kkierunek[2][2])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.2.2', array('value' => 1, 'checked'=>'true', 'class' => 'cc4'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.2.2', array('value' => 1, 'class' => 'cc4'));?></td><?php endif;?>
													<?php if(isset($kkierunek[3][1])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.3.1', array('value' => 1, 'checked'=>'true', 'class' => 'cc5'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.3.1', array('value' => 1, 'class' => 'cc5'));?></td><?php endif;?>
													<?php if(isset($kkierunek[3][2])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.3.2', array('value' => 1, 'checked'=>'true', 'class' => 'cc6'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.3.2', array('value' => 1, 'class' => 'cc6'));?></td><?php endif;?>
													<?php if(isset($kkierunek[4][1])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.4.1', array('value' => 1, 'checked'=>'true', 'class' => 'cc7'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.4.1', array('value' => 1, 'class' => 'cc7'));?></td><?php endif;?>
													<?php if(isset($kkierunek[4][2])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.4.2', array('value' => 1, 'checked'=>'true', 'class' => 'cc8'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.4.2', array('value' => 1, 'class' => 'cc8'));?></td><?php endif;?>
													<?php if(isset($kkierunek[7][1])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.7.1', array('value' => 1, 'checked'=>'true', 'class' => 'cc9'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.7.1', array('value' => 1, 'class' => 'cc9'));?></td><?php endif;?>
													<?php if(isset($kkierunek[7][2])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.7.2', array('value' => 1, 'checked'=>'true', 'class' => 'cc10'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.7.2', array('value' => 1, 'class' => 'cc10'));?></td><?php endif;?>
												<?php else:?>
													<?php if(isset($kkierunek[5][1])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.5.1', array('value' => 1, 'checked'=>'true', 'class' => 'cc111'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.5.1', array('value' => 1, 'class' => 'cc11'));?></td><?php endif;?>
													<?php if(isset($kkierunek[5][2])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.5.2', array('value' => 1, 'checked'=>'true', 'class' => 'cc12'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.5.2', array('value' => 1, 'class' => 'cc12'));?></td><?php endif;?>
													<?php if(isset($kkierunek[6][1])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.6.1', array('value' => 1, 'checked'=>'true', 'class' => 'cc13'));?></td><?php else : ?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.6.1', array('value' => 1, 'class' => 'cc13'));?></td><?php endif;?>
													<?php if(isset($kkierunek[6][2])):?><td><?php
														 echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.6.2', array('value' => 1, 'checked'=>'true', 'class' => 'cc14'));?></td>
													<?php else : ?>
														<td><?php echo $this->Form->checkbox('Faculties.'.$faculty_id.'.'.$course_id.'.6.2', array('value' => 1, 'class' => 'cc14'));?></td><?php endif;?>
												<?php endif;?>
												<td >
												<?php 	//echo $this->Html->link(    "Edit",   array('action'=>'edit', $kkierunek['id']) ); ?> | 
												<?php	echo $this->Html->link(    "Delete", array('action'=>'delete_course', $course_id, $university['University']['id'], $faculty_id)); ?>
												</td>
											</tr>
											<?php endforeach; ?>
											<tr class="check">
												<td> Check all</td>
												<?php if ($university['University']['university_type_id'] == 1):?>
													<td><input type="checkbox" onclick="toggleCheckedlic(this.checked)"/></td><td><input type="checkbox" onclick="toggleCheckedmgr(this.checked)"/></td><td><input type="checkbox" onclick=\"toggleChecked3(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked4(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked5(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked6(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked7(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked8(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked9(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked10(this.checked)"/></td>
												<?php else:?>
													<td><input type="checkbox" onclick="toggleChecked11(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked12(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked13(this.checked)"/></td><td><input type="checkbox" onclick="toggleChecked14(this.checked)"/></td>
												<?php endif; ?>
											</tr>
											<?php unset($kkierunek); ?>
										</tbody>
									</table>
								</div>
								<?php echo $this->Form->end('Update'); ?>
							</form>	
						<?php endif; ?>				
					</div>
					 <?php if (!empty($wydzialy)):?>
				</div>
			</div>
		<?php endif;?>
		<?php endforeach; ?>
		</div>
	<?php else :?>
		<h2>Ta uczelnia nie ma jeszcze dodanych kierunków, czy chcesz je dodać?</h2>
	<?php endif;?>
</div>  
<div class="dodaj_kierunki">              
	<h3>
		<?php	echo $this->Html->link("Dodaj nowe kierunki", array('action'=>'addm',$university['University']['id'])); ?>
	</h3>
	<?php if ($university['University']['university_type_id'] != 3):?>
	<h3>
		<?php	echo $this->Html->link("Dodaj nowe wydziały", array('controller'=>'faculties', 'action'=>'add_faculties', $university['University']['id'])); ?>
	</h3>
	<?php endif;?>
</div>