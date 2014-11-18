<div class="row">

	<div class="col-md-6">

		<h1><?php echo h($university['University']['nazwa']); ?></h1>

		<p><?php echo $university['City']['nazwa']; ?></p>

		<p>Typ: <?php echo $university['UniversityType']['nazwa']; ?></p>

		<p>Miejsce w rankingu Perspektywy: <?php echo h($university['University']['ranking']); ?></p>

		<p>Średnia w naszym rankingu: <?php echo $university['University']['srednia']; ?></p>

		<?php $slug = Inflector::slug($university['University']['nazwa'],'-');?>

		<p>Zobacz więcej informacji na temat tej uczelni w naszym serwisie <strong>www.zostanstudentem.pl</strong> => <?php echo $this->Html->link( $university['University']['nazwa'], 'http://www.zostanstudentem.pl/uczelnia/'.$slug.'-'.$university['University']['id'] );?></p>

		<?php if (!empty($u)):?><h2>Kierunki na tej uczelni:</h2>

		<ul>

			<?php 

			foreach ($u as $university) {

					$slug = Inflector::slug($university['Course']['nazwa'],'-');

					echo '<li>'. $this->Html->link( $university['Course']['nazwa'], 'http://www.zostanstudentem.pl/uczelnia/'.$slug.'-'.$university['Course']['id'].'.html' ) .'</li>';

			}?>

		</ul>

		<?php endif ?>

	</div>

	<div class="col-md-6">

		<h1><?php echo h($university2['University']['nazwa']); ?></h1>

		<p><?php echo $university2['City']['nazwa']; ?></p>

		<p>Typ: <?php echo $university2['UniversityType']['nazwa']; ?></p>

		<p>Miejsce w rankingu Perspektywy: <?php echo h($university2['University']['ranking']); ?></p>

		<p>Średnia w naszym rankingu: <?php echo $university2['University']['srednia']; ?></p>

		<?php $slug = Inflector::slug($university2['University']['nazwa'],'-');?>

		<p>Zobacz więcej informacji na temat tej uczelni w naszym serwisie <strong>www.zostanstudentem.pl</strong> => <?php echo $this->Html->link( $university2['University']['nazwa'], 'http://www.zostanstudentem.pl/uczelnia/'.$slug.'-'.$university2['University']['id'] );?></p>

		<?php if (!empty($u)):?><h2>Polecane kierunki na tej uczelni:</h2>

		<ul>

			<?php 
			foreach ($u2 as $university) {

					$slug = Inflector::slug($university['Course']['nazwa'],'-');

					echo '<li>'. $this->Html->link( $university['Course']['nazwa'], 'http://www.zostanstudentem.pl/uczelnia/'.$slug.'-'.$university['Course']['id'].'.html' ) .'</li>';

			}?>

		</ul>

		<?php endif ?>

	</div>

</div>