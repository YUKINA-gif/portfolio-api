<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PortfoliosController;
use App\Http\Controllers\SkillsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/contact", [ContactsController::class, "sendMail"]);
Route::get("/portfolio", [PortfoliosController::class, "get"]);
Route::post("/portfolio", [PortfoliosController::class, "post"]);
Route::post("/portfolio/image",[PortfoliosController::class, "store_image_update"]);
Route::get("/skill", [SkillsController::class, "get"]);
Route::post("/skill", [SkillsController::class, "post"]);
