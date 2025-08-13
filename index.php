<?php
/**
 * 简约又不简陋的Typecho模板。
 * 
 * @package simpleblog-theme
 * @author 林海草原
 * @version 1.0
 * @link https://lhcy.org
 */
$this->need('header.php'); ?>

<div class="section-inner">

    <?php
    // 确定标题元素类型
    $archive_title_elem = $this->is('index') ? 'h2' : 'h1';
    
    // 归档类型和标题
    $archive_type = '';
    $archive_title = '';
    $archive_description = '';
    
    // 设置归档标题和描述
    if ($this->is('category')) {
        $archive_type = '分类';
        $archive_title = $this->category;
        $archive_description = $this->getDescription();
    } elseif ($this->is('tag')) {
        $archive_type = '标签';
        $archive_title = $this->archiveTitle(array('tag' => _t('标签 %s 下的文章')), '', '');
    } elseif ($this->is('author')) {
        $archive_type = '作者';
        $archive_title = $this->archiveTitle(array('author' => _t('%s 发布的文章')), '', '');
    } elseif ($this->is('search')) {
        $archive_type = '搜索';
        $archive_title = $this->archiveTitle(array('search' => _t('包含关键字 %s 的文章')), '', '');
    } elseif ($this->is('archive')) {
        $archive_title = $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章')
        ), '', '');
    }
    
    if ($archive_title || $archive_description) : 
    ?>
        <header class="page-header">
            <?php if ($archive_type) : ?>
                <h4 class="page-subtitle"><?php echo $archive_type; ?></h4>
            <?php endif; ?>

            <?php if ($archive_title) : ?>
                <<?php echo $archive_title_elem; ?> class="page-title"><?php echo $archive_title; ?></<?php echo $archive_title_elem; ?>>
            <?php endif; ?>

            <?php if ($archive_description) : ?>
                <div class="page-description">
                    <?php echo $archive_description; ?>
                </div>
            <?php endif; ?>

            <?php if ($this->is('search') && !$this->have()) : ?>
                <form method="post" action="<?php $this->options->siteUrl(); ?>" class="search-form">
                    <input type="search" class="search-field" placeholder="搜索..." name="s" />
                    <button type="submit" class="search-button">搜索</button>
                </form>
            <?php endif; ?>

        </header><!-- .page-header -->
    <?php endif; ?>

   <?php if ($this->have()): ?>
        <div class="posts" id="posts">
            <?php 
            $old_year = '1';
            
            while($this->next()): 
                // 获取当前文章的年份
                $current_year = date('Y', $this->created);
                
                // 如果年份与之前不同，需要新的包装器
                if ($current_year != $old_year) :
                    
                    // 如果是有效年份，而不是我们在循环前添加的默认值，我们有一个需要关闭的开放包装器
                    if (1 != $old_year) {
                        echo '</ul><!-- /' . $old_year . '-->';
                    }
                    
                    // 包装新的年份
                    echo '<ul>';
                    
                    if (!$this->is('date')) :
                    ?>
                        <li>
                            <h3 class="list-title"><a href="<?php echo $this->options->siteUrl . date('Y', $this->created); ?>"><?php echo $current_year; ?></a></h3>
                        </li>
                    <?php
                    endif;
                    
                    // 更新 old_year 变量
                    $old_year = $current_year;
                    
                endif;
            ?>
                <li class="post-preview" id="post-<?php $this->cid(); ?>">
                    <a href="<?php $this->permalink(); ?>">
                        <?php 
                        $sticky = $this->is('sticky') ? '<div class="sticky-arrow"></div>' : '';
                        ?>
                        <h2 class="title"><?php echo $sticky; ?><span><?php $this->title(); ?></span></h2>
                        
                        <?php 
                        // 日期格式设置
                        // 日期格式设置
                        $date_format = $this->options->themeConfig('DateFormat') ? $this->options->themeConfig('DateFormat') : 'n月j日';


                        
                        // 格式化日期
                        $date = date($date_format, $this->created);
                      
                        // 输出日期
                        echo '<time>' . $date . '</time>';
                        ?>
                    </a>
                </li>
            <?php endwhile; ?>
            
            <?php if (1 != $old_year) : ?>
                </ul><!-- /最后一年 -->
            <?php endif; ?>
        </div>

 

    <?php else: ?>
        <div class="post no-results not-found">
            <div class="post-header">
                <h2 class="title"><?php _e('没有找到任何内容'); ?></h2>
            </div>

            <div class="post-content">
                <p><?php _e('抱歉，没有找到符合条件的内容。'); ?></p>
                
            </div>
        </div>
    <?php endif; ?>

</div><!-- .section-inner -->

<?php $this->need('pagination.php'); ?>

<?php $this->need('footer.php'); ?>
