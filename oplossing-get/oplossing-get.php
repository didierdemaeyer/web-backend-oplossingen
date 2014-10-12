<?php 
	//Uitbreiding 2 nog bekijken!!!!


	$artikels = array(
		array(	"titel" => "Animating Without jQuery",
						"datum" => "September 4th, 2014",
						"inhoud" => "There’s a false belief in the web development community that CSS animation is the only performant way to animate on the web. This myth has coerced many developers to abandon JavaScript-based animation altogether, thereby (1) forcing themselves to manage complex UI interaction within style sheets, (2) locking themselves out of supporting Internet Explorer 8 and 9, and (3) forgoing the beautiful motion design physics that are possible only with JavaScript.",
						"afbeelding" => "img/john-houbolt.jpg",
						"afbeeldingBeschrijving" => "John Houbolt"
			),

		array(	"titel" => "Tips For Mastering A Programming Language Using Spaced Repetition",
						"datum" => "August 19th, 2014",
						"inhoud" => "Since first hearing of spaced repetition a few years back, I’ve used it for a wide range of things, from learning people’s names to memorizing poetry to increasing my retention of books. Today, I’ll share best practices that I’ve discovered from using spaced repetition to learn and master a programming language.",
						"afbeelding" => "img/programming-language.jpg",
						"afbeeldingBeschrijving" => "example programming language"
			),

		array(	"titel" => "Don’t Be Scared Of Functional Programming",
						"datum" => "July 2nd, 2014",
						"inhoud" => "Functional programming is the mustachioed hipster of programming paradigms. Originally relegated to the annals of computer science academia, functional programming has had a recent renaissance that is due largely to its utility in distributed systems (and probably also because “pure” functional languages like Haskell are difficult to grasp, which gives them a certain cache).",
						"afbeelding" => "img/functional-programming.png",
						"afbeeldingBeschrijving" => "example functional programming"
			));

	$individueelArtikel		=	false;
	$nietBestaandArtikel	=	false;

	// Controleren of de get-variabele ID geset is om een individueel artikel op te halen
	if ( isset ( $_GET['id'] ) )
	{
		$id = $_GET['id'];

		// Controleren of de opgevraagde key (=id) bestaat in de array $artikels
		if ( array_key_exists( $id , $artikels ) )
		{
			$artikels 			= 	array( $artikels[$id] );
			$individueelArtikel	=	true;
		}
		else
		{
			$nietBestaandArtikel	=	true;
		}		
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php if (!$individueelArtikel): ?>
		<title>Oplossing get</title>
	<?php elseif ($nietBestaandArtikel):  ?>
		<title>Oplossing get: Artikel met id <?php echo $id ?> Bestaat niet ?></title>
	<?php else: ?>
		<title>Oplossing get: <?php echo $artikels[0]["titel"]  ?></title>
	<?php endif ?>
	<style>

		body {
			font-family: sans-serif;
		}

		article h2 {
			border-bottom: 1px solid grey;
		}

		.multiple {
			float: left;
			width: 300px;
			margin-left: 30px;
			padding: 10px;

			background-color: lightgray;
		}
		
		img {
			width: 100%;
		}

		.single {
			width: 600px
		}
		
	</style>
</head>
<body>
	<?php if (!$nietBestaandArtikel): ?>
		<div class="container">
			<?php foreach ($artikels as $id => $artikel): ?>
				<?php if ($individueelArtikel): ?>
					<a href="oplossing-get.php">Terug naar overzicht</a>
				<?php endif ?>
				<article class="<?php echo (!$individueelArtikel) ? 'multiple' : 'single' ?>">
					<h2><?php echo $artikel["titel"] ?></h1>
					<p><?php echo $artikel["datum"] ?></p>
					<img src="<?php echo $artikel['afbeelding'] ?>" alt="<?php echo $artikel['afbeeldingBeschrijving'] ?>">
					<p><?php echo (!$individueelArtikel) ? (substr($artikel["inhoud"], 0, 50) . "...") : $artikel["inhoud"] ?></p>
					<?php if (!$individueelArtikel): ?>
						<a href="oplossing-get.php?id=<?php echo $id ?>">Lees meer</a>
					<?php endif ?>
				</article>
			<?php endforeach ?>
		</div>
	<?php else: ?>
		<p>Het artikel met id <?php echo $id ?> bestaat niet. Probeer een ander artikel.</p>
		<a href="oplossing-get.php">Terug</a>
	<?php endif ?>
	

</body>
</html>
