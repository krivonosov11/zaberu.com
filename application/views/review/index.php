<div class="reviews">
    <div class="item-info empty-block">
        <div class="item-data">
            <img src="/public/images/Decor-Blue.svg" alt="">
        </div>
        <div class="item-data">
            <h1><?= Lang::_('REVIEWS') ?></h1>
            <p><?= Lang::_('WHAT_PEOPLE_WRITE_ABOUT_US') ?></p>
        </div>
    </div>
    <div class="info-text item-info">
        <div class="quotes">
            <i class="fas fa-quote-left"></i>
        </div>
        <div class="revoews-data">
            <div class="item-review">
                <div class="name">
                    <b>Bohdan Krivonosov</b>
                </div>
                <p class="data">
                    До этого я летал на зонтике. Но в этот раз подумал, что с меня достаточно этих полетов без шлема
                    и парашута. Решил обратиться “Zaberi-Bus”. Выполнили работу профессионально.
                </p>
            </div>
        </div>
        <div class="navigation">
            <i class="fas fa-chevron-left"></i>
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
    <div class="form-review item-info">
        <form action="/review/add-new-review" method="post">
            <h4><?= Lang::_('MAKE_REVIEW') ?></h4>
            <label for="name"><?= Lang::_('YOUR_NAME') ?></label><br>
            <input type="text" name="name" id="name">
            <br>
            <br>
            <label for="review"><?= Lang::_('YOUR_REVIEW') ?></label><br>
            <textarea name="review" id="review" cols="30" rows="10"></textarea>
            <br>
            <input type="submit" value="<?= Lang::_('SEND') ?>">
        </form>
    </div>
</div>
<?php
Declaration::addStyle('reviews');