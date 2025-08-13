<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * simpleblog- theme 主题函数
 */

/**
 * 主题设置
 */
function themeConfig($form) {
    // 侧边栏背景颜色
    $accentColor = new Typecho\Widget\Helper\Form\Element\Text(
        'accentColor', 
        null, 
        '#121212', 
        _t('侧边栏背景颜色'), 
        _t('设置桌面端侧边栏和移动端顶部的背景颜色，请使用十六进制颜色代码')
    );
    $form->addInput($accentColor);
    
    // 社交链接设置
    $socialTwitter = new Typecho\Widget\Helper\Form\Element\Text(
        'socialTwitter', 
        null, 
        '', 
        _t('Twitter 链接'), 
        _t('您的 Twitter 个人资料链接')
    );
    $form->addInput($socialTwitter);
    
    $socialFacebook = new Typecho\Widget\Helper\Form\Element\Text(
        'socialFacebook', 
        null, 
        '', 
        _t('Facebook 链接'), 
        _t('您的 Facebook 个人资料链接')
    );
    $form->addInput($socialFacebook);
    
    $socialGitHub = new Typecho\Widget\Helper\Form\Element\Text(
        'socialGitHub', 
        null, 
        '', 
        _t('Github 链接'), 
        _t('您的 Github 个人资料链接')
    );
    $form->addInput($socialGitHub);
}

/**
 * 输出自定义CSS
 */
function outputCustomCSS() {
    $options = Helper::options();
    $accentColor = $options->accentColor ? $options->accentColor : '#121212';
    
    echo '<style type="text/css">';
    echo 'body .site-header { background-color: ' . $accentColor . '; }';
    echo '.social-menu.desktop { background-color: ' . $accentColor . '; }';
    echo '.social-menu a:hover { color: ' . $accentColor . '; }';
    echo '.social-menu a.active { color: ' . $accentColor . '; }';
    echo '.mobile-menu-wrapper { background-color: ' . $accentColor . '; }';
    echo '.social-menu.mobile { background-color: ' . $accentColor . '; }';
    echo '.mobile-search.active { background-color: ' . $accentColor . '; }';
    echo ':root { --accent-color: ' . $accentColor . '; }';
    echo '</style>';
}

/**
 * 添加自定义CSS到头部
 */
function themeInit($archive) {
    // 输出自定义CSS
    if ($archive->is('index') || $archive->is('archive') || $archive->is('single')) {
        outputCustomCSS();
    }
}    

/**
 * 获取文章类
 */
function getPostClass($post) {
    $classes = array();
    
    // 检查是否有缩略图
    if ($post->attachment && $post->attachment->isImage) {
        $classes[] = 'has-thumbnail';
    } else {
        $classes[] = 'missing-thumbnail';
    }
    
    // 检查是否有标题
    if (empty($post->title)) {
        $classes[] = 'no-title';
    }
    
    return implode(' ', $classes);
}

/**
 * 获取 body 类
 */
function getBodyClass($archive) {
    $options = Helper::options();
    $classes = array();

    // 白色背景
    if ($options->accentColor == '#ffffff') {
        $classes[] = 'white-bg';
    }

    
    return implode(' ', $classes);
}

/**
 * 获取归档类型
 */
function getArchiveType($archive) {
    if ($archive->is('category')) {
        return _t('分类');
    } elseif ($archive->is('tag')) {
        return _t('标签');
    } elseif ($archive->is('author')) {
        return _t('作者');
    } elseif ($archive->is('date') && $archive->is('year')) {
        return _t('年');
    } elseif ($archive->is('date') && $archive->is('month')) {
        return _t('月');
    } elseif ($archive->is('date') && $archive->is('day')) {
        return _t('日');
    } elseif ($archive->is('search')) {
        return _t('搜索结果');
    } elseif ($archive->is('index') && $options->homeTitle) {
        return _t('简介');
    } else {
        return _t('归档');
    }
}

/**
 * 获取归档标题
 */
