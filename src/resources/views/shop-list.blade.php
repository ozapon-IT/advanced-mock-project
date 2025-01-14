<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>飲食店一覧ページ - Rese</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/common/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop-list.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__container">
            <div class="header__menu">
                <a class="menu__link" href="">
                    <i class="bi bi-list"></i>
                </a>
                <h1 class="menu__service-name">Rese</h1>
            </div>
            <div class="header__search">
                <div class="search__box">
                    <select class="search__select search__area" name="area" id="">
                        <option value="">All area</option>
                        <option value="tokyo">東京都</option>
                        <option value="osaka">大阪府</option>
                        <option value="fukuoka">福岡県</option>
                    </select>
                </div>
                <div class="search__box">
                    <select class="search__select search__genre" name="genre" id="">
                        <option value="">All genre</option>
                        <option value="sushi">寿司</option>
                        <option value="yakiniku">焼肉</option>
                        <option value="izakaya">居酒屋</option>
                        <option value="italian">イタリアン</option>
                        <option value="ramen">ラーメン</option>
                    </select>
                </div>
                <button class="search__button">
                    <i class="bi bi-search"></i>
                </button>
                <input class="search__text" type="text" name="text" placeholder="Search ...">
            </div>
        </div>
    </header>

    <main>
        <div class="shop-list">
            <div class="shop-list__card">
                <div class="shop-list__image">
                    <img src="" alt="">
                </div>
                <div class="shop-list__content">
                    <h2 class="shop-list__name">仙人</h2>
                    <p class="shop-list__area">#東京都</p>
                    <p class="shop-list__genre">#寿司</p>
                    <a class="shop-list__detail" href="">詳しくみる</a>
                    <button class="shop-list__favorite">
                        <i class="bi bi-suit-heart-fill"></i>
                    </button>
                </div>
            </div>

            <div class="shop-list__card">
                <div class="shop-list__image">
                    <img src="" alt="">
                </div>
                <div class="shop-list__content">
                    <h2 class="shop-list__name">牛助</h2>
                    <p class="shop-list__area">#大阪府</p>
                    <p class="shop-list__genre">#焼肉</p>
                    <a class="shop-list__detail" href="">詳しくみる</a>
                    <button class="shop-list__favorite">
                        <i class="bi bi-suit-heart-fill"></i>
                    </button>
                </div>
            </div>

            <div class="shop-list__card">
                <div class="shop-list__image">
                    <img src="" alt="">
                </div>
                <div class="shop-list__content">
                    <h2 class="shop-list__name">戦慄</h2>
                    <p class="shop-list__area">#福岡県</p>
                    <p class="shop-list__genre">#居酒屋</p>
                    <a class="shop-list__detail" href="">詳しくみる</a>
                    <button class="shop-list__favorite">
                        <i class="bi bi-suit-heart-fill"></i>
                    </button>
                </div>
            </div>

            <div class="shop-list__card">
                <div class="shop-list__image">
                    <img src="" alt="">
                </div>
                <div class="shop-list__content">
                    <h2 class="shop-list__name">ルーク</h2>
                    <p class="shop-list__area">#東京都</p>
                    <p class="shop-list__genre">#イタリアン</p>
                    <a class="shop-list__detail" href="">詳しくみる</a>
                    <button class="shop-list__favorite">
                        <i class="bi bi-suit-heart-fill"></i>
                    </button>
                </div>
            </div>

            <div class="shop-list__card">
                <div class="shop-list__image">
                    <img src="" alt="">
                </div>
                <div class="shop-list__content">
                    <h2 class="shop-list__name">志摩屋</h2>
                    <p class="shop-list__area">#福岡県</p>
                    <p class="shop-list__genre">#ラーメン</p>
                    <a class="shop-list__detail" href="">詳しくみる</a>
                    <button class="shop-list__favorite">
                        <i class="bi bi-suit-heart-fill"></i>
                    </button>
                </div>
            </div>

            <div class="shop-list__card">
                <div class="shop-list__image">
                    <img src="" alt="">
                </div>
                <div class="shop-list__content">
                    <h2 class="shop-list__name">香</h2>
                    <p class="shop-list__area">#東京都</p>
                    <p class="shop-list__genre">#焼肉</p>
                    <a class="shop-list__detail" href="">詳しくみる</a>
                    <button class="shop-list__favorite">
                        <i class="bi bi-suit-heart-fill"></i>
                    </button>
                </div>
            </div>

            <div class="shop-list__card">
                <div class="shop-list__image">
                    <img src="" alt="">
                </div>
                <div class="shop-list__content">
                    <h2 class="shop-list__name">JJ</h2>
                    <p class="shop-list__area">#大阪府</p>
                    <p class="shop-list__genre">#イタリアン</p>
                    <a class="shop-list__detail" href="">詳しくみる</a>
                    <button class="shop-list__favorite">
                        <i class="bi bi-suit-heart-fill"></i>
                    </button>
                </div>
            </div>

            <div class="shop-list__card">
                <div class="shop-list__image">
                    <img src="" alt="">
                </div>
                <div class="shop-list__content">
                    <h2 class="shop-list__name">らーめん極み</h2>
                    <p class="shop-list__area">#東京都</p>
                    <p class="shop-list__genre">#ラーメン</p>
                    <a class="shop-list__detail" href="">詳しくみる</a>
                    <button class="shop-list__favorite">
                        <i class="bi bi-suit-heart-fill"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>