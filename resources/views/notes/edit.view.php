<?php require(base_path('resources/views/partials/head.php')) ?>
<?php require(base_path('resources/views/partials/banner.php')) ?>

<main>
    <form class="m-6" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $note_id ?>">

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Create note</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Body</label>
                        <div class="mt-2">
                            <input type="text" name="body" id="body" autocomplete="given-body"
                                   value="<?= $body ?? '' ?>"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <?php
                            if (!empty($errors)) {
                                echo '<p class="text-red-500 text-sm mt-1">' . (implode('', $errors)) . '</p>';
                            }
                            if (!empty($result)) {
                                echo '<p class="text-green-500 text-sm mt-1">' . $result . '</p>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/notes" class="text-sm font-semibold leading-6 text-gray-900">
                Cancel
            </a>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Update
            </button>
        </div>
    </form>
</main>

<?php require(base_path('resources/views/partials/footer.php')) ?>
