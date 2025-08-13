<?php
/**
 * 页面模板
 */
$this->need('header.php');
?>

<article class="post page">

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
    </header><!-- .entry-header -->

    <div class="entry-content section-inner">
        <?php $this->content(); ?>
    </div> <!-- .content -->

    <?php
    // 页面分页
    if ($this->is('page') && $this->fields->pagePage && $this->fields->pagePage != 1) {
        echo '<p class="section-inner linked-pages">' . _t('页面:');
        for ($i = 1; $i <= $this->fields->pagePage; $i++) {
            if ($i == 1) {
                echo '<a href="' . $this->permalink . '">' . $i . '</a>';
            } else {
                echo '<a href="' . $this->permalink . '?page=' . $i . '">' . $i . '</a>';
            }
        }
        echo '</p>';
    }
    ?>

    <?php if ($this->allow('comment')): ?>
        <div class="comments-section-inner section-inner wide">
            <?php $this->need('comments.php'); ?>
        </div><!-- .comments-section-inner -->
    <?php endif; ?>

</article> <!-- .post -->

<?php $this->need('footer.php'); ?>
