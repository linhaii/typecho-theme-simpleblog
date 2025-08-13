<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="section-inner">

    <header class="page-header">
        <h1 class="page-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类: %s'),
            'search'    =>  _t('搜索结果: %s'),
            'tag'       =>  _t('标签: %s'),
            'author'    =>  _t('作者: %s'),
            'date'      =>  _t('归档: %s')
        ), '', ''); ?></h1>
        
        <?php if ($this->is('category') && $this->getDescription()): ?>
            <div class="archive-description">
                <?php echo $this->getDescription(); ?>
            </div>
        <?php endif; ?>
    </header>

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
                        // 获取日期格式设置（这里假设使用 Typecho 的选项或默认为 'j M'）
                        $date_format = $this->options->dateFormat ? $this->options->dateFormat : 'n月j日';
                        
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

        <!-- 使用统一的分页模板 -->
        <?php $this->need('pagination.php'); ?>

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

<?php $this->need('footer.php'); ?>
