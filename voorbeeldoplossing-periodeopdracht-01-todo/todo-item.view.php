<ul>
	<?php foreach ( $items as $key => $array ): ?>
		<li>
			<form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
				<button title="Status wijzigen" name="toggleTodo" value="<?= $key ?>" class="status <?= ( $array['active'] ) ? 'done' : 'not-done' ?>"><?= $array[ 'description' ] ?></button>
				<button title="Verwijderen" name="deleteTodo" value="<?= $key ?>">Verwijder</button>
			</form>
		</li>
	<?php endforeach ?>
</ul>