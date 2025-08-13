<?php
/**
 * 文章页面模板
 */
$this->need('header.php');
?>

<article class="post">

    <?php if ($this->fields->thumbnail && !$this->password): ?>
        <div class="featured-image">
            <img src="<?php echo $this->fields->thumbnail; ?>" alt="<?php $this->title() ?>" />
        </div>
    <?php endif; ?>

    <header class="entry-header section-inner">

        <h1 class="entry-title"><?php $this->title() ?></h1>

        <?php if ($this->fields->excerpt): ?>
            <p class="excerpt"><?php echo $this->fields->excerpt; ?></p>
        <?php endif; ?>

        <div class="meta">
            <time><a href="<?php $this->permalink() ?>"><?php $this->date(); ?></a></time>

            <span>
                <?php _e('分类：', 'simpleblog'); ?> <?php $this->category(','); ?>
            </span>
        </div>

    </header><!-- .entry-header -->

    <div class="entry-content section-inner">
        <?php $this->content(); ?>
    </div> <!-- .content -->

    <?php
    // 文章分页
    if ($this->is('single') && $this->fields->postPage && $this->fields->postPage != 1) {
        echo '<p class="section-inner linked-pages">' . _t('页面:');
        for ($i = 1; $i <= $this->fields->postPage; $i++) {
            if ($i == 1) {
                echo '<a href="' . $this->permalink . '">' . $i . '</a>';
            } else {
                echo '<a href="' . $this->permalink . '?page=' . $i . '">' . $i . '</a>';
            }
        }
        echo '</p>';
    }
    
    // 显示标签
    if ($this->tags): ?>
    <div class="meta bottom section-inner">
        <p class="tags">
            <?php 
            $i = 0;
            $result = array();
            foreach ($this->tags as $tag) {
                $result[] = '<a href="' . $tag['permalink'] . '">#' . $tag['name'] . '</a>';
            }
            echo implode(' ', $result);
            ?>
        </p>
    </div> <!-- .meta -->
    <?php endif; ?>



    <div class="post-pagination section-inner">
        <div class="previous-post">
            <?php $this->thePrev('%s', '<span></span>'); ?>
        </div>

        <div class="next-post">
            <?php $this->theNext('%s', '<span></span>'); ?>
        </div>
    </div><!-- .post-pagination -->

    <?php if ($this->allow('comment')): ?>
        <div class="comments-section-inner section-inner wide">
            <?php $this->need('comments.php'); ?>
        </div><!-- .comments-section-inner -->
    <?php endif; ?>

</article> <!-- .post -->

<?php

$this->need('footer.php');
?>
