<header class="header">
    <div class="container">
        <div class="logo"></div>
        <nav class="nav">
            <ul class="menu-list">
                <li class="menu-list__item">
                    <a href="index.php" class="menu-list__link">Главная</a>
                </li>
                <li class="menu-list__item">
                    <a href="courses.php" class="menu-list__link">Курсы</a>
                </li>
                <?php if (!isset($_SESSION['user_login']) || empty($_SESSION['user_login'])): ?>
                <li class="menu-list__item">
                    <a href="login.php" class="menu-list__link">Вход</a>
                </li>
                <li class="menu-list__item">
                    <a href="register.php" class="menu-list__link">Регистрация</a>
                </li>
                <?php else: ?>
                <li class="menu-list__item">
                    <form action="/auth/logout.php" method="post">
                        <button type="submit">Выход</button>
                    </form>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>