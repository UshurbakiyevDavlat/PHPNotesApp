<?php require( base_path('resources/views/partials/head.php')) ?>
<?php require(base_path('resources/views/partials/banner.php')) ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <?php foreach ($notes as $note) { ?>
            <li>
                <a href="/note?id= <?= $note['id'] ?> " class="text-blue-500 hover:underline">
                    <?= htmlspecialchars($note['body']) ?>
                </a>
            </li>
        <?php } ?>

        <a href="/note-create">
            <button type='button'
                    class="mx-auto mt-5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Create note
            </button>
        </a>
    </div>
</main>

<?php require(base_path('resources/views/partials/footer.php')) ?>
