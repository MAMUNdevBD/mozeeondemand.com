<?php
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::redirect('/home', '/');
Route::get('/help', function(){
    $appLogo = DB::table('media')->where('custom_properties->uuid', setting('app_logo'))->first();
    if($appLogo){
        $app_logo = '/admin/main/storage/app/public/'.$appLogo->id.'/'.$appLogo->file_name;
    }else{
        $app_logo = '/images/logo.png';
    }
    return view('pages.help', [
        'app_logo' => $app_logo
    ]);
});

Route::get('/',[\App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/search',[\App\Http\Controllers\HomeController::class, 'search']);

Route::get('/restaurants',[\App\Http\Controllers\RestaurantController::class, 'index']);
Route::get('/restaurant/{restaurant:id}',[\App\Http\Controllers\RestaurantController::class, 'show']);

Route::get('/category/{category:id}',[\App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/cuisine/{cuisine:id}',[\App\Http\Controllers\CuisineController::class, 'index']);

Route::get('/foods',[\App\Http\Controllers\FoodController::class, 'index']);

Route::middleware('auth')->group(function(){    
    // return leave_review page to leave a review
    Route::get('/leave_review/{restaurant:id}',[\App\Http\Controllers\RestaurantController::class, 'leaveReview']);
    // save the review
    Route::post('/review',[\App\Http\Controllers\RestaurantController::class, 'saveReview']);
    // return leave_review page to list all the foods in your wishlist
    Route::get('/wishlist', function(){
        $appLogo = DB::table('media')->where('custom_properties->uuid', setting('app_logo'))->first();
        if($appLogo){
            $app_logo = '/admin/main/storage/app/public/'.$appLogo->id.'/'.$appLogo->file_name;
        }else{
            $app_logo = '/images/logo.png';
        }
        return view('pages.wishlist', [
            'app_logo' => $app_logo
        ]);
    });
    // get all foods in auth wishlist
    Route::get('/favorites/getFavoriteFooods/{skip}',[\App\Http\Controllers\HomeController::class, 'getFavoriteFooods']);
    //go to make order page 
    Route::get('/makeOrder',[\App\Http\Controllers\OrderController::class, 'index']);
    //post your information to confirm your order 
    Route::post('/setOrder',[\App\Http\Controllers\OrderController::class, 'store']);
    //your order is confirmed now
    Route::get('/confirmOrder ', [\App\Http\Controllers\OrderController::class, 'confirm']);
    //your order is not confirmed 
    Route::get('/NotconfirmOrder ', [\App\Http\Controllers\OrderController::class, 'orderNotconfirmed']);
    // visite your account
    Route::get('/my-account ', [\App\Http\Controllers\Auth\UserController::class, 'index']);
    // contact us page
    Route::get('/contactus', function()
    {
        $appLogo = DB::table('media')->where('custom_properties->uuid', setting('app_logo'))->first();
        if($appLogo){
            $app_logo = '/admin/main/storage/app/public/'.$appLogo->id.'/'.$appLogo->file_name;
        }else{
            $app_logo = '/images/logo.png';
        }
        return view('pages.contactus', [
            'app_logo' => $app_logo
        ]);
    });
});     

Route::get('/check', function($skip = 0) {
   $a = Restaurant::latest()
                ->take(9)
                ->skip(9 * $skip)
                ->with('cuisines')
                ->get()
                ->map
                ->format();
    dd($a);
});