<?php require( base_path('resources/views/partials/head.php')) ?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="/notes" class="text-blue-500 hover:underline">Go back to all notes</a>
            </div>
            <ul>
                <li>
                    <?= htmlspecialchars($note['body']) ?>
                </li>
            </ul>

            <footer class="mt-6">
                <a href="/note-edit?id=<?=$note['id']?>" class="bg-green-400 text-gray-500 border border-current px-3 py-1 rounded text-sm font-semibold leading-6">
                    Update
                </a>

                <form method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="<?=$note['id']?>">
                    <button type="submit" class="rounded-sm mt-5 shadow-sm px-4 py-1 bg-red-400">Delete</button>
                </form>
            </footer>
        </div>
    </main>

<?php require(base_path('resources/views/partials/footer.php')) ?>
