<style type="text/css">
	img{
		width:100%; 
		max-width: 500px;
	}
	h1{
		width: 60%;
	}
	.box effect6{
		width: 70%;
	}
	@media screen and (max-width:600px) {
	    h1{
			width: 100%;
			font-size:20px;
		}
		.box{
			width: 90%;
		}
	}
</style>

<img class="logo" src="/img/uczelnie/<?php if (!empty($courseonuniversity['University']['photo'])) { echo $courseonuniversity['University']['photo']; } else echo 'no-photo.jpg';?>">
<?php
	//print_r($courseonuniversity)
?>
<h1><?php echo h($courseonuniversity['University']['nazwa']); ?></h1>

<div class="box effect6">
	<h2><?php echo h($courseonuniversity['Course']['nazwa']); ?></h2>

	<p>Rodzaj studiów: 
		<?php 
		echo $courseonuniversity['TypCourse']['nazwa'] .' ,'. $courseonuniversity['TrybCourse']['nazwa']; ?></p>
	<p>Cena za studia na tej uczelni: 
		<?php 
		echo h($courseonuniversity['CourseonUniversity']['cena']) .' zł'; ?></p>
	<p>Więcej na temat uczelni: 
		<?php 
		$slug = Inflector::slug($courseonuniversity['University']['nazwa'],'-');
		echo $this->Html->link( $courseonuniversity['University']['nazwa'], 'http://www.zostanstudentem.pl/uczelnia/'.$slug.'-'.$courseonuniversity['University']['id'].'.html' );?></p>
</div>
