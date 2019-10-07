<?php foreach ($posts as $post): ?>
    <?= '<h3>' . $post->title . '</h3>' ?>
    <?= '<h5>' . $post->description . '</h5>' ?>

<?php endforeach; ?>

