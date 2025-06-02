<?php require 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Search Businesses</h2>
                
                <form action="search.php" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg" 
                               name="query" placeholder="Search by name, category or location">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php
        if(isset($_GET['query'])) {
            $search = '%' . $_GET['query'] . '%';
            
            $stmt = $pdo->prepare("SELECT * FROM businesses 
                                  WHERE name LIKE ? OR category LIKE ? OR address LIKE ?
                                  ORDER BY created_at DESC");
            $stmt->execute([$search, $search, $search]);
            $results = $stmt->fetchAll();
            ?>
            
            <h3 class="mb-4">Search Results</h3>
            
            <?php if(count($results) > 0): ?>
                <div class="list-group">
                    <?php foreach($results as $business): ?>
                    <a href="view-business.php?id=<?= $business['id'] ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= htmlspecialchars($business['name']) ?></h5>
                            <small class="text-muted"><?= htmlspecialchars($business['category']) ?></small>
                        </div>
                        <p class="mb-1"><?= htmlspecialchars($business['address']) ?></p>
                        <small><?= htmlspecialchars($business['phone']) ?></small>
                    </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No businesses found matching your search.</div>
            <?php endif; ?>
        <?php } ?>
    </div>
</div>

<?php require 'includes/footer.php'; ?>