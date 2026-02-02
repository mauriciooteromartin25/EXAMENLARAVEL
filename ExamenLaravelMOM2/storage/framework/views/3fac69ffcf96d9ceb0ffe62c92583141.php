<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog MOM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
            line-height: 1.6;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .header {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
        }
        
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .post {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
        
        .post-title {
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        .post-meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .post-content {
            margin-bottom: 15px;
        }
        
        .comments {
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }
        
        .comments h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .comment {
            background: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 3px solid #333;
        }
        
        .comment-author {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        
        .btn {
            background: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin: 0 5px;
        }
        
        .btn:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Blog MOM</h1>
            <p>Desarrollado por: MOM</p>
        </div>

        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="post">
            <h2 class="post-title"><?php echo e($post->title); ?></h2>
            
            <div class="post-meta">
                Por <?php echo e($post->user->name); ?> | <?php echo e($post->created_at->format('d/m/Y')); ?>

            </div>
            
            <div class="post-content">
                <?php echo e($post->content); ?>

            </div>
            
            <div class="comments">
                <h3>Comentarios (<?php echo e($post->comments->count()); ?>)</h3>
                
                <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="comment">
                    <div class="comment-author"><?php echo e($comment->user->name); ?></div>
                    <div><?php echo e($comment->content); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="pagination">
            <?php if($posts->previousPageUrl()): ?>
                <a href="<?php echo e($posts->previousPageUrl()); ?>" class="btn">Anterior</a>
            <?php endif; ?>
            
            <span>Página <?php echo e($posts->currentPage()); ?> de <?php echo e($posts->lastPage()); ?></span>
            
            <?php if($posts->nextPageUrl()): ?>
                <a href="<?php echo e($posts->nextPageUrl()); ?>" class="btn">Siguiente</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\CampusFP\ExamenLaravelMOM2\resources\views/posts/indexMOM.blade.php ENDPATH**/ ?>