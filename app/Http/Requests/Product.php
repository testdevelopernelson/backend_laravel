<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class Product extends FormRequest
{  
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules= [
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required|numeric|min:0|max:99999999.99',
            'stock'         => 'required|numeric|min:0'
        ];

        return $rules;        

    }

    public function messages(){      
        return [
            'name.required'=> 'El nombre es requerido',
            'description.required'=> 'La descripción es requerida',
            'price.required'=> 'El precio es requerido',
            'price.numeric'=> 'El precio debe ser numérico',
            'price.min'=> 'El precio no puede ser menor que 0',
            'price.max'=> 'El precio no puede ser mayor que 99.999.999,99',
            'stock.required'=> 'El stock es requerido',
            'stock.numeric'=> 'El stock debe ser numérico',
            'stock.min'=> 'El stock no puede ser menor que 0',
        ];
    }  

    public function failedValidation(Validator $validator)
        {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Errores de validación ',
            'data'      => $validator->errors()
        ]));
        }
}

