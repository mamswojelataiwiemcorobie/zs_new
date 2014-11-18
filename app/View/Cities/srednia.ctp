<h1>Średnia ważona dla poszczególnych miast</h1>
<?php foreach ($cities as $city): ?>
<p><?php echo $city['City']['nazwa'] .' | '. $city['City']['srednia'] ; ?></p>
<?php endforeach; ?>
<?php unset($city); ?>