<div style="font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;";>

	<h2>MIASTA</h2>

	<?php $cities = $this->requestAction(array(

													 'controller' => 'cities',

													 'action' => 'top')); ?>

	<ul class="list-group">

	<?php foreach ($cities as $city): ?>

		  <?php $slug = Inflector::slug($city['City']['nazwa'],'-');?>

				  <li class="list-group-item"><?php echo $this->Html->link($city['City']['nazwa'],

					   array( 'controller' => 'cities',

							  'action' => 'view',

							  'id' => $city['City']['id'],

							  'slug'=>$slug

					   )

			); ?></li>

	<?php endforeach; ?>

	</ul>

	<p><a class="btn btn-default" href="/miasta">Zobacz ranking &raquo;</a></p>

</div><!-- /.col-lg-4 -->