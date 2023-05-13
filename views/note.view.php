<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="/notes" class="text-blue-500 hover:underline">Go back to all notes</a>
            </div>
            <li>
                <?= htmlspecialchars($note['body']) ?>
            </li>
        </div>
    </main>

<?php require('partials/footer.php') ?>
