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

    <section class="search">
        <form action="/" method="get">
            <input type="text" placeholder="Search" name="search">
            <input type="submit" value="Search">
        </form>
    </section>

    <section class="banner">
        <h1>Привет №1 это продающий текст на странице</h1>
        <p>Маленькое описание для продающего текста на странице</p>
        <p>Этот текст тут тоже нужен, он может быть супер длинный, может быть в несколько строчек, может и не быть вапще</p>
    </section>


    <section class="items">
        <?php if (!empty($collection)): ?>
            <?php foreach ($collection as $item): ?>
                <div class="items__item">
                    <div class="items__item_bg">
                        <img src="<?= $item->poster ?>" alt="poster">
                    </div>
                    <div class="items__item_info">
                        <h3><?= $item->title ?></h3>
                        <p><?= $item->year ?></p>
                        <button class="btn_info" type="button">Подробнее</button>
                    </div>

                    <dialog class="card">
                        <img src="<?= $item->poster ?>" alt="poster">
                        <h3><?= $item->title ?></h3>
                        <p><?= $item->year ?>, <?= $item->genre ?></p>
                        <p><?= $item->description ?></p>

                        <button class="card_close">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.12" d="M12 24C18.6274 24 24 18.6274 24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24Z" fill="#818C99" />
                                <path d="M16.7364 7.2636C17.0879 7.61508 17.0879 8.18492 16.7364 8.5364L13.273 12L16.7364 15.4636C17.0586 15.7858 17.0854 16.2915 16.817 16.6442L16.7364 16.7364C16.3849 17.0879 15.8151 17.0879 15.4636 16.7364L12 13.273L8.5364 16.7364C8.18492 17.0879 7.61508 17.0879 7.2636 16.7364C6.91213 16.3849 6.91213 15.8151 7.2636 15.4636L10.727 12L7.2636 8.5364C6.94142 8.21421 6.91457 7.70853 7.18306 7.35577L7.2636 7.2636C7.61508 6.91213 8.18492 6.91213 8.5364 7.2636L12 10.727L15.4636 7.2636C15.8151 6.91213 16.3849 6.91213 16.7364 7.2636Z" fill="#818C99" />
                            </svg>
                        </button>
                    </dialog>
                </div>
            <?php endforeach; ?>
        <?php elseif(!empty($error)): ?>

            <h3><?= $error ?></h3>

        <?php else: ?>
            <h3>Введите что-то в поиск.</h3>
        <?php endif; ?>

    </section>

    <script>
        const btn_show = document.querySelectorAll('.btn_info');
        const btn_close = document.querySelectorAll('.card_close');

        btn_show.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                let dialog = e.currentTarget.parentElement.parentElement.getElementsByTagName('dialog')[0];
                dialog.showModal();
            });
        })

        btn_close.forEach(btn => {
            btn.addEventListener('click', (e) => {
                let dialog = e.currentTarget.parentElement;
                dialog.close();
            });
        })
    </script>

</body>
</html>
