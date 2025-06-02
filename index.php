<?php 
require 'config/database.php';
require 'includes/header.php';

// Fetch businesses
$stmt = $pdo->query("SELECT * FROM businesses ORDER BY created_at DESC LIMIT 6");
$businesses = $stmt->fetchAll();
?>

<div class="hero-section bg-primary text-white py-5 mb-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Local Business Directory</h1>
        <p class="lead">Discover the best businesses in your area</p>
        <a href="add-business.php" class="btn btn-light btn-lg mt-3">Add Your Business</a>
    </div>
</div>

<h2 class="mb-4">Recently Added Businesses</h2>
<div class="row">
    <?php foreach($businesses as $business): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($business['name']) ?></h5>
                    <span class="badge bg-primary"><?= htmlspecialchars($business['category']) ?></span>
                    <p class="card-text mt-2 text-muted"><?= substr(htmlspecialchars($business['description']), 0, 100) ?>...</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <?= htmlspecialchars($business['address']) ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-phone me-2"></i>
                            <?= htmlspecialchars($business['phone']) ?>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-white">
                    <a href="view-business.php?id=<?= $business['id'] ?>" class="btn btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require 'includes/footer.php'; ?>