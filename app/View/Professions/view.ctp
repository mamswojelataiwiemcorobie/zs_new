<div id="zawod">
	<div class="col-xs-12 col-sm-12 col-md-9">
		<div class="list-group">
			<h1 class="list-group-item-heading"><?php echo h($profession['Profession']['nazwa']); ?></h1>
			<div><?php echo $profession['Profession']['opis']; ?></div>

			<div class="guzik">
				<div class="btn btn-primary btn-lg">
					Średnia płaca w zawodzie: <?php echo $profession['Profession']['placa']; ?>zł
				</div>
			</div>
		</div>
		
		<h2>Jakie kierunki przygotują Cię do tego zawodu? </h2>
		<ul class="icons arrowlist"><?php 	
				foreach ($profession['Course'] as $course) {
					echo '<li>'. $this->Html->link( $course['nazwa'], array( 'controller' => 'courses',
																					'action' => 'view',
																					'id' => $course['ProfessionsCourse']['course_id'],
																					'slug' => $course['nazwa'])) . '</li>';
					} ?>
		</ul>
	</div>
	<div class="reklama_bok .visible-md col-md-3"></div>
</div>