<div class="about-block">
    <div class="about-text">
        <h3>
            <?= Lang::_('ABOUT_US') ?><br>
            <span><?= Lang::_('OUR_ADVANTAGES') ?></span>
        </h3>
        <p>
            Our content team features a very limited number of high-profile events on visitlondon.com. If you would like
            to tell the team about your event, please send press releases and information to
            editorial@londonandpartners.com.
            <br>
            <br>
            For guaranteed coverage, our commercial team offers sponsored event
            listings and other paid opportunities. Find out more about paid-for advertorials, event listings and other
            sponsored content, or get in touch via advertise@londonandpartners.com.
        </p>
    </div>
    <div class="black-block">
        <div class="item-text">
            <i class="fas fa-truck-loading"></i>
            <span>1200</span>
            <br>
            <b><?= Lang::_('DELIVERED_PACKAGES') ?></b>
        </div>
        <div class="item-text">
            <i class="fas fa-bus"></i>
            <span>3200</span>
            <br>
            <b><?= Lang::_('PASSENGER_TRANSPORT') ?></b>
        </div>
    </div>
</div>
<br>
<br>
<br>
<?php if (isset($second_part)):
    echo $second_part;
endif;

Declaration::addStyle('about');
