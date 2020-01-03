<div class="head">
    <div class="mobile-logo">
        <a href="/"><img src="/public/images/logo.svg" alt="Agrokeys"></a></a>
    </div>
    <ul class="options">
        <div class="hide-menu">
            <span style="margin-right: 10px; vertical-align: middle"><?= Lang::_('CLOSE') ?></span><i
                    style="font-size: 24px" class="fas fa-times"></i>
        </div>
        <li class="logo"><a href="/"><img src="/public/images/logo.svg" alt="Zaberi"></a></li>
        <li class="phone"><i class="fas fa-phone-volume"></i>&nbsp;<a style="text-decoration: none"
                                                                      href="tel:+380680960684">+38 068 096 06 84</a>
        </li>

        <li class="<?= $vars['action'] == 'review' ? 'active-tab' : '' ?>"><a href="/review"><span><?= Lang::_('REVIEWS') ?></span></a></li>
        <li class="<?= $vars['action'] == 'about' ? 'active-tab' : '' ?>"><a href="/about"><span><?= Lang::_('ABOUT') ?></span></a></li>
        <li class="<?= $vars['action'] == 'transport' ? 'active-tab' : '' ?>"><a href="/transport"><span><?= Lang::_('TRANSPORT') ?></span></a></li>
        <li><a id="contacts-button" href="javascript:void(0);"><span><?= Lang::_('CONTACTS') ?></span></a></li>
    </ul>
    <div class="mobile-burger">
        <i class="fas fa-bars"></i>
    </div>
</div>
<div class="back-hide"></div>