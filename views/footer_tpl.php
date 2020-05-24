<footer class="main-footer">
    <div class="footer-social">
        <ul>
            <li class="twitter-social" tabindex="0" aria-label="наша страница в твиттере"><a class="social-link" href="#"></a></li>
            <li class="instagram-social" tabindex="0" aria-label="наша страница в инстаграмм"><a class="social-link" href="#"></a></li>
            <li class="facebook-social" tabindex="0" aria-label="наша страница в фэйсбук"><a class="social-link" href="#" ></a></li>
            <li class="vkontakte-social" tabindex="0" aria-label="наша страница в вконтакте"><a class="social-link" href="#"></a></li>
        </ul>
    </div>
    <section class="commercial-information">
        <h2 class="visually-hidden"> Коммерческая информация </h2>
        <ul class="commercial-column">
            <li class="commercial-block-item"><a href="forproviders.html">Для поставщиков</a></li>
            <li class="commercial-block-item"><a href="documents.html">Наши документы</a></li>
            <li class="commercial-block-item"><a href="production.html">О производстве</a></li>
            <li class="commercial-block-item"><a href="ecology.html">Экологические стандарты</a></li>
        </ul>
    </section>
    <div class="copyright">
        <a href="https://htmlacademy.ru/intensive/htmlcss">
            <img src="../views/img/logo-name.svg" alt="HTML-Academy" height="39" width="108">
        </a>
        <a href="https://htmlacademy.ru/intensive/htmlcss">Сделано в <span>HTML Academy</span> © 2017</a>
    </div>
</footer>
</div>
</div>
<div class="overlay"></div>
<section class="modal-reg">
    <div class="modal-top-wrapper">
        <h2 style="padding-left: 28px;">Регистрация</h2>
        <a href="#" class="modal-close"></a>
    </div>
    <form class="feedback-form" action="server/register.php" method="post">
        <p class="feedback-item">
            <label><span class="visually-hidden">Ваш e-mail</span>
                <input  class="placeholder input-feedback" type="email" name="email" placeholder="Ваш e-mail">
            </label>
        </p>
        <p class="feedback-item">
            <label><span class="visually-hidden">Ваш пароль</span>
                <input  class="placeholder input-feedback" type="password" name="pass" placeholder="Ваш пароль" minlength="6">
            </label>
        </p>
        <button class="button feedback-button" type="submit">Отправить</button>
    </form>
</section>
<script src="views/js/main.js"></script>
</body>
</html>