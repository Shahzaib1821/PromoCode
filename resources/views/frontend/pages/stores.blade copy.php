<?php include 'includes/header.php'; ?>

<?php
$storeData = [
    ["title" => "Shutterfly", "link" => "detail.php"],
    ["title" => "Airport Parking Deals (UK)", "link" => "store-detail.php"],
    ["title" => "Approved Vitamins (UK)", "link" => "store-detail.php"],
    ["title" => "Bali Bras", "link" => "store-detail.php"],
    ["title" => "Big City Sportswear", "link" => "store-detail.php"],
    ["title" => "Bodega", "link" => "store-detail.php"],
    ["title" => "Bubble Cash", "link" => "store-detail.php"],
    ["title" => "CallonDoc", "link" => "store-detail.php"],
];

// Organize stores by first letter
$organizedStores = [];
foreach ($storeData as $store) {
    $firstLetter = strtoupper(substr($store['title'], 0, 1));
    if (!isset($organizedStores[$firstLetter])) {
        $organizedStores[$firstLetter] = [];
    }
    $organizedStores[$firstLetter][] = $store;
}
ksort($organizedStores); // Sort by letter
?>

<section class="section">
    <div class="container">
        <div class="store-alphabets m30top text-center">
            <ul class="d-flex justify-content-center flex-wrap gap-1">
                <li class="mt-2"><a class="list-style-none stores-alphabets" href="#">ALL</a></li>
                <?php foreach (range('A', 'Z') as $letter) : ?>
                    <li class="mt-2"><a class="list-style-none stores-alphabets" href="#<?= $letter ?>"><?= $letter ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="row mb-4 mt-4 m-auto">
            <div class="col-md-12">
                <h2 class="main-head m30top">All Stores</h2>
            </div>
        </div>
        <div class="row mb-4 mt-4 m-auto">
            <div class="col-md-12">
                <div class="about-content redius white padding30 m30top m30bottom z-depth-2">
                    <div class="row mb-4 mt-4 m-auto">
                        <?php foreach ($organizedStores as $letter => $stores) : ?>
                            <div class="store-entry col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" data-letter="<?= $letter ?>" id="<?= $letter ?>">
                                <h3><?= $letter ?></h3>
                                <ul class="m-3 bullet">
                                    <?php foreach ($stores as $store) : ?>
                                        <li>
                                            <a class="store-name" href="<?= htmlspecialchars($store['link']) ?>" style="font-size:13px">
                                                <strong><?= htmlspecialchars($store['title']) ?></strong>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                        <div id="noDataFound" style="display: none; text-align: center; width: 100%">
                            <div class="alert alert-success" role="alert">
                                No Data Found !
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
