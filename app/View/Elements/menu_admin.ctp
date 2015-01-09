<div class="navbar navbar">
	<div class="navbar-inner">
		<div id="left-column">
		<div class="admin">
	            <?php echo $this->Html->link(__('Admin'), array('controller' => 'users', 'action' => 'dashboard'), array('class' => 'brand')); ?>
		</div>
		Zalogowany użytkownik: admin
		<ul class="nav nav-tabs nav-stacked">
			<li><?php echo $this->html->link('Lista uczelni',  '/admin/universities' , array('class' => 'blue')); ?></li>
			<li><?php echo $this->html->link('Lista kieruków', '/admin/courses'); ?></li>
			<li><?php echo $this->html->link('Lista kategorii kierunków', '/admin/courses_categories'); ?></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				  Lista stron: <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">					
					<li>
						<?php echo $this->html->link('Podstrony info', '/admin/subsites/'); ?>
					</li>
					<li>
						<?php echo $this->html->link('Artykuły', '/admin/articles/'); ?>
					</li>
				</ul>
			</li>
			<li onclick="if($(this).next().css('display') == 'none') {$(this).next().show(1000);}else{$(this).next().hide(1000);}">
				Admin:</li>
				<ul style="display:none">
					<li>
						<?php echo $this->html->link('zmiany haseł, użytkowników', '/users'); ?>
					</li>
				</ul>
			</li>
			<li>
				<?php echo $this->Html->link(__('Visit Site'), '/', array('class' => 'blue')); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('Logout'), array('controller' => 'Users', 'action' => 'logout'), array('class' => 'blue', 'target' => '_blank')); ?>
			</li>
		</ul>
		</div>
	</div>
</div>