<!DOCTYPE html>
<html>
<head>
    <title>Productos MOM</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 1100px; 
            margin: 30px auto; 
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 { color: #333; margin-bottom: 20px; }
        .alert {
            padding: 12px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .alert-success { background-color: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .alert-error { background-color: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin: 5px 2px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-info { background-color: #17a2b8; color: white; }
        .btn-info:hover { background-color: #138496; }
        .btn-warning { background-color: #ffc107; color: #000; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-danger:hover { background-color: #c82333; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            background: white;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left;
        }
        th { 
            background-color: #007bff; 
            color: white;
            font-weight: 600;
        }
        tr:hover { background-color: #f8f9fa; }
        .empty { text-align: center; color: #666; padding: 40px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Productos - MOM</h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-error"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">+ Crear Producto</a>

        <?php if($products->count() > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($product->id); ?></td>
                        <td><?php echo e($product->nombre); ?></td>
                        <td><?php echo e(number_format($product->precio, 2)); ?> €</td>
                        <td><?php echo e($product->stock); ?></td>
                        <td>
                            <a href="<?php echo e(route('products.show', $product->id)); ?>" class="btn btn-info">Ver</a>
                            <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-warning">Editar</a>
                            <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar este producto?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        <?php else: ?>
            <div class="empty">No hay productos registrados</div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php /**PATH C:\Users\CampusFP\ExamenLaravelMOM1\resources\views/products/index_mom.blade.php ENDPATH**/ ?>