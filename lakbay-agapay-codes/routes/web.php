<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

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

/* Root */
Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index')->middleware('guest');

/* Google Login */
Route::get('/auth/google/redirect', [App\Http\Controllers\AuthenticationControllers\GoogleController::class, 'googleRedirect', 'middleware'=>'preventBackHistory'])->name('google.login');
Route::any('/auth/google/callback', [App\Http\Controllers\AuthenticationControllers\GoogleController::class, 'googleCallback'])->name('google.callback');

/* Facebook Login */
Route::get('facebook-login', [App\Http\Controllers\AuthenticationControllers\FacebookController::class, 'loginUsingFacebook'])->name('facebook.login');
Route::any('callback', [App\Http\Controllers\AuthenticationControllers\FacebookController::class, 'callbackFromFacebook'])->name('facebook.callback');

/* Forgot Password */
Route::get('password/forgot', [App\Http\Controllers\ForgotPasswordController::class, 'showForgotPage'])->name('password.forgot');
Route::post('password/forgot-link', [App\Http\Controllers\ForgotPasswordController::class, 'sendForgotLink'])->name('password.forgot.link');
Route::get('password/reset/{token}', [App\Http\Controllers\ForgotPasswordController::class, 'showResetPage'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\ForgotPasswordController::class, 'resetPassword'])->name('password.reset-post');

Route::group(['prefix'=>'guest', 'middleware'=>'preventBackHistory'], function(){
    /* Navigation Bar - Main */
    Route::get('/discover', [App\Http\Controllers\GuestControllers\GuestDiscoverController::class, 'index'])->name('guest.discover')->middleware('guest');
    Route::get('/discover/{id}', [App\Http\Controllers\GuestControllers\GuestDiscoverController::class, 'show'])->name('guest.discover.show')->middleware('guest');
    Route::get('/tour_operator', [App\Http\Controllers\GuestControllers\GuestTourOperatorController::class, 'index'])->name('guest.tour_operator')->middleware('guest');
    Route::get('/tour_operator/{id}', [App\Http\Controllers\GuestControllers\GuestTourOperatorController::class, 'show'])->name('guest.tour_operator.show')->middleware('guest');
    Route::get('/about', [App\Http\Controllers\GuestControllers\GuestAboutController::class, 'index'])->name('guest.about')->middleware('guest');
    Route::get('/map', [App\Http\Controllers\GuestControllers\GuestAboutController::class, 'map'])->name('guest.map');

    /* Login and Registration */
    Route::view('login', 'guest.login')->name('guest.login')->middleware('guest');
    Route::post('user_login', [App\Http\Controllers\AuthenticationControllers\LoginController::class, 'login'])->name('guest.user_login')->middleware('guest');
    Route::view('register', 'guest.register')->name('guest.register')->middleware('guest');
    Route::post('create', [App\Http\Controllers\AuthenticationControllers\RegisterController::class, 'create'])->name('guest.create')->middleware('guest');

    /* Search Functionality */
    Route::get('search-destination', [App\Http\Controllers\SearchController::class, 'searchDiscoverGuest'])->name('guest.discover.search');
    Route::get('search-tour-operator', [App\Http\Controllers\SearchController::class, 'searchTourOperatorGuest'])->name('guest.tour_operator.search');

    /* Filter Functionality */
    Route::get('filter-destination', [App\Http\Controllers\FilterController::class, 'filterDiscoverGuest'])->name('guest.discover.filter');
    Route::get('filter-tour-operator', [App\Http\Controllers\FilterController::class, 'filterTourOperatorGuest'])->name('guest.tour_operator.filter');
});

