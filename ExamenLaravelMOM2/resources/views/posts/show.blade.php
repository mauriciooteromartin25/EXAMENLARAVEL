<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
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
        
        .back-btn {
            background: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .back-btn:hover {
            background: #555;
        }
        
        .post {
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
        }
        
        .post-title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .post-meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .post-content {
            margin-bottom: 20px;
        }
        
        .comments {
            border-top: 2px solid #333;
            padding-top: 20px;
            margin-top: 20px;
        }
        
        .comments h2 {
            font-size: 18px;
            margin-bottom: 15px;
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
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-btn">← Volver</a>
        
        <div class="post">
            <h1 class="post-title">{{ $post->title }}</h1>
            
            <div class="post-meta">
                Autor: {{ $post->user->name }} ({{ $post->user->email }})<br>
                Fecha: {{ $post->created_at->format('d/m/Y H:i') }}
            </div>
            
            <div class="post-content">
                {{ $post->content }}
            </div>
            
            <div class="comments">
                <h2>Comentarios ({{ $post->comments->count() }})</h2>
                
                @foreach($post->comments as $comment)
                <div class="comment">
                    <div class="comment-author">{{ $comment->user->name }}</div>
                    <div>{{ $comment->content }}</div>
                    <small style="color: #999;">{{ $comment->created_at->format('d/m/Y') }}</small>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
