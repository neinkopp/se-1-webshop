<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;

// Import all Form Request objects
use App\Http\Requests\ChangeBasketItemRequest;
use App\Http\Requests\ChangeCategoryRequest;
use App\Http\Requests\ChangeProductPicturesRequest;
use App\Http\Requests\ChangeProductRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DeleteBasketItemRequest;
use App\Http\Requests\PutInBasketRequest;

class RequestAuthTest extends TestCase
{
    /**
     * Boost coverage for ChangeBasketItemRequest validation rules
     */
    public function test_change_basket_item_request_rules()
    {
        $request = new ChangeBasketItemRequest();
        $rules = $request->rules();

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('position_id', $rules); 
        $this->assertArrayHasKey('amount', $rules); 
    }

    /**
     * Boost coverage for ChangeCategoryRequest validation rules
     */
    public function test_change_category_request_rules()
    {
        $request = new ChangeCategoryRequest();
        $rules = $request->rules(); 

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('category_id', $rules); 
        $this->assertArrayHasKey('name', $rules); 
        $this->assertArrayHasKey('filters', $rules); 
    }

    /**
     * Boost coverage for ChangeProductPicturesRequest validation rules
     */
    public function test_change_product_pictures_request_rules()
    {
        $request = new ChangeProductPicturesRequest();
        $rules = $request->rules(); 

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('handle', $rules); 
        $this->assertArrayHasKey('default_pictures.*', $rules); 
        $this->assertArrayHasKey('color_pictures.*.*', $rules); 
        $this->assertArrayHasKey('assets.*.file', $rules); 
        $this->assertArrayHasKey('assets.*.position', $rules); 
    }

    /**
     * Boost coverage for ChangeProductRequest validation rules
     */
    public function test_change_product_request_rules()
    {
        $request = new ChangeProductRequest();
        $rules = $request->rules(); 

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('name', $rules); 
        $this->assertArrayHasKey('handle', $rules); 
        $this->assertArrayHasKey('price', $rules); 
        $this->assertArrayHasKey('category_id', $rules); 
    }

    /**
     * Boost coverage for CreateCategoryRequest validation rules
     */
    public function test_create_category_request_rules()
    {
        $request = new CreateCategoryRequest();
        $rules = $request->rules(); 

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('name', $rules); 
        $this->assertArrayHasKey('filters', $rules); 
    }

    /**
     * Boost coverage for CreateProductRequest validation rules
     */
    public function test_create_product_request_rules()
    {
        $request = new CreateProductRequest();
        $rules = $request->rules(); 

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('name', $rules); 
        $this->assertArrayHasKey('handle', $rules); 
        $this->assertArrayHasKey('price', $rules); 
        $this->assertArrayHasKey('supplier_name', $rules);
    }

    /**
     * Boost coverage for DeleteBasketItemRequest validation rules
     */
    public function test_delete_basket_item_request_rules()
    {
        $request = new DeleteBasketItemRequest();
        $rules = $request->rules(); 

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('position_id', $rules);
    }

    /**
     * Boost coverage for PutInBasketRequest validation rules
     */
    public function test_put_in_basket_request_rules()
    {
        $request = new PutInBasketRequest();
        $rules = $request->rules(); 

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('productHandle', $rules);
        $this->assertArrayHasKey('amount', $rules);
    }
}