Route::group(['prefix'=>'tourist', 'middleware'=>['isTourist', 'auth', 'preventBackHistory']], function(){
    /* Navigation Bar - More*/

//    notification show
    Route::get('home', [App\Http\Controllers\UserController::class, 'index'])->name('tourist.home');
//    notification update
    Route::post('home', [App\Http\Controllers\UserController::class, 'markAllAsRead'])->name('tourist.markAllAsRead');
    Route::post('home/{id}', [App\Http\Controllers\UserController::class, 'readClickedNotification'])->name('tourist.readClickedNotification');

    /* Profile Page */
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('tourist.users.show');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('tourist.users.edit');
    Route::patch('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('tourist.users.update');

    /* Profile Page but without complete details */
    Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('tourist.profile.show');

    Route::get('favorites', [App\Http\Controllers\UserController::class])->name('tourist.favorites');
    Route::get('messages', [App\Http\Controllers\UserController::class])->name('tourist.messages');
    Route::get('add_destination', [App\Http\Controllers\AddDestinationController::class, 'index'])->name('tourist.add_destination');
    Route::post('add_destination', [App\Http\Controllers\AddDestinationController::class, 'create'])->name('tourist.create');
    Route::get('edit_destination/{id}', [App\Http\Controllers\EditDestinationController::class, 'index'])->name('tourist.edit_destination');
    Route::patch('edit_destination/{id}', [App\Http\Controllers\EditDestinationController::class, 'edit'])->name('tourist.edit');
    Route::post('logout', [App\Http\Controllers\AuthenticationControllers\LogoutController::class, 'logout'])->name('tourist.logout');

    /* Navigation Bar - Main */
    Route::get('/discover', [App\Http\Controllers\NavigationControllers\DiscoverController::class, 'index'])->name('tourist.discover');
    Route::get('/discover/{id}', [App\Http\Controllers\NavigationControllers\DiscoverController::class, 'show'])->name('tourist.discover.show');
    Route::get('/tour_operator', [App\Http\Controllers\NavigationControllers\TourOperatorController::class, 'index'])->name('tourist.tour_operator');
    Route::get('/tour_operator/{id}', [App\Http\Controllers\NavigationControllers\TourOperatorController::class, 'show'])->name('tourist.tour_operator.show');
    Route::get('/favorite_destinations', [App\Http\Controllers\NavigationControllers\ShowFavoriteDestinationsController::class, 'index'])->name('tourist.discover.favorite_destinations');
    Route::get('/favorite_tour_operators', [App\Http\Controllers\NavigationControllers\ShowFavoriteOperatorsController::class, 'index'])->name('tourist.tour_operator.favorite_tour_operators');
    Route::get('/about', [App\Http\Controllers\NavigationControllers\AboutController::class, 'index'])->name('tourist.about');
    Route::get('/map', [App\Http\Controllers\NavigationControllers\AboutController::class, 'map'])->name('tourist.map');

    /* Search Functionality */
    Route::get('search-destination', [App\Http\Controllers\SearchController::class, 'searchDiscoverTourist'])->name('tourist.discover.search');
    Route::get('search-tour-operator', [App\Http\Controllers\SearchController::class, 'searchTourOperatorTourist'])->name('tourist.tour_operator.search');

    /* Filter Functionality */
    Route::get('filter-destination', [App\Http\Controllers\FilterController::class, 'filterDiscoverTourist'])->name('tourist.discover.filter');
    Route::get('filter-tour-operator', [App\Http\Controllers\FilterController::class, 'filterTourOperatorTourist'])->name('tourist.tour_operator.filter');

    /* Leaderboard */
    Route::get('/leaderboard', [App\Http\Controllers\LeaderboardController::class, 'index'])->name('tourist.leaderboard.index');
});

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin', 'auth', 'preventBackHistory']], function(){
    /* Navigation Bar - More */
    Route::get('home/', [App\Http\Controllers\AdminControllers\AdminController::class, 'index'])->name('admin.home');
//    Most Viewed and Top Rated Destination and Tour Operator from and to filter
    Route::get('report', [App\Http\Controllers\AdminControllers\AdminController::class, 'createPDF'])->name('admin.report');

    Route::post('home/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'readClickedNotificationAdmin'])->name('admin.readClickedNotification');
    Route::post('logout', [App\Http\Controllers\AuthenticationControllers\LogoutController::class, 'logout'])->name('admin.logout');

    /* New Destination */
    Route::get('/requests/new_destination', [App\Http\Controllers\AdminControllers\AdminController::class, 'newDestinationRequest'])->name('admin.requests.new_destination.index');
    Route::get('/requests/new_destination/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showNewDestinationRequest'])->name('admin.requests.new_destination.show');
    Route::get('/new_destination/approved', [App\Http\Controllers\AdminControllers\AdminController::class, 'newDestinationRequestApproved'])->name('admin.requests.new_destination.approved.index');
    Route::get('/new_destination/approved/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showNewDestinationRequestApproved'])->name('admin.requests.new_destination.approved.show');
    Route::get('/new_destination/rejected', [App\Http\Controllers\AdminControllers\AdminController::class, 'newDestinationRequestRejected'])->name('admin.requests.new_destination.rejected.index');
    Route::get('/new_destination/rejected/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showNewDestinationRequestRejected'])->name('admin.requests.new_destination.rejected.show');

    Route::post('/new_destination/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'approveNewDestinationRequest'])->name('admin.approve.new_destination.requests');

    /* Edit Destination */
    Route::get('/requests/edit_destination', [App\Http\Controllers\AdminControllers\AdminController::class, 'editDestinationRequest'])->name('admin.requests.edit_destination.index');
    Route::get('/requests/edit_destination/{id}/{user}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showEditDestinationRequest'])->name('admin.requests.edit_destination.show');
    Route::get('/edit_destination/approved', [App\Http\Controllers\AdminControllers\AdminController::class, 'editDestinationRequestApproved'])->name('admin.requests.edit_destination.approved.index');
    Route::get('/edit_destination/approved/{id}/{user}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showEditDestinationRequestApproved'])->name('admin.requests.edit_destination.approved.show');
    Route::get('/edit_destination/rejected', [App\Http\Controllers\AdminControllers\AdminController::class, 'editDestinationRequestRejected'])->name('admin.requests.edit_destination.rejected.index');
    Route::get('/edit_destination/rejected/{id}/{user}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showEditDestinationRequestRejected'])->name('admin.requests.edit_destination.rejected.show');

    Route::post('/edit_destination/{id}/{user}', [App\Http\Controllers\AdminControllers\AdminController::class, 'approveEditDestinationRequest'])->name('admin.approve.edit_destination.requests');

    /* New Tour Operator */
    Route::get('/requests/new_tour_operator', [App\Http\Controllers\AdminControllers\AdminController::class, 'newTourOperatorRequest'])->name('admin.requests.new_tour_operator.index');
    Route::get('/requests/new_tour_operator/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showNewTourOperatorRequest'])->name('admin.requests.new_tour_operator.show');
    Route::get('/new_tour_operator/approved', [App\Http\Controllers\AdminControllers\AdminController::class, 'newTourOperatorRequestApproved'])->name('admin.requests.new_tour_operator.approved.index');
    Route::get('/new_tour_operator/approved/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showNewTourOperatorRequestApproved'])->name('admin.requests.new_tour_operator.approved.show');
    Route::get('/new_tour_operator/rejected', [App\Http\Controllers\AdminControllers\AdminController::class, 'newTourOperatorRequestRejected'])->name('admin.requests.new_tour_operator.rejected.index');
    Route::get('/new_tour_operator/rejected/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showNewTourOperatorRequestRejected'])->name('admin.requests.new_tour_operator.rejected.show');

    Route::post('/new_tour_operator/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'approveNewTourOperatorRequest'])->name('admin.approve.new_tour_operator.requests');

//  Show Users
    Route::get('/profile/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'profile'])->name('admin.profile.show');
    Route::get('users', [App\Http\Controllers\AdminControllers\AdminController::class, 'users'])->name('admin.users.index');
    Route::get('users/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showUsers'])->name('admin.users.show');
    Route::post('users/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'makeAdminUsers'])->name('admin.users.update');
    Route::get('/tourist_user', [App\Http\Controllers\AdminControllers\AdminController::class, 'touristUsers'])->name('admin.users.tourist_user.index');
    Route::get('/tourist_user/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showTouristUsers'])->name('admin.users.tourist_user.show');
    Route::get('/super_admin_user', [App\Http\Controllers\AdminControllers\AdminController::class, 'superAdminUsers'])->name('admin.users.super_admin_user.index');
    Route::get('/super_admin_user/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showSuperAdminUsers'])->name('admin.users.super_admin_user.show');
    Route::get('/admin_user', [App\Http\Controllers\AdminControllers\AdminController::class, 'adminUsers'])->name('admin.users.admin_user.index');
    Route::get('/admin_user/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showAdminUsers'])->name('admin.users.admin_user.show');
    Route::get('/tour_operator_user', [App\Http\Controllers\AdminControllers\AdminController::class, 'tourOperatorUsers'])->name('admin.users.tour_operator_user.index');
    Route::get('/tour_operator_user/{id}', [App\Http\Controllers\AdminControllers\AdminController::class, 'showTourOperatorUsers'])->name('admin.users.tour_operator_user.show');
    Route::get('manage_requests', [App\Http\Controllers\AdminControllers\AdminController::class, 'manage'])->name('admin.manage_requests');

