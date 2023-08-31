<?php
$stylesheets = $this->stylesheets ? '<link rel="stylesheet" type="text/css" href="' . CSS_DIR . $this->stylesheets . CSS_VERSION . '" />' : "";
$scripts = $this->scripts ? '<script defer src="' . JS_DIR . $this->scripts . JS_VERSION .  '"></script>' : "";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux Concours Atol</title>
    <link rel="stylesheet" type="text/css" href="<?= CSS_DIR ?>style<?= CSS_VERSION ?>" />
    <link rel="stylesheet" type="text/css" href="<?= CSS_DIR ?>lib/fontAwesome/all.min.css?6.1.1" />
    <?= $stylesheets ?>
</head>
<body>
    <?php require VIEWS . 'header.php'; ?>
    <div id="content" class="content">
        <?= $this->content ?>   
    </div>
    <script defer src="<?= JS_DIR ?>main<?= JS_VERSION ?>"></script> 
    <?= $scripts ?>
</body>
</html>