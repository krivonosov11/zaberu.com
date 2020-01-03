<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<meta name="msvalidate.01" content="DF72F56D34097D7124A378E22B43CF63"/>
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?=Lang::_('HEADER_TEXT')?>">
<meta property="og:title" content="<?=Lang::_('HEADER_TEXT')?>">
<meta property="og:description" content="<?=Lang::_('DESCRIPTION_SITE_TEXT')?>">
<meta property="og:url" content="<?= SITE_URL ?>">
<meta property="og:locale" content="<?= Lang::code() ?>_<?= strtoupper(Lang::code()) ?>">
<meta property="og:image:width" content="968">
<meta property="og:image:height" content="504">

<?php Declaration::addScript('jquery-3.1.1.min', 'head'); ?>
<?php Declaration::addScript('main', 'head'); ?>
<?= Declaration::$ExternalStyle ?>
<?= Declaration::$ExternalTagToHead ?>

<?= Declaration::$ExternalScriptToHead ?>
