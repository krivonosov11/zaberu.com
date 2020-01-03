<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ru.js"></script>

<div class="main-content">
    <div class="item-info text-info">
        <div class="info-info">
            <h3><?= Lang::_('WELCOME_TO') ?></h3>
            <h1>ZABERI-BUS</h1>
            <p>
                Paying your fare is very easy - simply touch your payment card of choice on the yellow card reader as
                you
                board the bus, or show the driver your ...
            </p>
            <a href="/about"><b><?= Lang::_('ABOUT_US_SERVICE') ?></b></a>
        </div>
        <div class="wi-fi">
            <img src="/public/images/Wi-Fi.png" alt="">
            <div><?= Lang::_('WELL_BE_ONLINE') ?></div>
        </div>
    </div>
    <div class="item-info order-form">
        <div class="form">
            <div class="switch">
                <div>
                    <label class="container">
                        <input type="radio" checked name="type-order" value="passenger">
                        <span class="checkmark"></span>
                        <?= Lang::_('PASSENGER') ?>
                    </label>
                </div>
                <div>
                    <label class="container">
                        <input type="radio" name="type-order" value="package">
                        <span class="checkmark"></span>
                        <?= Lang::_('PACKAGE') ?>
                    </label>
                </div>
            </div>
            <div class="data">
                <div class="item-data">
                    <label for="from"><?= Lang::_('FROM') ?></label>
                    <select name="from" id="form">
                        <option value="1">Черновцы</option>
                    </select>
                </div>
                <div class="item-data">
                    <label for="to"><?= Lang::_('TO') ?></label>
                    <select name="to" id="to">
                        <option value="2">Москва</option>
                    </select>
                </div>
                <div class="item-data">
                    <label for="date"><?= Lang::_('DATE') ?></label>
                    <input type="text" name="date" id="date" placeholder="дд/мм/год">
                </div>
                <div class="item-data">
                    <label for="your_name"><?= Lang::_('YOUR_NAME') ?></label>
                    <input type="text" name="your_name" id="your_name">
                </div>
                <div class="item-data">
                    <label for="your_name"><?= Lang::_('YOUR_PHONE') ?></label>
                    <input type="text" name="phone" id="phone">
                </div>
                <div class="send-order">
                    <?= Lang::_('SEND_ORDER') ?>&nbsp;<i class="fab fa-telegram-plane"></i>
                </div>
            </div>
        </div>
        <div class="image">
            <img src="/public/images/illustration-Order.png" alt="">
        </div>
    </div>
    <div class="item-info map-block">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d84897.25574261771!2d25.8638791545909!3d48.321326739359606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4734087fe2f6cd05%3A0xc5b396f659796d7a!2z0KfQtdGA0L3QvtCy0YbRiywg0KfQtdGA0L3QvtCy0LjRhtC60LDRjyDQvtCx0LvQsNGB0YLRjCwgNTgwMDA!5e0!3m2!1sru!2sua!4v1577140737698!5m2!1sru!2sua"></iframe>
        </div>
        <div class="calculate">
            <table>
                <tr>
                    <td>
                        <i class="fas fa-route"></i>
                        <br>
                        <?= Lang::_('LENGTH') ?>
                    </td>
                    <td>
                        <i class="far fa-clock"></i>
                        <br>
                        <?= Lang::_('TIME') ?>
                    </td>
                    <td>
                        <i class="fas fa-coins"></i>
                        <br>
                        <?= Lang::_('PRICE') ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>1200 км</b>
                    </td>
                    <td>
                        <b>22 ч 48 м</b>
                    </td>
                    <td>
                        <b>2400 грн</b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="mouse-icon">
        <img src="/public/images/Mouse-icon.svg" alt="">
    </div>
</div>
<?= $reviewsView ?>
<?= $aboutView ?>