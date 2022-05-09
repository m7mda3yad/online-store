<?php
namespace Tests\Unit;
use App\Http\Controllers\Admin\CategoriesController;
use PHPUnit\Framework\TestCase;
class CategoryTest extends TestCase
{

    public function test_store()
    {
        $data =CategoriesController::store(['name'=>'']);
        $this->assertTrue($data);
    }
}
