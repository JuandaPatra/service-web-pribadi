<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShowLeads;
use App\Models\ShowLeadsSource;
use App\Models\source;
use Illuminate\Http\Request;

class LinkDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = [
            'data' => ShowLeads::select('id', 'name', 'link')->get(),
            'status' => 'success'
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'source_name' => 'required',
        ]);

        Source::insert([
            'name' => $validated['source_name']
        ]);

        $response = [
            'data' => Source::select('id', 'name')->get(),
            'message' => 'success'

        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = [

            'data' => ShowLeads::select('id', 'name', 'link')
            
            ->where('id', $id)->first(),
            'status' => 'success',
            'linked' => ShowLeadsSource::where('show_lead_id', $id)->get()
        ];

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try{


            $validated = $request->validate([
                'show_lead_name' => 'required',
                'show_lead_link' => 'required',
                'source_names' => 'required|array',
            ]);

            ShowLeads::where('id', $id)->update(['link' => $validated['show_lead_link'],'name' => $validated['show_lead_name']]);
    
        
    
            $getAllLeadsSourceId = ShowLeadsSource::where('show_lead_id', $id)->pluck('id')->toArray();

            if(!empty($getAllLeadsSourceId)){
                // Hapus checklist lama untuk show_lead_id tertentu
                ShowLeadsSource::whereIn('id', $getAllLeadsSourceId)->delete();

            }
        
            // Tambahkan checklist baru
            $newChecklists = [];
            foreach ($validated['source_names'] as $sourceId){
                $newChecklists[] = [
                    'show_lead_id' => $id,
                    'source_id' => $sourceId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            ShowLeadsSource::insert($newChecklists);
        
            return response()->json([
                'message' => 'Checklist updated successfully',
                'data' =>
                [
                   'show_Lead' => ShowLeads::select('id', 
                   'name', 'link')->where('id', $id)->first(),
                   'list_source' =>  ShowLeadsSource::select('source_id', 'show_lead_id')->where('show_lead_id', $id)->get(),
                ]
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
