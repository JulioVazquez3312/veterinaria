<?php 
include(__DIR__.'/../client/sistema.class.php');
$app = new Sistema();
if ($app->checkRol("Administrador", false)){
    include(__DIR__.'/../client/views/header.php');
}else{
    include(__DIR__.'/header.php');
}
include(__DIR__ . '/../client/productos.class.php');
$web = new Producto();
$datos= $web->getAll();
?>
        <!-- Header-->
        <header class="bg-success py-2">
            <div class="container px-4 px-lg-4 my-4">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Tienda de productos</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Estos son nuestros productos disponibles</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-3">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($datos as $dato) : ?>                    
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="/uploads/productos/<?php echo $dato['fotografia']; ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="visually-hidden"><?php echo $dato['id_producto']; ?></h5>
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $dato['producto']; ?></h5>
                                    <!-- Product price-->
                                    <span class="text-muted ">$</span>
                                    <?php echo $dato ['precio'];?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                <form action="cartAdd.php" method="GET">
                                    <input type="hidden" name="id_producto" value="<?php echo $dato['id_producto']; ?>">
                                    <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2">
                                    <button class="btn btn-success" type="submit">Add to cart</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>

<?php include '../client/views/footer.php'; ?>