//    Add Destination
    Route::get('add_destination', [App\Http\Controllers\AdminControllers\AdminController::class, 'addDestinationIndex'])->name('admin.add_destination.index');
    Route::post('add_destination', [App\Http\Controllers\AdminControllers\AdminController::class, 'addDestinationCreate'])->name('admin.add_destination.create');

    /* Dashboard */
    Route::get('logs', [App\Http\Controllers\AdminControllers\ActivityLogsController::class, 'index'])->name('admin.logs.index');
    Route::get('requests', [App\Http\Controllers\AdminControllers\RequestController::class, 'index'])->name('admin.requests.index');
});

/* Tour Operator */
Route::get('tour_operator', [App\Http\Controllers\ManagePageController::class, 'indexTourOpManagePage'])->name('tour_operator.index')->middleware('auth', 'preventBackHistory');
Route::get('tour_operator/{id}', [App\Http\Controllers\ManagePageController::class, 'showTourOpManagePage'])->name('tour_operator.show')->middleware('auth', 'preventBackHistory');
Route::patch('tour_operator/{id}', [App\Http\Controllers\ManagePageController::class, 'updateTourOpManagePage'])->name('tour_operator.update')->middleware('auth', 'preventBackHistory');

/* Add Tour Operator Page */
Route::get('add_tour_operator', [App\Http\Controllers\AddTourOperatorController::class, 'index'])->name('tour_operator.add_tour_operator')->middleware('auth', 'preventBackHistory');
Route::post('add_tour_operator', [App\Http\Controllers\AddTourOperatorController::class, 'create'])->name('tour_operator.create')->middleware('auth', 'preventBackHistory');

/* Owner */
Route::get('owner', [App\Http\Controllers\ManagePageController::class, 'indexOwnerManagePage'])->name('owner.index')->middleware('auth', 'preventBackHistory');
Route::get('owner/{id}', [App\Http\Controllers\ManagePageController::class, 'showOwnerManagePage'])->name('owner.show')->middleware('auth', 'preventBackHistory');
Route::patch('owner/{id}', [App\Http\Controllers\ManagePageController::class, 'updateOwnerManagePage'])->name('owner.update')->middleware('auth', 'preventBackHistory');

/* Review */
Route::match(['get', 'post'], '/add-rating', 'ReviewController@addRating')->name('add_form');

/*Favorites*/
Route::post('update_favorites', [App\Http\Controllers\FavoritesController::class, 'updateFavorites']);

/* Privacy Policy */
Route::view('/privacy_policy', 'footer.privacy_policy')->name('privacy');
