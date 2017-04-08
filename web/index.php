<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
require_once(__DIR__."/../vendor/autoload.php");
use \GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://localhost:8888',
    'timeout'  => 2.0,
]);
?>

<form action="index.php" method="POST" id="search">
	<p>
		Formulaire de recherche Bing/Dailymotion/deezer. La recherche tout en 1 !
	</p>
	<p>
		<label class="label_search">Rechercher</label>
		<input name="search" class="input_search" type="text" <?php if (isset($_POST['search'])) { echo 'value="' . $_POST['search'] . '"'; } ?>>
	</p>
	<p><input value="Valider" type="submit"></p>
</form>

<?php 

if (isset($_POST['search']) && !empty($_POST['search'])) {
	// BlOC BING
	$res = $client->get('ECV_API/bing/'.$_POST['search']);
	$result = json_decode($res->getBody()->__toString());
	$pages = $result->webPages->value;
	?>
	<div class="deezer">
		<h2>Recherche Bing <?php echo "(".count($pages).")"; ?></h2>
		<table>
			<thead>	
				<tr>
				    <th>Nom</th>
				    <th>Lien</th> 
				    <th>Snippet</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if(count($pages) == 0){
						echo "<tr><td colspan=3>Aucun résultat</td></tr>";
					}
					foreach($pages as $page){
					?>
						<tr>
							<td><?php echo $page->name; ?></td>
							<td><a href="<?php echo $page->displayUrl; ?>">Accéder</a></td>
							<td><?php echo $page->snippet; ?></td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<?php
	// BLOC DAILYMOTION
	$res = $client->get('ECV_API/daily/'.$_POST['search']);
	$result = json_decode($res->getBody()->__toString());
	?>
	<div class="daily">
		<h2>Vidéos dailymotion <?php echo "(".count($result->list).")"; ?></h2>
		<?php 
			$videos = $result->list;
			foreach($videos as $video){
				$res = $client->get('ECV_API/daily/user/'.$video->owner);
				$user = json_decode($res->getBody()->__toString());	
				?>
				<div class="bloc_video">
					<h3><?php echo $video->title; ?></h3>
					<?php 
						echo "<iframe frameborder='0' width='480' height='270' src='//www.dailymotion.com/embed/video/".$video->id."' allowfullscreen></iframe>";
					?>
					
					<p>Posté par <?php echo $user->screenname; ?></p>
				</div>
				<?php
			}
		?>
	</div>
	<?php 
	// BLOC DEEZER
	$res = $client->get('ECV_API/deezer/'.$_POST['search']);
	$result = json_decode($res->getBody()->__toString());
	$musics = $result->data;
	?>
	<div class="deezer">
		<h2>Musique Deezer <?php echo "(".count($musics).")"; ?></h2>
		<table>
			<thead>	
				<tr>
				    <th>Titre</th>
				    <th>Lien</th> 
				    <th>Artiste</th>
				</tr>
			</thead>
			<tbody>

				<?php 
					if(count($musics) == 0){
						echo "<tr><td colspan=3>Aucun résultat</td></tr>";
					}
					foreach($musics as $music){
					?>
						<tr>
							<td><?php echo $music->title; ?></td>
							<td><a href="<?php echo $music->link; ?>">Ecouter</a></td>
							<td><?php echo $music->artist->name; ?></td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<?php
}
?>
</body>
</html>
