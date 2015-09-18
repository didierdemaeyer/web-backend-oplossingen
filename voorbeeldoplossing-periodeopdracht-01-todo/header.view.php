<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="global.css">
    </head>
    <body>

    <?php if ( $messages ): ?>

        <?php foreach ($messages as $message): ?>

            <div class="modal <?= $message[ 'type' ] ?>">
                <?= $message[ 'text' ] ?>
            </div>

        <?php endforeach ?>
        

    <?php endif ?>