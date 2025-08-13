<!DOCTYPE html>

<html class="no-js" lang="<?php $this->options->lang(); ?>">

    <head>
<style>:root { --accent-color: <?php echo $this->options->accent_color ?: '#121212'; ?>; }</style>

        <meta http-equiv="content-type" content="text/html; charset=<?php $this->options->charset(); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >

        <link rel="profile" href="http://gmpg.org/xfn/11">
        
        <title><?php $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ' - '); ?><?php $this->options->title(); ?></title>

        <?php $this->header(); ?>
        <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('comments.css'); ?>"> 
        <link rel="stylesheet" href="<?php $this->options->themeUrl('css/font-awesome.css'); ?>">
        <script src="<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
        <script src="<?php $this->options->themeUrl('js/global.js'); ?>"></script>

    </head>

    <body class="<?php $this->options->bodyClass(); ?>">

        <a class="skip-link button" href="#site-content"><?php _e('跳转到文章'); ?></a>

        <header class="site-header group">

            <?php $site_title_elem = $this->is('index') ? 'h1' : 'p'; ?>

            <<?php echo $site_title_elem; ?> class="site-title"><a href="<?php $this->options->siteUrl(); ?>" class="site-name"><?php $this->options->title(); ?></a></<?php echo $site_title_elem; ?>>

            <?php if ($this->options->description): ?>

                <div class="site-description"><?php $this->options->description(); ?></div>

            <?php endif; ?>

            <div class="nav-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
            </div>

            <div class="menu-wrapper">

                <ul class="main-menu desktop">

                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <li<?php if($this->is('page', $pages->slug)): ?> class="current-menu-item"<?php endif; ?>>
                        <a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                    </li>
                    <?php endwhile; ?>
                    
                    <?php
                    // 这里可以添加自定义菜单项 
                    ?> 
                    <!--  例如：<li><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>     -->           
                    
                </ul>

            </div><!-- .menu-wrapper -->


                <div class="social-menu desktop">

                    <ul class="social-menu-inner">

                        <li class="social-search-wrapper"><a href="<?php $this->options->siteUrl(); ?>?s=" class="search-toggle"><span class="screen-reader-text"><?php _e('搜索'); ?></span></a></li>

                        
                        <?php if ($options->socialTwitter): ?>
                        <li><a href="<?php echo $options->socialTwitter; ?>" target="_blank"><span class="screen-reader-text">Twitter</span></a></li>
                        <?php endif; ?>
                        
                        <?php if ($options->socialFacebook): ?>
                        <li><a href="<?php echo $options->socialFacebook; ?>" target="_blank"><span class="screen-reader-text">Facebook</span></a></li>
                        <?php endif; ?>
                        
                        <?php if ($options->socialGitHub): ?>
                        <li><a href="<?php echo $options->socialGitHub; ?>" target="_blank"><span class="screen-reader-text">GitHub</span></a></li>
                        <?php endif; ?>
                        

                    </ul><!-- .social-menu-inner -->

                </div><!-- .social-menu -->

        </header><!-- header -->

        <div class="mobile-menu-wrapper">

            <ul class="main-menu mobile">
                <?php while($pages->next()): ?>
                <li<?php if($this->is('page', $pages->slug)): ?> class="current-menu-item"<?php endif; ?>>
                    <a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                </li>
                <?php endwhile; ?>

                    <?php
                    // 这里可以添加自定义菜单项 
                    ?> 
                    <!--  例如：<li><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>     -->           


               
                    <li class="toggle-mobile-search-wrapper"><a href="#" class="toggle-mobile-search"><?php _e('搜索'); ?></a></li>
                
            </ul><!-- .main-menu.mobile -->

            

                <div class="social-menu mobile">

                    <ul class="social-menu-inner">
                        <?php if ($options->socialTwitter): ?>
                        <li><a href="<?php echo $options->socialTwitter; ?>" target="_blank"><span class="screen-reader-text">Twitter</span></a></li>
                        <?php endif; ?>
                        
                        <?php if ($options->socialFacebook): ?>
                        <li><a href="<?php echo $options->socialFacebook; ?>" target="_blank"><span class="screen-reader-text">Facebook</span></a></li>
                        <?php endif; ?>
                        
                        <?php if ($options->socialGitHub): ?>
                        <li><a href="<?php echo $options->socialGitHub; ?>" target="_blank"><span class="screen-reader-text">GitHub</span></a></li>
                        <?php endif; ?>
                    </ul><!-- .social-menu-inner -->

                </div><!-- .social-menu -->

            

        </div><!-- .mobile-menu-wrapper -->

        

            <div class="mobile-search">


                <form method="post" class="search-for action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input type="text" name="s" class="search-field" placeholder="<?php _e('输入关键字并按下回车键'); ?>" />
                   
                </form>

                <div class="mobile-results">

                    <div class="results-wrapper"></div>

                </div>

            </div><!-- .mobile-search -->

            <div class="search-overlay">

                <form method="post" class="search-for action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input type="text" name="s" class="search-field" placeholder="<?php _e('输入关键字并按下回车键'); ?>" />
                    
                </form>

            </div><!-- .search-overlay -->

        

        <main class="site-content" id="site-content">
