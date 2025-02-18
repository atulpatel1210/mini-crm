<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown">
                {{ strtoupper(app()->getLocale()) }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                <a class="dropdown-item" href="{{ route('change.language', 'en') }}">English</a>
                <a class="dropdown-item" href="{{ route('change.language', 'hi') }}">हिन्दी</a>
            </div>
        </li>
    </ul>
</nav>
