<div class="container">
    <h1 class="dashboard__title">New post</h1>
    <form action="#" method="post" class="post__form" enctype="multipart/form-data">
        <div class="form__group">
            <label for="title">Title (required)</label>
            <input type="text" name="title" id="title" class="form__input" value="<?php echo htmlspecialchars($model->title, ENT_QUOTES, 'UTF-8'); ?>">
            <div id="title-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("title")?></div>
        </div>
        <div class="form__group">
            <label for="content">Content (required)</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form__input"><?php echo htmlspecialchars($model->content, ENT_QUOTES, 'UTF-8'); ?></textarea>
            <div id="content-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("content")?></div>
        </div>
        <div class="form__group">
            <label for="thumbnail">Thumbnail image</label>
            <input type="file" accept="image/png, image/jpeg" name="thumbnail" id="thumbnail" class="form__input">
            <div id="thumbnail-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("thumbnail")?></div>
        </div>
        <div class="form__group">
            <button type="submit" class="cta cta__primary">Create</button>
        </div>
    </form>
</div>