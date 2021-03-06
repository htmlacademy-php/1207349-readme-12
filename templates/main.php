<section class="page__main page__main--popular">
    <div class="container">
        <h1 class="page__title page__title--popular">Популярное</h1>
    </div>
    <div class="popular container">
        <div class="popular__filters-wrapper">
            <div class="popular__sorting sorting">
                <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
                <ul class="popular__sorting-list sorting__list">
                    <li class="sorting__item sorting__item--popular">
                        <a class="sorting__link sorting__link--active" href="#">
                            <span>Популярность</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Лайки</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Дата</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="popular__filters filters">
                <b class="popular__filters-caption filters__caption">Тип контента:</b>
                <ul class="popular__filters-list filters__list">
                    <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                        <a class="filters__button filters__button--ellipse filters__button--all <?= $filter_post_type_id === 0 ? 'filters__button--active' : '' ?>" href="/">
                            <span>Все</span>
                        </a>
                    </li>
                    <?php foreach ($content_types as $type): ?>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--<?= hsc($type['type_class']) ?> button <?= $filter_post_type_id === $type['id'] ? 'filters__button--active' : '' ?>" href="<?= hsc(add_get_param('type_id', $type['id'])) ?>">
                            <span class="visually-hidden"><?= hsc($type['type_name']) ?></span>
                            <svg 
                                class="filters__icon" 
                                width="<?= hsc($type['icon_width']) ?>" 
                                height="<?= hsc($type['icon_height']) ?>"
                            >
                                <use xlink:href="#icon-filter-<?= hsc($type['type_class']) ?>"></use>
                            </svg>
                        </a>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="popular__posts">
            <?php foreach ($posts as $post): ?>
            <?php $post_date = date_create($post['date']) ?>
            <article class="popular__post post <?= 'post-' . hsc($post['type_class']) ?>">
                <header class="post__header">
                    <a href="<?= '/post.php' . hsc(add_get_param('post_id', $post['id']))?>"><h2><?= hsc($post['type_name']) ?></h2></a>
                </header>
                <div class="post__main">
                    <?php if ($post['type_class'] === 'quote'): ?>
                    <blockquote>
                        <p><?= hsc($post['content']) ?></p>
                        <cite><?= hsc($post['username']) ?></cite>
                    </blockquote>
                    <?php elseif ($post['type_class'] === 'text'): ?>
                    <p><?= hsc(reduce_text($post['content'], 300)) ?></p>
                    <?php if (mb_strlen($post['content']) > 300): ?>
                    <a class="post-text__more-link" href="#">Читать далее</a>
                    <?php endif ?>
                    <?php elseif ($post['type_class'] === 'photo'): ?>
                    <div class="post-photo__image-wrapper">
                        <img src="img/<?= hsc($post['content']) ?>" alt="Фото от пользователя" width="360" height="240">
                    </div>
                    <?php elseif ($post['type_class'] === 'link'): ?>
                    <div class="post-link__wrapper">
                        <a class="post-link__external" href="http://<?= hsc($post['content']) ?>" title="Перейти по ссылке">
                            <div class="post-link__info-wrapper">
                                <div class="post-link__icon-wrapper">
                                    <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                                </div>
                                <div class="post-link__info">
                                    <h3><?= hsc($post['type_name']) ?></h3>
                                </div>
                            </div>
                            <span><?= hsc($post['content']) ?></span>
                        </a>
                    </div>
                    <?php endif ?>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/<?= hsc($post['user_picture']) ?>" alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name"><?= hsc($post['username']) ?></b>
                                <time 
                                    class="post__time" 
                                    datetime="<?= hsc($post['date']) ?>" 
                                    title="<?= hsc(date_format($post_date, 'd.m.Y H:i')) ?>"
                                ><?= hsc(get_date_diff_from_now($post_date)) ?></time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span><?= hsc($post['like_count'] ?? 0) ?></span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span><?= hsc($post['comment_count'] ?? 0) ?></span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
            <?php endforeach ?>
        </div>
    </div>
</section>