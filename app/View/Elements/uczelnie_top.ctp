<div style="font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;";>

		<h2>UCZELNIE</h2>

		<?php $universities = $this->requestAction(array(

														 'controller' => 'universities',

														 'action' => 'top')); ?>

		<ul class="list-group">

		<?php foreach ($universities as $university): ?>

			<?php $slug = Inflector::slug($university['University']['nazwa'],'-');?>

				  <li class="list-group-item"><?php echo $this->Html->link($university['University']['nazwa'],

				   array( 'controller' => 'universities',

						  'action' => 'view',

						  'id' => $university['University']['id'],

						  'slug'=>$slug

				   )

				); ?></li>

		<?php endforeach; ?>

		</ul>

          <p><a class="btn btn-default" href="/uczelnie">Zobacz ranking uniwersytetów &raquo;</a></p>

<!-- /.col-lg-4 -->

</div>