<div class="container">
    <div class="ps-page--blog">
        <div class="container">
            <div class="ps-page__header">
                <h1>Новости и статьи</h1>
                <div class="ps-breadcrumb--2">
                    <ul class="breadcrumb">
                        <li><a href="{base_url}">Главная</a></li>
                        <li>Новости и статьи</li>
                    </ul>
                </div>
            </div>
            <div class="ps-blog">
                <div class="ps-blog__header">
                    <ul class="ps-list--blog-links">
                        <li><a id="tag0" onclick="getBlogsByTag(0)">Все</a></li>
                        <?php foreach ($tags as $tag) : ?>
                            <li><a id="tag<?= $tag['id'] ?>" onclick="getBlogsByTag(<?= $tag['id'] ?>)"><?= $tag['tag_name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="ps-blog__content" id="blog_list">

                </div>
            </div>
        </div>
        <div id="loading" style="display: none;">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>


