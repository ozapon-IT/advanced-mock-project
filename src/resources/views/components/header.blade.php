<header class="header">
    <div class="header__wrapper">
        <div class="header__menu">
            <a class="header__menu-toggle" href="#modal-menu">
                <i class="bi bi-list"></i>
            </a>

            <span class="header__service-name">Rese</span>
        </div>

        @if ($showSearch)
            <div class="header__search">
                <div class="header__search-group">
                    <select class="header__search-select" name="area" form="search-form">
                        <option value="All area" {{ request('area') === 'All area' ? 'selected' : ''}}>All area</option>

                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : ''}}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="header__search-group">
                    <select class="header__search-select" name="genre" form="search-form">
                        <option value="All genre" {{ request('genre') === 'All genre' ? 'selected' : ''}}>All genre</option>

                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : ''}}>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>

                <form action="{{ route('index') }}" id="search-form" method="GET">
                    <button class="header__search-button" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <input class="header__search-input" type="text" name="text" placeholder="Search ..." form="search-form" value="{{ request('text') }}">
            </div>
        @endif
    </div>
</header>