<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConversionResource;
use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 

class ConversionController extends Controller
{
    public function index(){
        $conversion = Conversion::get();
        if($conversion->count() > 0){
            return ConversionResource::collection($conversion);
        }
        else{
            return response()->json(['message' => 'No records available'], 200);
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'type' => 'required|string',
            'unit' => 'required|numeric'
        
        ]);
        
        if($validator->fails()){
            return response()->json([
                'message' => 'All fields are mandatory',
                'error' => $validator->messages(),
            ], 422);
        }

        $conversion = Conversion::where('type', $request->type)->first();

         if ($conversion) {
            $conversion->update([
                'unit' => $request->unit,
            ]);

            return response()->json([
                'message' => 'Type Updated Successfully',
                'data' => new ConversionResource($conversion)
            ], 200);
        }
        else{
            $conversion = Conversion::create([
                'type' => $request->type,
                'unit' => $request->unit,
            ]);
    
            return response()->json([
                'message' => '  Type Created Succesfully',
                'data' => new ConversionResource($conversion)
            ], 200);
        }



        
    }
    
    public function destroy(Conversion $conversion){
        $conversion->delete();
        return response()->json([
            'message' => '  Type Deleted Succesfully',
        ], 200);
    }
    public function show(Conversion $conversion){
        return new ConversionResource($conversion);
    }
    public function getConversion(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Type and amount fields are mandatory',
                'error' => $validator->messages(),
            ], 422);
        }

        $conversion = Conversion::where('type', $request->type)->first();

        if(!$conversion){
            return response()->json([
                'message' => 'Conversion type not found',
            ], 404);
        }

        $result = $conversion->unit * $request->amount;
        $current = 'TL';
        $mes = (string) $request->amount . ' ' . (string) $conversion->type . ' = ' . (string) $result . $current;
        return response()->json([
            'message' => $mes,
            

            
        ], 200);
    }
}
