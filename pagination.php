<?php if ($this->have() && $this->getTotalPage() > 1): ?>

    <div class="archive-pagination section-inner group">
    
        <?php if ($this->_currentPage > 1): ?>
            <div class="previous-posts-link">
                <h4 class="title"><?php $this->pageLink('上一页', 'prev'); ?></h4>
            </div>
        <?php endif; ?>
        
        <?php if ($this->_currentPage < $this->getTotalPage()): ?>
            <div class="next-posts-link">
                <h4 class="title"><?php $this->pageLink('下一页', 'next'); ?></h4>
            </div>
        <?php endif; ?>

    </div> <!-- .pagination -->

<?php endif; ?>