function getArchiveTitle($archive) {
    $options = Helper::options();
    
    if ($archive->is('category')) {
        return $archive->category;
    } elseif ($archive->is('tag')) {
        return '#' . $archive->tag;
    } elseif ($archive->is('author')) {
        return $archive->author->screenName;
    } elseif ($archive->is('date') && $archive->is('year')) {
        return $archive->year;
    } elseif ($archive->is('date') && $archive->is('month')) {
        return $archive->year . ' ' . $archive->month;
    } elseif ($archive->is('date') && $archive->is('day')) {
        return $archive->year . '-' . $archive->month . '-' . $archive->day;
    } elseif ($archive->is('search')) {
        return '"' . $archive->getKeywords() . '"';
    } elseif ($archive->is('index') && $options->homeTitle) {
        return $options->homeTitle;
    } else {
        return _t('归档');
    }
}

/**
 * 获取归档描述
 */
function getArchiveDescription($archive) {
    if ($archive->is('search')) {
        $count = $archive->have();
        if ($count) {
            return sprintf(_t('我们找到 %s 符合您的搜索请求。'), $count . ' ' . _t('个结果'));
        } else {
            return sprintf(_t('我们没有找到关于 "%s" 的搜索结果。'), $archive->getKeywords());
        }
    }
    
    return $archive->description;
}

/**
 * 自定义评论列表
 */
function threadedComments($comments, $options) {
    $commentClass = '';
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';
    
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '" target="_blank" rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
    
    // 评论作者为文章作者
    $byPostAuthor = '';
    if ($comments->authorId == $comments->ownerId) {
        $byPostAuthor = ' <span class="comment-by-post-author">(' . _t('本文作者') . ')</span>';
    }
    
    ?>
    <div id="li-<?php $comments->theId(); ?>" class="comment<?php echo $commentLevelClass; ?>">
        <div id="<?php $comments->theId(); ?>">
            <header class="comment-meta">
                <span class="comment-author">
                    <cite><?php echo $author; ?></cite>
                    <?php echo $byPostAuthor; ?>
                </span>
                <span class="comment-date">
                    <a class="comment-date-link" href="<?php $comments->permalink(); ?>" title="<?php $comments->date('c'); ?>">
                        <?php $comments->date(); ?>
                    </a>
                </span>
                <span class="comment-reply">
                    <?php $comments->reply(_t('回复')); ?>
                </span>
            </header>
            <div class="comment-content entry-content">
                <?php $comments->content(); ?>
            </div>
            <div class="comment-actions">
                <?php if ('waiting' == $comments->status): ?>
                <p class="comment-awaiting-moderation"><?php _t('您的评论正等待审核'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
    </div>
    <?php
}

/**
 * 添加 JavaScript 功能
 */
function addJsFeatures() {
    ?>
    <script>jQuery('html').removeClass('no-js').addClass('js');</script>
    <?php
}

// 添加钩子
Typecho\Plugin::factory('header')->header = 'addJsFeatures';
Typecho\Plugin::factory('Widget_Archive')->header = 'outputCustomCSS';

/**
 * 自定义评论回调函数
 */
function themeCommentList($comment, $options) {
    $commentClass = '';
    if ($comment->authorId) {
        if ($comment->authorId == $comment->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    
    $commentLevelClass = $comment->levels > 0 ? ' comment-child' : ' comment-parent';
    
    $depth = $comment->levels + 1;
    if ($depth > 4) {
        $depth = 4;
    }
    $commentLevelClass .= ' comment-level-' . $depth;
?>

<div id="<?php $comment->theId(); ?>" class="comment-body<?php echo $commentClass . $commentLevelClass; ?>">
    <div class="comment-author">
        <?php $comment->gravatar('40', ''); ?>
        <cite class="fn"><?php $comment->author(); ?></cite>
    </div>
    <div class="comment-meta">
        <time datetime="<?php $comment->date('c'); ?>"><?php $comment->date('Y-m-d H:i'); ?></time>
    </div>
    <div class="comment-content">
        <?php $comment->content(); ?>
    </div>
    <div class="comment-reply">
        <?php $comment->reply(_t('回复')); ?>
    </div>
    
    <?php if ($comment->children) { ?>
    <div class="comment-children">
        <?php $comment->threadedComments($options); ?>
    </div>
    <?php } ?>
</div>

<?php
}
