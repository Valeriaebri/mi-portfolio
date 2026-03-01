<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthClienteController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// Home → catálogo
Route::get('/', function () {
    $productos = Producto::where('activo', 1)->paginate(12);
    return view('tienda.index', compact('productos'));
});

// Tienda
Route::get('/tienda', function () {
    $productos = Producto::where('activo', 1)->paginate(12);
    return view('tienda.index', compact('productos'));
});

// Ficha producto
Route::get('/producto/{slug}', function ($slug) {
    $producto = Producto::where('slug', $slug)->firstOrFail();
    return view('producto.ficha', compact('producto'));
});

// Categorías públicas
Route::get('/categorias-publico', function () {
    $categorias = \App\Models\Categoria::where('activo', 1)->get();
    return view('categorias.index', compact('categorias'));
});

// Productos por categoría
Route::get('/categoria/{slug}', function ($slug) {
    $categoria = \App\Models\Categoria::where('slug', $slug)->firstOrFail();
    $productos = $categoria->productos()->where('activo', 1)->paginate(12);
    return view('categorias.listado', compact('categoria', 'productos'));
});

// Productos general

Route::get('/productos', function () {
    $productos = App\Models\Producto::all();
    return view('productos.general', compact('productos'));
});


// Quiénes somos
Route::get('/quienessomos', function () {
    return view('quienessomos.conocenos');
});
// Categoria cliente index
Route::get('/categorias_user', function () {
    return view('categorias_user.index');
});
// opiniones cliente index
Route::get('/opiniones', function () {
    return view('opiniones.index');
});
// carrito index cliente
Route::get('/carrito', function () {
    return view('carrito.index');
});





/*
|--------------------------------------------------------------------------
| LOGIN / REGISTRO CLIENTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthClienteController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthClienteController::class, 'login']);

Route::get('/register', [AuthClienteController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthClienteController::class, 'register']);

Route::post('/logout', [AuthClienteController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| CARRITO FUNCIONAL
|--------------------------------------------------------------------------
*/

Route::get('/carrito/add/{id}', [CarritoController::class, 'add']);
Route::get('/carrito/delete/{id}', [CarritoController::class, 'delete']);
Route::post('/carrito/update', [CarritoController::class, 'update']);


/*
|--------------------------------------------------------------------------
| PEDIDOS (SOLO CLIENTES LOGUEADOS)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos');
    Route::get('/pedidos/crear', [PedidoController::class, 'crearPedido']);
    Route::get('/pedidos/detalle/{id}', [PedidoController::class, 'detalle']);
});


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| RUTAS ADMIN (SOLO ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard (SIN AdminController)
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN - CATEGORÍAS
    |--------------------------------------------------------------------------
    */
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('admin.categorias');
    Route::get('/categorias/create', [CategoriaController::class, 'create']);
    Route::post('/categorias/save', [CategoriaController::class, 'save']);
    Route::get('/categorias/edit/{id}', [CategoriaController::class, 'edit']);
    Route::post('/categorias/update', [CategoriaController::class, 'update']);
    Route::get('/categorias/delete/{id}', [CategoriaController::class, 'delete']);

    /*
    |--------------------------------------------------------------------------
    | ADMIN - PRODUCTOS (TUS RUTAS ORIGINALES)
    |--------------------------------------------------------------------------
    */
    Route::get('/productos', [ProductoController::class, 'index'])->name('admin.productos');
    Route::get('/productos/create', [ProductoController::class, 'create']);
    Route::post('/productos/save', [ProductoController::class, 'save']);
    Route::get('/productos/edit/{id}', [ProductoController::class, 'edit']);
    Route::post('/productos/update', [ProductoController::class, 'update']);
    Route::get('/productos/delete/{id}', [ProductoController::class, 'delete']);

    /*
    |--------------------------------------------------------------------------
    | ADMIN - PEDIDOS
    |--------------------------------------------------------------------------
    */
    Route::get('/pedidos', [PedidoController::class, 'adminIndex'])->name('admin.pedidos');
    Route::get('/pedidos/detalle/{id}', [PedidoController::class, 'adminDetalle']);
});



