<?php 
	session_start();

	if (isset($_POST['addTodo'])) {
		if ($_POST['addTodo'] != "") {
			$_SESSION['todo'][] = $_POST['description'];

			unset($_POST['addTodo']);
		}
	}


	/* TODO <=> DONE */

	if (isset($_POST['toggleTodo'])) {
		$_SESSION['done'][] = $_SESSION['todo'][$_POST['toggleTodo']];
		unset($_SESSION['todo'][$_POST['toggleTodo']]);
	}

	if (isset($_POST['toggleDone'])) {
		$_SESSION['todo'][] = $_SESSION['done'][$_POST['toggleDone']];
		unset($_SESSION['done'][$_POST['toggleDone']]);
	}


	/* DELETE */

	if (isset($_POST['deleteTodo'])) {
		unset( $_SESSION['todo'][$_POST['deleteTodo']] );
	}

	if (isset($_POST['deleteDone'])) {
		unset( $_SESSION['done'][$_POST['deleteDone']] );
	}


	// //Load the HTML page
	// $html = file_get_contents('index.php');
	// //Create a new DOM document
	// $dom = new DOMDocument;
	 
	// //Parse the HTML. The @ is used to suppress any parsing errors
	// //that will be thrown if the $html string isn't valid XHTML.
	// @$dom->loadHTML($html);
	 
	// //Get all links. You could also use any other tag name here,
	// //like 'img' or 'table', to extract other tags.
	// $links = $dom->getElementsByTagName('button');
		
	// //Iterate over the extracted links and display their URLs
	// foreach ($links as $link){
 //    //Extract and show the "href" attribute. 
 //    echo $link->getAttribute('class'), '<br>';
	// }

 ?>





<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todo App</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

    <h1>Todo app</h1>

    	<?php if ( empty($_SESSION['todo']) && empty($_SESSION['done'])): ?>

				<p>Je hebt nog geen TODO's toegevoegd. Zo weinig werk of meesterplanner?</p>    		

    	<?php else: ?>
			
				<h2>Nog te doen</h2>

				<?php if($_SESSION['todo'] != null): ?>

					<ul>
						<?php if (isset( $_SESSION['todo'] )): ?>
							<?php foreach($_SESSION['todo'] as $key => $todo): ?>
								<li>
									<form action="index.php" method="POST">
										<button title="Status wijzigen" name="toggleTodo" value="<?= $key ?>" class="status not-done"> <?= $todo ?> </button>
										<button title="Verwijderen" name="deleteTodo" value="<?= $key ?>">Verwijder</button>
									</form>
							</li>
							<?php endforeach ?>
						<?php endif ?>
					</ul>

				<?php else: ?>
				
					<p>Schouderklopje, alles is gedaan!</p>

				<?php endif ?>

				
				<h2>Done and done!</h2>
				
				<?php if($_SESSION['done'] != null): ?>

					<ul>
						<?php if (isset( $_SESSION['done'] )): ?>
							<?php foreach($_SESSION['done'] as $key => $done): ?>
								<li>
									<form action="index.php" method="POST">
										<button title="Status wijzigen" name="toggleDone" value="<?= $key ?>" class="status not-done"> <?= $done ?> </button>
										<button title="Verwijderen" name="deleteDone" value="<?= $key ?>">Verwijder</button>
									</form>
							</li>
							<?php endforeach ?>
						<?php endif ?>			
					</ul>

				<?php else: ?>
					
					<p>Werk aan de winkel...</p>
				
				<?php endif ?>
					
			<?php endif ?>
								
			
		
		<h1>Todo toevoegen</h1>

		<form action="index.php" method="POST">

			<ul>
				<li>
					<label for="description">Beschrijving: </label>
					<input type="text" id="description" name="description">
				</li>
			</ul>

			<input type="submit" name="addTodo" value="Toevoegen">

		</form>
    </body>
</html>