<table>
	<?php foreach ($bieren as $bier): ?>
		<tr>
			<td><a href="<?= URL ?>/bieren/<?= $bier['biernr'] ?>"><?= $bier['naam'] ?></a></td>
		</tr>
	<?php endforeach ?>
</table>