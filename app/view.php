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
    <link rel="stylesheet" href="/style.css">
    <title>Document</title>
</head>
<body>

    <section class="banner">
        <h1>Привет №1 это продающий текст на странице</h1>
        <p>Маленькое описание для продающего текста на странице</p>
        <p>Этот текст тут тоже нужен, он может быть супер длинный, может быть в несколько строчек, может и не быть вапще</p>
    </section>

    <section class="items">
        <?php foreach ($collection as $item): ?>
            <div class="items__item">
                <div class="items__item_bg">
                    <img src="<?= $item->poster ?>" alt="poster">
                </div>
                <div class="items__item_info">
                    <h3><?= $item->title ?></h3>
                    <p><?= $item->year ?></p>
                    <button type="button">Подробнее</button>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

</body>
</html>
