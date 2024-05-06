<header>
    <div class='header-item home'>
        <a href="{{ URL::to('/') }}">
        <img src="{{ URL::to('/images') }}/logow2c.png">
        </a>
    </div>
    <div class='header-item nav'>
        <nav>
            <ul>
                <li><a href='/'>Dashboard</a></li>
                <li><a href='/emails'>Emails</a></li>
                <li><a href='/csv'>Importar & Exportar</a></li>
            </ul>
        </nav>
    </div>
    <div class='header-item icons'>
        <?php
            echo file_get_contents(public_path("icons") . "/user.svg");
        ?>
    </div>
</header>