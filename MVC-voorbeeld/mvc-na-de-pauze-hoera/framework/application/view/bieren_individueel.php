<h1><?= $bier['naam'] ?></h1>

<ul>
	<?php foreach ($bier as $columnName => $value): ?>
		<li><?= $columnName ?>: <?= $value ?></li>
	<?php endforeach ?>
</ul>
