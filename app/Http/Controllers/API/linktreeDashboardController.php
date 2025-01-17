<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShowLeads;
use App\Models\ShowLeadsSource;
use Illuminate\Http\Request;

class linktreeDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required',
            'link'       => 'required'
        ]);

        ShowLeads::insert($validated);

        return response()->json([
            'messages' => 'Success'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        if (!preg_match('/^\d+$/', $id)) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        
        try {
            $data       = ShowLeads::where('id', '=', $id)->first();
            if(!$data){
                return response()->json(['message' => 'Data not found'], 404);
            }
            $listData   = ShowLeadsSource::select('id', 'source_id')->where('show_lead_id', '=', $id)->get();
            
            $response = [
                'data'      => $data,
                'message'   => 'Success' ,
                'sosmed' => $listData 
            ];
    
            return response()->json($response, 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'       => 'required',
            'link'       => 'required'
        ]);

       $template =  ShowLeads::where('id', '=', $id)->first();

       $template->update($validated);

       $response = [
        'data' => ShowLeads::where('id', '=', $id)->first(),
        'message' => 'Success'
       ];

       return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         ShowLeads::where('id', '=', $id)->delete();

         $response = [
            'message' => 'data deleted'
         ];

         return response()->json($response, 200);

    }
}
