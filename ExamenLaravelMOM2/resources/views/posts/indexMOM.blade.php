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

        @foreach($posts as $post)
        <div class="post">
            <h2 class="post-title">{{ $post->title }}</h2>
            
            <div class="post-meta">
                Por {{ $post->user->name }} | {{ $post->created_at->format('d/m/Y') }}
            </div>
            
            <div class="post-content">
                {{ $post->content }}
            </div>
            
            <div class="comments">
                <h3>Comentarios ({{ $post->comments->count() }})</h3>
                
                @foreach($post->comments as $comment)
                <div class="comment">
                    <div class="comment-author">{{ $comment->user->name }}</div>
                    <div>{{ $comment->content }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="pagination">
            @if($posts->previousPageUrl())
                <a href="{{ $posts->previousPageUrl() }}" class="btn">Anterior</a>
            @endif
            
            <span>Página {{ $posts->currentPage() }} de {{ $posts->lastPage() }}</span>
            
            @if($posts->nextPageUrl())
                <a href="{{ $posts->nextPageUrl() }}" class="btn">Siguiente</a>
            @endif
        </div>
    </div>
</body>
</html>
