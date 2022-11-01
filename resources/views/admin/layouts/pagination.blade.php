<?php for($x = 1; $x <= $paginate['total_pages']; $x++): ?>
    <a href='/admin/customers?page=<?php echo $x; ?>'><?php echo $x; ?></a>
<?php endfor; ?>