<h1>Todo app</h1>

		<?php if ( $todoItems || $doneItems ): ?>
				
			<h2>Nog te doen</h2>

			<?php if ( $todoItems ): ?>
				
				<?php  view( 'todo-item.view.php', array( 'items' => $todoItems ) ) ?>

			<?php else: ?>

				<p>Schouderklopje, alles is gedaan!</p>

			<?php endif ?>

			<h2>Done and done!</h2>

				<?php if ( $doneItems ): ?>
					
					<?php  view( 'todo-item.view.php', array( 'items' => $doneItems ) ) ?>

				<?php else: ?>
					
					<p>Werk aan de winkel...</p>

				<?php endif ?>
				
			
		<?php else: ?>
			<p>Je hebt nog geen TODO's toegevoegd. Zo weinig werk of meesterplanner?</p>
		<?php endif ?>

		<h1>Todo toevoegen</h1>

		<form action="<?= $_SERVER['PHP_SELF']?>" method="POST">

			<ul>
				<li>
					<label for="description">Beschrijving: </label>
					<input type="text" id="description" name="description">
				</li>
			</ul>

			<input type="submit" name="addTodo" value="Toevoegen">

		</form>