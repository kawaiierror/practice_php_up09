<!--<h2>--><?php //= $message ?? ''; ?><!-- --><?php //= app()->auth::user()->name ?><!--</h2>-->
<h2>
    <?php if (app()->auth::check()): ?>
        <?= $message ?? ''; ?> <?= app()->auth::user()->name ?>
    <?php else: ?>
        Пожалуйста, войдите в аккаунт
    <?php endif; ?>
</h2>