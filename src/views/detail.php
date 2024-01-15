<?php
    if(empty($postDetail)) {
        throw new NotFoundException();
    }
?>

<main class="blog-detail">
    <div class="blog-detail-header">
        <div class="container">
            <h1 class="heading-1"><?php echo htmlspecialchars($postDetail['title']); ?></h1>
        </div>
    </div>
    <!-- <div class="blog-detail-information">
        <div class="container">
            <div class="blog-detail-information__info">
                <img src="/assets/images/placeholder.png" alt="Blog post image" class="blog-detail-information__avatar">
                <div>
                    <p class="blog-detail-information__author">Author name</p>
                    <p class="blog-detail-information__date">11 Jan 2022</p>
                </div>
            </div>
        </div>
    </div> -->
    <div class="blog-detail-thumbnail">
        <div class="container">
            <img src="/assets/images/placeholder.png" alt="Blog thumbnail">
        </div>
    </div>
    <div class="blog-detail-content">
        <div class="container">
            <div class="blog-detail-content__section">
                <?php echo htmlspecialchars($postDetail['content']); ?>
                <!-- <h2 class="blog-detail-content__heading heading-4">Introduction</h2>
                <p class="blog-detail-content__text text-regular">Mi tincidunt elit, id quisque ligula ac diam, amet. Vel etiam suspendisse morbi eleifend faucibus eget vestibulum felis. Dictum quis montes, sit sit. Tellus aliquam enim urna, etiam. Mauris posuere vulputate arcu amet, vitae nisi, tellus tincidunt. At feugiat sapien varius id.</p>
                <p class="blog-detail-content__text text-regular">Eget quis mi enim, leo lacinia pharetra, semper. Eget in volutpat mollis at volutpat lectus velit, sed auctor. Porttitor fames arcu quis fusce augue enim. Quis at habitant diam at. Suscipit tristique risus, at donec. In turpis vel et quam imperdiet. Ipsum molestie aliquet sodales id est ac volutpat.</p>
                <div class="blog-detail-content__image">
                    <img src="./assets/placeholder.png" alt="Blog image">
                    <span>Image caption goes here</span>
                </div>
                <p class="blog-detail-content__text text-regular">Elit nisi in eleifend sed nisi. Pulvinar at orci, proin imperdiet commodo consectetur convallis risus. Sed condimentum enim dignissim adipiscing faucibus consequat, urna. Viverra purus et erat auctor aliquam. Risus, volutpat vulputate posuere purus sit congue convallis aliquet. Arcu id augue ut feugiat donec porttitor neque. Mauris, neque ultricies eu vestibulum, bibendum quam lorem id. Dolor lacus, eget nunc lectus in tellus, pharetra, porttitor.</p>
                <p class="blog-detail-content__text text-regular">Tristique odio senectus nam posuere ornare leo metus, ultricies. Blandit duis ultricies vulputate morbi feugiat cras placerat elit. Aliquam tellus lorem sed ac. Montes, sed mattis pellentesque suscipit accumsan. Cursus viverra aenean magna risus elementum faucibus molestie pellentesque. Arcu ultricies sed mauris vestibulum.</p>
            </div>
            <div class="blog-detail-content__section">
                <h3 class="blog-detail-content__heading heading-4">Conclusion</h3>
                <p class="blog-detail-content__text text-regular">Morbi sed imperdiet in ipsum, adipiscing elit dui lectus. Tellus id scelerisque est ultricies ultricies. Duis est sit sed leo nisl, blandit elit sagittis. Quisque tristique consequat quam sed. Nisl at scelerisque amet nulla purus habitasse.</p>
                <p class="blog-detail-content__text text-regular">Nunc sed faucibus bibendum feugiat sed interdum. Ipsum egestas condimentum mi massa. In tincidunt pharetra consectetur sed duis facilisis metus. Etiam egestas in nec sed et. Quis lobortis at sit dictum eget nibh tortor commodo cursus.</p>
                <p class="blog-detail-content__text text-regular">Odio felis sagittis, morbi feugiat tortor vitae feugiat fusce aliquet. Nam elementum urna nisi aliquet erat dolor enim. Ornare id morbi eget ipsum. Aliquam senectus neque ut id eget consectetur dictum. Donec posuere pharetra odio consequat scelerisque et, nunc tortor. Nulla adipiscing erat a erat. Condimentum lorem posuere gravida enim posuere cursus diam.</p>
            </div> -->
        </div>
    </div>
</main>