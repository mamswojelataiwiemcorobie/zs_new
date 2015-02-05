<div>
	<h1>Twoje dane:</h1>
	<p>Login: <?php echo $user['Client']['login'];?></p>
	<p>Hasło: <?php echo $user['Client']['password'];?></p>
	<p>Imie: <?php echo $user['ClientUsersData']['name'];?></p>
	<p>Nazwisko: <?php echo $user['ClientUsersData']['surname'];?></p>
	<p>Miasto: <?php echo $user['ClientUsersData']['city'];?></p>
	<p>Województwo: <?php echo $user['ClientUsersData']['city'];?></p>
	<p>Kod pocztowy: <?php echo $user['ClientUsersData']['postcode'];?></p>
	<p><a href="/clients/edit">Edytuj dane</a></p>
</div>