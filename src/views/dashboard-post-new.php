<div class="container">
    <h1 class="dashboard__title">New post</h1>
    <form action="" method="post" class="post__form">
        <div class="form__group">
            <label for="title">Title (required)</label>
            <input type="text" name="title" id="title" class="form__input" value="<?php echo htmlspecialchars($model->title); ?>">
            <div id="email-input-message-placeholder"><?php echo $model->getFirstError("title")?></div>
        </div>
        <div class="form__group">
            <label for="content">Body (required)</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form__input"><?php echo htmlspecialchars($model->content); ?></textarea>
            <div id="email-input-message-placeholder"><?php echo $model->getFirstError("content")?></div>
        </div>
        <div class="form__group">
            <label for="content">Thumbnail</label>
            <input type="file" accept="image/png, image/jpeg" name="thumbnail" id="thumbnail" class="form__input">
            <div id="email-input-message-placeholder"><?php echo $model->getFirstError("thumbnail")?></div>
        </div>
        <div class="form__group">
            <button type="submit" class="cta cta__primary">Create</button>
        </div>
    </form>
</div>