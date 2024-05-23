<?php include('includes/header.php'); ?>;

<div class="container-fluid px-4">
    <div class="row justify-content-sm-evenly">
        <div class="col-md-12 ">
            <h1 class="mt-4 fw-bold text-dark text-md-center">KOFI - KO Analytics</h1>
            <hr>
            <?php alertMessage(); ?>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-primary p-3 ">
                <p class="text-sm mb-0 text-capitalize text-white">Total Categories</p>
                <div class="fw-bold text-white mb-0">
                    <?= getCount('category'); ?>
                </div>
                <div class="card-footer d-flex aligh-items-center justify-content-between">
                    <a class = "small text-white stretched-link" href="view-categories.php">View Details</a>
                    <div class="small text-white"><i class = "fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-dark p-3">
                <p class="text-sm mb-0 text-capitalize text-white">Total Products</p>
                <div class="fw-bold text-white mb-0">
                    <?= getCount('product'); ?>
                </div>
                <div class="card-footer d-flex aligh-items-center justify-content-between">
                    <a class = "small text-white stretched-link" href="view-products.php">View Details</a>
                    <div class="small text-white"><i class = "fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-danger p-3">
                <p class="text-sm mb-0 text-capitalize text-white">Total Suppliers</p>
                <div class="fw-bold text-white mb-0">
                    <?= getCount('supplier'); ?>
                </div>
                <div class="card-footer d-flex aligh-items-center justify-content-between">
                    <a class = "small text-white stretched-link" href="view-suppliers.php">View Details</a>
                    <div class="small text-white"><i class = "fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class = "container-fluid px-4">
            <div class="card mt-4 shadow sm">
                <div class="card-header">
                    <h4 class="mb-0 fw-bold text-md-center">PRODUCTS INVENTORY
                    </h4>
                </div>
                <div class="card-body">
                    
                    <?php alertMessage() ?>
                    <?php 
                    $products = getAll('product');
                    if(!$products){
                        echo "<h4>Something went wrong!</h4>";
                        return false;
                    }

                    if(mysqli_num_rows($products) > 0){
                    ?>
                    <div class = "table-responsive">
                        <table class="table table-striped table-bordered text-md-center">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($products as $item): ?>
                                <tr>
                                    <td><?= $item['ID']?></td>
                                    <td><img src="../<?= $item['Image']?>" style="width=100px; height=100px;" alt="img">
                                    <td><?= $item['Product_name']?></td>
                                    <td><?= $item['Quantity']?></td>
                                    <td><?= $item['Price']?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    }
                    else {
                        ?>
                            <h4 class="mb-0">No products found!</h4>
                        <?php
                    }
                    ?> 
                </div>       
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>;