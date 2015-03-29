<?php
 use yii\helpers\Html;
 use yii\helpers\Url;
?>
<!--<div>
    <img style="-webkit-user-select: none; cursor: pointer;" src="<?/*=Url::to('/static/img/').'logo.png';*/?>" width="445px" height="445px" alt=""/>
<!--    <img style="-webkit-user-select: none; cursor: pointer;" src="http://knowyourmeme.com/photos/144910-courage-wolf" width="445px" height="445px" alt=""/>-->
<!--</div>-->
<div class="wrapper">
    <header id="header">
        <div class="container">
            <ul class="nav lang-switch left">
                <li><a  data-lang="en" href="javascript:;">English</a></li>
                <li><a class=current data-lang="ru" href="javascript:;">Русский</a></li>
            </ul>
            <ul class="nav">
                <li>Уже зарегистрированы?</li>
                <li><a href="#signin">Войти</a></li>
            </ul><!-- / nav -->
        </div>
    </header><!-- / header -->
    <div id="login" class="login ">
        <div class="container">
            <strong class="logo">
                <?= Html::img('/static/img/logo.png',['width'=>'100px','height'=>'100px'], true) ?></strong>
            </strong>
            
<!--        <img src="file:///var/www/advanced/frontend/img/logo.png"/></strong>-->
<!--            <img src="data:image/png;base64,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" />-->
            <h1>Flirchi</h1>
            <div class="login-form">
                <form method="post" id="form-signup" class="form-signup" onsubmit="return false" action="/sign/up?hc=6ea9ab1baa0efb9e19094440c317e21b">
                    <fieldset>
                        <strong class="heading">Миллионы людей уже с нами </strong>
                        <div class="block">
                            <strong class="title">Создай свой аккаунт</strong>
                            <div class="inputs">
                                <input class="txt" type="text" placeholder="Имя" name="name" />
                                <input class="txt" type="email" placeholder="Email" name="email" />
                            </div>
                            <div class="selects">
                                <select name="gender" class="select left">
                                    <option selected="">Пол</option>
                                    <option value="m">Мужской</option>
                                    <option value="f">Женский</option>
                                </select>
                                <select name="age" class="select right">
                                    <option selected="">Возраст</option>
                                    <option value="18">18 лет</option>
                                    <option value="19">19 лет</option>
                                    <option value="20">20 лет</option>
                                    <option value="21">21 год</option>
                                    <option value="22">22 года</option>
                                    <option value="23">23 года</option>
                                    <option value="24">24 года</option>
                                    <option value="25">25 лет</option>
                                    <option value="26">26 лет</option>
                                    <option value="27">27 лет</option>
                                    <option value="28">28 лет</option>
                                    <option value="29">29 лет</option>
                                    <option value="30">30 лет</option>
                                    <option value="31">31 год</option>
                                    <option value="32">32 года</option>
                                    <option value="33">33 года</option>
                                    <option value="34">34 года</option>
                                    <option value="35">35 лет</option>
                                    <option value="36">36 лет</option>
                                    <option value="37">37 лет</option>
                                    <option value="38">38 лет</option>
                                    <option value="39">39 лет</option>
                                    <option value="40">40 лет</option>
                                    <option value="41">41 год</option>
                                    <option value="42">42 года</option>
                                    <option value="43">43 года</option>
                                    <option value="44">44 года</option>
                                    <option value="45">45 лет</option>
                                    <option value="46">46 лет</option>
                                    <option value="47">47 лет</option>
                                    <option value="48">48 лет</option>
                                    <option value="49">49 лет</option>
                                    <option value="50">50 лет</option>
                                    <option value="51">51 год</option>
                                    <option value="52">52 года</option>
                                    <option value="53">53 года</option>
                                    <option value="54">54 года</option>
                                    <option value="55">55 лет</option>
                                    <option value="56">56 лет</option>
                                    <option value="57">57 лет</option>
                                    <option value="58">58 лет</option>
                                    <option value="59">59 лет</option>
                                    <option value="60">60 лет</option>
                                    <option value="61">61 год</option>
                                    <option value="62">62 года</option>
                                    <option value="63">63 года</option>
                                    <option value="64">64 года</option>
                                    <option value="65">65 лет</option>
                                    <option value="66">66 лет</option>
                                    <option value="67">67 лет</option>
                                    <option value="68">68 лет</option>
                                    <option value="69">69 лет</option>
                                    <option value="70">70 лет</option>
                                </select>
                            </div><!-- / selects -->
                            <input class="create-btn" type="submit" value="Зарегистрировать" />
                        </div><!-- / block -->
                        <strong class="title">или войти с помощью</strong>
                        <ul class="social">
                            <li><a class="social-button facebook fb" href="javascript:;" data-auth-provider="facebook">facebook</a></li>
                            <li><a class="social-button vk" href="javascript:;" data-auth-provider="vk">vkontakte</a></li>
                            <!--              <li><a href="#" class="google">google+</a></li>-->
                            <li><a class="social-button mailru mail" href="javascript:;" data-auth-provider="mailru">mail.ru</a></li>
                            <!--              <li><a href="#" class="odnoklassniki">odnoklassniki</a></li>-->
                            <li><a class="social-button yandex" href="javascript:;" data-auth-provider="yandex">ya.ru</a></li>
                        </ul>
                        <div class="auth_description">
                            <input type="checkbox" checked="checked" id="not_agree_check">Авторизируясь, Вы подтверждаете свое согласие с <a href="/rules">правилами</a>, <a href="/privacypolicy">политикой конфиденциальности</a> и подписываетесь на email рассылку                        </div>
                    </fieldset>
                    <input type="hidden"  value="1" name="form_data" />
                    <input type="hidden"  value="1" name="skip_captcha" />
                    <input type="hidden" value="1" name="check_rules" id="check_rules">
                    <input type="hidden" value="1" name="check_email" id="check_email">
                </form>
            </div><!-- / login-form -->
        </div><!-- / container -->
    </div><!-- / login -->
    <div class="visual">
        <div class="container">
            <h2>Flirchi - быстрорастущая сеть online discovery.</h2>
            <p>Мы работаем над тем, чтобы больше людей получали качественные знакомства и общение. Наша задача - сделать общение интересным и динамичным.</p>
            <div class="img">
                <img src="http://s.flirchicdn.com/images/loginpage/macbook.png" alt="image" />
            </div><!-- / img -->
        </div>
    </div><!-- / visual -->
    <div class="statistics">
        <div class="container">
            <h2>Наша Статистика</h2>
            <p>Миллионы людей со всего мира встречают друг друга и строят отношения на Flirchi прямо сейчас!</p>
            <div class="two-colums">
                <div class="col">
                    <div class="img">
                        <img src="http://s.flirchicdn.com/images/loginpage/ico-01.png" alt="image" />
                    </div>
                    <strong id="usercount" class="digit">97 973 903</strong>
                    <strong class="title">пользователи сети</strong>
                </div>
                <div class="col">
                    <div class="img">
                        <img src="http://s.flirchicdn.com/images/loginpage/ico-02.png" alt="image" />
                    </div>
                    <strong id="visitors" class="digit">30 552</strong>
                    <strong class="title">пользователи онлайн</strong>
                </div>
            </div><!-- / two-colums -->
        </div>
    </div><!-- / statistics -->
    <div class="services">
        <ul class="service-list">
            <li>
                <div class="img">
                    <img src="http://s.flirchicdn.com/images/loginpage/ico-03.png" alt="image" />
                </div>
                <strong>Сообщения</strong>
                <p>Каждый участник получает минимум одно сообщение за сессию</p>
            </li>
            <li>
                <div class="img">
                    <img src="http://s.flirchicdn.com/images/loginpage/ico-04.png" alt="image" />
                </div>
                <strong>Контакты</strong>
                <p>Активный пользователь получает 100 контактов в день</p>
            </li>
            <li>
                <div class="img">
                    <img src="http://s.flirchicdn.com/images/loginpage/ico-05.png" alt="image" />
                </div>
                <strong>Диалоги</strong>
                <p>Каждую секунду контакт ведет к новому диалогу</p>
            </li>
        </ul>
    </div><!-- / services -->
    <div class="connect">
        <div class="container">
            <h3>Где бы ты ни был,<br>оставайся на связи с Flirchi!</h3>
            <strong class="title">Теперь для iOS, Android и мобильных браузеров.</strong>
            <ul class="buttons">
                <li><a href="http://flirchi.com/ads/track?id=promote_ios_promo_click&link=ios_app_site" target="_blank"><img src="http://s.flirchicdn.com/images/loginpage/appstore-btn.png" alt="image" /></a></li>
                <li><a href="http://flirchi.com/ads/track?id=promote_android_promo_click&link=android_app_site" target="_blank"><img src="http://s.flirchicdn.com/images/loginpage/googleplay-btn.png" alt="image" /></a></li>
                <li><a href="http://m.flirchi.com/" target="_blank"><img src="http://s.flirchicdn.com/images/loginpage/flirchi-btn.png" alt="image" /></a></li>
            </ul><!-- / buttons -->
        </div>
    </div><!-- / connect -->
    <div class="social-area">
        <div class="container">
            <div class="img">
                <img src="http://s.flirchicdn.com/images/loginpage/img-01.png" alt="image" />
            </div>
            <div class="block">
                <header>
                    <strong>Общайтесь с нами</strong>
                    <span>Добавь наше приложение в своей любимой социальной сети</span>
                </header>
                <ul class="apps">
                    <li>
                        <a href="http://apps.facebook.com/flirchi/" target="_blank">
                            <div class="ico">
                                <img src="http://s.flirchicdn.com/images/loginpage/ico-06.png" alt="image" />
                            </div>
                            <span>Facebook App</span>
                        </a>
                    </li>
                    <li>
                        <a href="http://vk.com/app3077164" target="_blank">
                            <div class="ico">
                                <img src="http://s.flirchicdn.com/images/loginpage/ico-07.png" alt="image" />
                            </div>
                            <span>Vkontakte App</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- / social-area -->
    <div class="signup">
        <div class="login-form" id="signin">
            <form method="post" action="/sign/in" id="form-signin" class="form-signin" onsubmit="return false">
                <fieldset>
                    <strong class="heading">Уже зарегистрированы?</strong>
                    <div class="block">
                        <strong class="title">Войти</strong>
                        <div class="inputs">
                            <input class="txt" type="email" placeholder="Email" name="email" />
                        </div>
                        <input class="create-btn" type="submit" value="Войти" />
                    </div><!-- / block -->
                    <strong class="title">или войти с помощью</strong>
                    <ul class="social">
                        <li><a class="social-button facebook fb" href="javascript:;" data-auth-provider="facebook">facebook</a></li>
                        <li><a class="social-button vk" href="javascript:;" data-auth-provider="vk">vkontakte</a></li>
                        <!--              <li><a href="#" class="google">google+</a></li>-->
                        <li><a class="social-button mailru mail" href="javascript:;" data-auth-provider="mailru">mail.ru</a></li>
                        <!--              <li><a href="#" class="odnoklassniki">odnoklassniki</a></li>-->
                        <li><a class="social-button yandex" href="javascript:;" data-auth-provider="yandex">ya.ru</a></li>
                    </ul>
                </fieldset>
                <input type="hidden"  value="1" name="form_data" />
                <input type="hidden"  value="1" name="skip_captcha" />
                <input type="hidden" value="1" name="check_rules" id="check_rules">
                <input type="hidden" value="1" name="check_email" id="check_email">
            </form>
        </div><!-- / login-form -->
    </div><!-- / signup -->
    <footer id="footer">
        <div class="container">
            Copyright © 2014 Flirchi. Все права защищены.        </div>
    </footer><!-- / footer -->
</div><!-- / wrapper -->
</body>
</html>