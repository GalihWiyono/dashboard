<?php if ($pager->getPageCount() > 1) : ?>
    <nav aria-label="<?= lang('Pager.pageNavigation') ?>">
        <ul class="pagination justify-content-center">
            <!-- Tombol Previous -->
            <li class="page-item <?= $pager->getCurrentPageNumber() == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= $pager->getCurrentPageNumber() == 1 ? '#' : $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true">&#171;</span>
                </a>
            </li>

            <!-- Link Halaman -->
            <?php foreach ($pager->links() as $link): ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>

            <!-- Tombol Next -->
            <li class="page-item <?= $pager->getCurrentPageNumber() == $pager->getPageCount() ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= $pager->getCurrentPageNumber() == $pager->getPageCount() ? '#' : $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true">&#187;</span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif ?>