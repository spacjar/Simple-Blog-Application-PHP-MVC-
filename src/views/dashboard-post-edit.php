<div class="container">
    <h1 class="dashboard__title">Edit post</h1>
    <form action="" method="post" class="post__form">
        <div class="form__group">
            <label for="title">Title (required)</label>
            <input type="text" name="title" id="title" class="form__input" value="<?php echo htmlspecialchars($model->title !== "" ? $model->title : $post['title'], ENT_QUOTES, 'UTF-8'); ?>">
            <div id="email-input-message-placeholder"><?php echo $model->getFirstError("title")?></div>
        </div>
        <div class="form__group">
            <label for="content">Body (required)</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form__input"><?php echo htmlspecialchars($model->content !== "" ? $model->content : $post['content'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            <div id="email-input-message-placeholder"><?php echo $model->getFirstError("content")?></div>
        </div>
        <div class="form__group">
            <button type="submit" class="cta cta__primary">Edit</button>
        </div>
    </form>
</div>