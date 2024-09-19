<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product as ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{	
    /**
     * List all products
     * @return json
	*/
    public function list(){
        try {
            $products= Product::order()->get(['id', 'name', 'description', 'price', 'stock']);
            $count= $products->count();           
            return response()->json([
                'success' => true, 
                'count' => $count, 
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return $this->getReturnError($e);
        }
        
    }

    /**
     * Create product
     * @return json
	*/
    public function create(ProductRequest $request){ 
        try {
            $data= $request->all();
            Product::create($data);
            return response()->json([
                'success' => true, 
                'message' => 'Producto creado con éxito'
            ]);

        } catch (\Exception $e) {
            return $this->getReturnError($e);
        }
    } 

    /**
     * Show product by id
     * @param integet $id Product ID to be consulted
     * @return json
	*/
    public function show($id){ 
        try {
            $product= Product::select(['name', 'description', 'price', 'stock'])->find($id);
            $status= true;
            $message='';
            if(!$product){
                $status= false;
                $message='No se encontró un producto con ese id';
            }
            
            return response()->json([
                'success' => $status,
                'message' => $message,
                'data' => $product
            ]);

        } catch (\Exception $e) {
            return $this->getReturnError($e);
        }
        
    }

    /**
     * Update a product by searching for it by id
     * @param integet $id Product ID to update
     * @return json
	*/
    public function update(ProductRequest $request, $id){
        try {
            $data= $request->all();
            $status= false;
            $message= 'No se encontró el producto';
            $product = Product::find($id);
            if($product){
                $product->update($data);
                $status= true;
                $message= 'Producto actualizado con éxito';
            }
            return response()->json([
                'success' => $status, 
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return $this->getReturnError($e);
        }         
    }

    /**
     * Delete product by id
     * @param integet $id Delete a product by id
     * @return json
	*/
    public function delete($id){ 
        try {
            $product= Product::find($id);
            $status= false;
            $message= 'No se encontró el producto';
            if($product){
                $status= true;
                $message= 'Producto eliminado exitósamente';
                $product->delete();
            }
            
            return response()->json([
                'success' => $status,  
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return $this->getReturnError($e);
        }        
    }

    private function getReturnError($e){
        return response()->json([
            'success' => false, 
            'message' => 'Ocurrió un error al momento de procesar la solicitud',
            'error' => __($e->getMessage()),
            'data' => 'Internal Server Error'
        ], 500);
    }
}