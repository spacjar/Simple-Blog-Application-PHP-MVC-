<div class="container">
    <h1 class="dashboard__title heading-3">New post</h1>
    <form method="post" id="post__form" class="post__form" enctype="multipart/form-data">
        <div class="form__group">
            <label for="title-input">Title (required)</label>
            <input type="text" name="title" id="title-input" class="form__input text-large <?php echo $model->hasError('title') ? 'is-invalid' : '' ?>" value="<?php echo htmlspecialchars($model->title, ENT_QUOTES, 'UTF-8'); ?>">
            <div id="title-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("title")?></div>
        </div>
        <div class="form__group">
            <label for="content-input">Content (required)</label>
            <textarea name="content" id="content-input" cols="30" rows="10" class="form__input text-large <?php echo $model->hasError('content') ? 'is-invalid' : '' ?>"><?php echo htmlspecialchars($model->content, ENT_QUOTES, 'UTF-8'); ?></textarea>
            <div id="content-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("content")?></div>
        </div>
        <div class="form__group">
            <label for="thumbnail-input">Thumbnail image</label>
            <input type="file" accept="image/png, image/jpeg" name="thumbnail" id="thumbnail-input" class="form__input text-large <?php echo $model->hasError('thumbnail') ? 'is-invalid' : '' ?>">
            <div id="thumbnail-input-message-placeholder" class="error-message"><?php echo $model->getFirstError("thumbnail")?></div>
        </div>
        <div class="form__group">
            <button type="submit" class="cta cta__primary">Create</button>
        </div>
    </form>
</div>

<script src="static/js/pages/dashboard/post-form-validation.js" type="module"></script>