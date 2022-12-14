@if ($paginate['total_pages'] > 1)
    <div class="pagination_custom">
        <a href='/admin/{{ $url }}?page=<?php echo (isset($paginate['page'])) ? ($paginate['page'] - 1) : ''; ?>&keyword=<?= $param['keyword'] ?>' class="{{ (isset($paginate['page']) && $paginate['page'] == 1) ? 'disable' : '' }}">&laquo;</a>
        <?php for($x = 1; $x <= $paginate['total_pages']; $x++): ?>
            <a class="{{ (isset($paginate['page']) && $paginate['page'] == $x) ? 'active' : ''; }}" href='/admin/{{ $url }}?page=<?php echo $x; ?>&keyword=<?= $param['keyword'] ?>'><?php echo $x; ?></a>
        <?php endfor; ?>
        <a href='/admin/{{ $url }}?page=<?php echo (isset($paginate['page'])) ? ($paginate['page'] + 1) : ''; ?>&keyword=<?= $param['keyword'] ?>' class="{{ (isset($paginate['page']) && $paginate['page'] == $paginate['total_pages']) ? 'disable' : '' }}">&raquo;</a>
    </div>
@endif
