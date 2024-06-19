use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/usuarios', [UsuarioController::class, 'getAllUsuarios']);
Route::get('/usuarios/active', [UsuarioController::class, 'getActiveUsuarios']);
Route::get('/usuarios/inactive', [UsuarioController::class, 'getInactiveUsuarios']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'getUsuarioById']);
Route::post('/usuarios', [UsuarioController::class, 'createUsuario']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'updateUsuario']);
Route::delete('/usuarios/{id}/delete/logical', [UsuarioController::class, 'deleteUsuarioLogico']);
Route::delete('/usuarios/{id}/delete/physical', [UsuarioController::class, 'deleteUsuarioFisico']);
