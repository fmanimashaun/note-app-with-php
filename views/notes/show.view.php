<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <!-- Replace with your content -->
    <div class="px-4 py-6 sm:px-0">
      <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">

        <p class="mb-6">
          <?= htmlspecialchars($note['body']); ?>
        </p>

        <div class="mt-6 flex items-center gap-x-6">
          <a href="/notes"
            class="border border-current rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
          <a href="/note/edit?id=<?= $note['id'] ?>"
            class="border border-current rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
        </div>
      </div>
    </div>
    <!-- /End replace -->
  </div>
</main>

<?php require base_path('views/partials/footer.php'); ?>