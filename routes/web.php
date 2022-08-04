<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use PHPUnit\TextUI\XmlConfiguration\Groups;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/view/{id}', [HomeController::class, 'category'])->name('category');

Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);



$obj = new stdClass();
$obj->category = [];
$id = 0;

$obj->category[] = (object) ["id" => ++$id, "name" => "Roupas", "parent" => 0]; //1
$obj->category[] = (object) ["id" => ++$id, "name" => "Celulares & Acessorios", "parent" => 0]; //2

$obj->category[] = (object) ["id" => ++$id, "name" => "Celulares ", "parent" => 2]; //3
$obj->category[] = (object) ["id" => ++$id, "name" => "Acessorios", "parent" => 2]; //4

$obj->category[] = (object) ["id" => ++$id, "name" => "Android", "parent" => 3];/*
$obj->category[] = (object) ["id"=>++$id,"name"=>"ios","parent"=>3];
$obj->category[] = (object) ["id"=>++$id,"name"=>"Xiaomi","parent"=>3];
$obj->category[] = (object) ["id"=>++$id,"name"=>"Windows Phone","parent"=>3];

$obj->category[] = (object) ["id"=>++$id,"name"=>"Samsung","parent"=>5];
$obj->category[] = (object) ["id"=>++$id,"name"=>"Motorola","parent"=>5];
$obj->category[] = (object) ["id"=>++$id,"name"=>"Apple","parent"=>5];
$obj->category[] = (object) ["id"=>++$id,"name"=>"Asus","parent"=>5];

$obj->category[] = (object) ["id"=>++$id,"name"=>"Android","parent"=>3];
$obj->category[] = (object) ["id"=>++$id,"name"=>"ios","parent"=>3];
$obj->category[] = (object) ["id"=>++$id,"name"=>"Xiaomi","parent"=>3];
$obj->category[] = (object) ["id"=>++$id,"name"=>"Windows Phone","parent"=>3];
*/
class Cat
{
    public $obj;
    public function __construct($obj){
        $this->obj = $obj;
    }
    public static function getmenu($id=0)
    {
        $return = '';
        foreach (self::$obj as $m) {
            $return .= '<li>' . $m->name . '</a>' . PHP_EOL;
            if ($m->parent > 0) {
                $return .= '<ul class="sub-menu">' . PHP_EOL;
                $return .= self::getmenu($m->parent);
                $return .= '</ul>' . PHP_EOL;
            }
            $return .= '</li>' . PHP_EOL;
        }
        return $return;
    }
}
$c = new Cat($obj->category);
echo $c->getmenu();


function cate($obj)
{
    echo "<ul>";
    foreach ($obj->category as $category) {
        if ($category->parent == 0) echo "<li>" . $category->id . " - " . $category->name . "</li>";
        echo "<ul>";

        foreach ($obj->category as $sub) {
            if ($category->parent == $sub->id) echo "<li>" . $sub->id . " - " . $sub->name . "</li>";
            echo "<ul>";

            foreach ($obj->category as $sub1) {
                if ($sub->parent == $sub1->id) echo "<li>" . $sub1->name . "</li>";
            }
            echo "</ul>";
        }
        echo "</ul>";
    }
    echo "</ul>";
}
