<?php
require 'config/database.php';
require 'includes/header.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM businesses WHERE id = ?");
$stmt->execute([$id]);
$business = $stmt->fetch();

if(!$business) {
    header('Location: index.php');
    exit;
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="card-title"><?= htmlspecialchars($business['name']) ?></h1>
                    <span class="badge bg-primary fs-6"><?= htmlspecialchars($business['category']) ?></span>
                </div>
                
                <p class="text-muted mt-3">
                    <i class="fas fa-clock me-1"></i> 
                    Added on <?= date('M d, Y', strtotime($business['created_at'])) ?>
                </p>
                
                <div class="business-details mt-4">
                    <h4>About</h4>
                    <p><?= nl2br(htmlspecialchars($business['description'])) ?></p>
                    
                    <h4 class="mt-5">Contact Information</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <?= htmlspecialchars($business['address']) ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-phone me-2"></i>
                            <?= htmlspecialchars($business['phone']) ?>
                        </li>
                        <?php if($business['email']): ?>
                        <li class="list-group-item">
                            <i class="fas fa-envelope me-2"></i>
                            <?= htmlspecialchars($business['email']) ?>
                        </li>
                        <?php endif; ?>
                        <?php if($business['website']): ?>
                        <li class="list-group-item">
                            <i class="fas fa-globe me-2"></i>
                            <a href="<?= htmlspecialchars($business['website']) ?>" target="_blank">
                                Visit Website
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Business Location</h5>
                <div class="map-placeholder bg-light p-4 text-center text-muted">
                    <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                    <p>Map would display here</p>
                    <small class="text-muted">(Integration with Google Maps API)</small>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Share This Business</h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary flex-fill">
                        <i class="fab fa-facebook me-1"></i> Facebook
                    </button>
                    <button class="btn btn-outline-info flex-fill">
                        <i class="fab fa-twitter me-1"></i> Twitter
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/footer.php'; ?>