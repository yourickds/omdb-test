<?php
    /**
     * @var array<MovieD> $collection
     * */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php foreach ($collection as $item): ?>

        <p><?= $item->title ?></p>
        <img src="<?= $item->poster ?>" alt="poster">

        <p><?= $item->type ?></p>
        <p><?= $item->year ?></p>

    <?php endforeach; ?>
</body>
</html>
