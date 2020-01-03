<?php
$user_info = core\User::getUserInfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php Declaration::addStyle('main'); ?>
    <?php echo \core\mvc\View::getView('/layout/templates/general/head'); ?>
    <title><?= $this->title ?></title>
    <script type="text/javascript">
        var languages_consts = <?php echo json_encode(Lang::getTranslationLines()); ?>;
    </script>
</head>
<body>
<header>
    <?php
    \core\Modules::setVar('action', $this->route['controller']);
    echo core\Modules::getModule('header_menu');
    ?>
</header>

<main>
    <?php
    echo $content;
    ?>
</main>

<footer>
    <?php
    echo core\Modules::getModule('footer');
    ?>
</footer>

</body>
</html>
