<!DOCTYPE html>
<html>
<head>
    <title>Ver Producto</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 700px; 
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
        h1 { color: #333; margin-bottom: 25px; }
        .detail {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .detail p {
            margin: 12px 0;
            font-size: 15px;
        }
        .detail strong {
            color: #555;
            display: inline-block;
            width: 120px;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-warning { background-color: #ffc107; color: #000; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-danger:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalle del Producto</h1>

        <div class="detail">
            <p><strong>ID:</strong> {{ $product->id }}</p>
            <p><strong>Nombre:</strong> {{ $product->nombre }}</p>
            <p><strong>Precio:</strong> {{ number_format($product->precio, 2) }} €</p>
            <p><strong>Stock:</strong> {{ $product->stock }} unidades</p>
            <p><strong>Creado:</strong> {{ $product->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar este producto?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</body>
</html>
