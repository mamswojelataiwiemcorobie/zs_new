<div style="font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;";>

          <h2>KIERUNKI</h2>

			<?php $courses = $this->requestAction(array(

															 'controller' => 'courses',

															 'action' => 'top')); ?>

			<ul class="list-group">

			<?php foreach ($courses as $course): ?>

					<?php $slug = Inflector::slug($course['Course']['nazwa'],'-');?>

				  <li class="list-group-item"><?php echo $this->Html->link($course['Course']['nazwa'],

   array(

      'controller' => 'courses',

      'action' => 'view',

      'id' => $course['Course']['id'],

      'slug'=>$slug

   )

); ?></li>

			<?php endforeach; ?>

			</ul>

          <p><a class="btn btn-default" href="/kierunki">Zobacz ranking &raquo;</a></p>

</div><!-- /.col-lg-4 -->