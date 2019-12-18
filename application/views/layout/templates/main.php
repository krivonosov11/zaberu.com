<?php
$message = core\Message::displayMessage();
$user_info = core\User::getUserInfo();
$version = 19;

$useCookie = BRequest::getVarCookie('useCookie', 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php Declaration::addStyle('main'); ?>
    <?php Declaration::addScript('main'); ?>
    <?php echo \core\mvc\View::getView('/layout/templates/general/head'); ?>
    <title><?=$this->title?></title>
    <script type="text/javascript">
        var languages_consts = <?php echo json_encode(Lang::getTranslationLines()); ?>;
    </script>
</head>
<body>
<header>
    <?php
    \core\Modules::setVar('user_info', $user_info);
    echo core\Modules::getModule('header_menu');
    ?>
</header>

<main>
    <?php
    echo $content;
    ?>
</main>

<?php

?>


<?= Declaration::$ExternalScriptToBody ?>
<?= Declaration::$ExternalStyle ?>
</body>
</html>
