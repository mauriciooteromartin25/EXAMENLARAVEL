<?php

/**
 * EJEMPLOS DE CONSULTAS CON EAGER LOADING (CARGA ANSIOSA)
 * Sistema de Blog MOM
 * 
 * Este archivo muestra ejemplos de cómo realizar consultas con eager loading
 * para evitar el problema N+1 y optimizar las consultas a la base de datos.
 */

namespace App\Examples;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class EagerLoadingExamples
{
    /**
     * Ejemplo 1: Obtener todos los posts con sus autores y comentarios
     * 
     * SIN EAGER LOADING (Problema N+1):
     * - 1 consulta para obtener posts
     * - N consultas para obtener el autor de cada post
     * - N consultas para obtener los comentarios de cada post
     * Total: 1 + N + N = 1 + 2N consultas
     * 
     * CON EAGER LOADING:
     * - 1 consulta para posts
     * - 1 consulta para todos los autores
     * - 1 consulta para todos los comentarios
     * Total: 3 consultas (mucho más eficiente)
     */
    public function getAllPostsWithRelations()
    {
        // ✅ CORRECTO: Con eager loading
        $posts = Post::with(['user', 'comments.user'])
            ->latest()
            ->get();
        
        // Ahora podemos acceder a las relaciones sin consultas adicionales
        foreach ($posts as $post) {
            echo "Post: " . $post->title . "\n";
            echo "Autor: " . $post->user->name . "\n"; // No genera consulta adicional
            
            foreach ($post->comments as $comment) {
                echo "  - Comentario de " . $comment->user->name . "\n"; // No genera consulta adicional
            }
        }
        
        return $posts;
    }

    /**
     * Ejemplo 2: Obtener posts de un usuario específico con comentarios
     */
    public function getPostsByUser($userId)
    {
        $posts = Post::with(['comments.user'])
            ->where('user_id', $userId)
            ->latest()
            ->get();
        
        return $posts;
    }

    /**
     * Ejemplo 3: Obtener un post específico con todas sus relaciones
     */
    public function getSinglePostWithRelations($postId)
    {
        $post = Post::with(['user', 'comments.user'])
            ->findOrFail($postId);
        
        return $post;
    }

    /**
     * Ejemplo 4: Obtener posts con conteo de comentarios (sin cargar los comentarios)
     */
    public function getPostsWithCommentsCount()
    {
        $posts = Post::withCount('comments')
            ->with('user')
            ->latest()
            ->get();
        
        // Ahora cada post tiene la propiedad comments_count
        foreach ($posts as $post) {
            echo $post->title . " tiene " . $post->comments_count . " comentarios\n";
        }
        
        return $posts;
    }

    /**
     * Ejemplo 5: Eager loading condicional
     * Cargar solo comentarios recientes
     */
    public function getPostsWithRecentComments()
    {
        $posts = Post::with([
            'user',
            'comments' => function ($query) {
                $query->where('created_at', '>=', now()->subDays(7))
                      ->with('user')
                      ->latest();
            }
        ])->latest()->get();
        
        return $posts;
    }

    /**
     * Ejemplo 6: Obtener usuarios con sus posts y comentarios
     */
    public function getUsersWithPostsAndComments()
    {
        $users = User::with([
            'posts.comments',
            'comments.post'
        ])->get();
        
        return $users;
    }

    /**
     * Ejemplo 7: Posts paginados con eager loading
     */
    public function getPaginatedPostsWithRelations($perPage = 10)
    {
        $posts = Post::with(['user', 'comments.user'])
            ->latest()
            ->paginate($perPage);
        
        return $posts;
    }

    /**
     * Ejemplo 8: Búsqueda de posts con eager loading
     */
    public function searchPostsWithRelations($searchTerm)
    {
        $posts = Post::with(['user', 'comments.user'])
            ->where('title', 'like', "%{$searchTerm}%")
            ->orWhere('content', 'like', "%{$searchTerm}%")
            ->latest()
            ->get();
        
        return $posts;
    }

    /**
     * Ejemplo 9: Posts con comentarios ordenados
     */
    public function getPostsWithOrderedComments()
    {
        $posts = Post::with([
            'user',
            'comments' => function ($query) {
                $query->latest()->with('user');
            }
        ])->latest()->get();
        
        return $posts;
    }

    /**
     * Ejemplo 10: Lazy eager loading (cargar relaciones después)
     */
    public function lazyEagerLoading()
    {
        // Primero obtenemos los posts
        $posts = Post::all();
        
        // Luego cargamos las relaciones (útil cuando no sabemos de antemano qué necesitamos)
        $posts->load(['user', 'comments.user']);
        
        return $posts;
    }

    /**
     * COMPARACIÓN: Sin eager loading vs Con eager loading
     */
    public function comparison()
    {
        // ❌ MAL: Sin eager loading (Problema N+1)
        $postsWrong = Post::all();
        foreach ($postsWrong as $post) {
            echo $post->user->name; // Genera una consulta por cada post
            foreach ($post->comments as $comment) { // Genera una consulta por cada post
                echo $comment->user->name; // Genera una consulta por cada comentario
            }
        }
        // Si hay 10 posts con 5 comentarios cada uno:
        // 1 (posts) + 10 (users) + 10 (comments) + 50 (comment users) = 71 consultas!

        // ✅ BIEN: Con eager loading
        $postsRight = Post::with(['user', 'comments.user'])->all();
        foreach ($postsRight as $post) {
            echo $post->user->name; // No genera consulta adicional
            foreach ($post->comments as $comment) {
                echo $comment->user->name; // No genera consulta adicional
            }
        }
        // Total: 3 consultas (posts, users, comments)
    }

    /**
     * Ejemplo real usado en PostMOMController
     */
    public function controllerExample()
    {
        // Esto es lo que usa el controlador PostMOMController
        
        // Para index (listado paginado)
        $posts = Post::with(['user', 'comments.user'])
            ->latest()
            ->paginate(10);
        
        // Para show (detalle de un post)
        $post = Post::with(['user', 'comments.user'])
            ->findOrFail($id);
        
        // Ambas consultas cargan:
        // - El post
        // - El autor del post (user)
        // - Los comentarios del post (comments)
        // - Los autores de cada comentario (comments.user)
        
        // Todo en solo 3 consultas SQL optimizadas
    }
}

/**
 * VENTAJAS DEL EAGER LOADING:
 * 
 * 1. Rendimiento: Reduce drásticamente el número de consultas
 * 2. Escalabilidad: El rendimiento no se degrada con más datos
 * 3. Eficiencia: Menos carga en la base de datos
 * 4. Velocidad: Respuesta más rápida de la aplicación
 * 
 * CUÁNDO USAR EAGER LOADING:
 * 
 * - Siempre que vayas a acceder a relaciones en un loop
 * - Al mostrar listados con datos relacionados
 * - En APIs que devuelven datos relacionados
 * - En vistas que muestran información de múltiples modelos
 * 
 * SINTAXIS:
 * 
 * - Relación simple: ->with('user')
 * - Múltiples relaciones: ->with(['user', 'comments'])
 * - Relaciones anidadas: ->with('comments.user')
 * - Con condiciones: ->with(['comments' => function($q) { $q->where(...) }])
 */
