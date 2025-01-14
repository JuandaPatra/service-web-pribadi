<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShowLeadsSource;
use Illuminate\Http\Request;

class LinkTreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($linktree)
    {

        $response = [
            'data' => ShowLeadsSource::select(
                'show_leads_sources.id',
                'sources.name as source_name',
                'show_leads.name as show_lead_name',
                'show_leads.link as show_lead_link'
            )
                ->leftJoin('show_leads', 'show_leads.id', '=', 'show_leads_sources.show_lead_id')
                ->leftJoin('sources', 'sources.id', '=', 'show_leads_sources.source_id')
                ->where('sources.name', $linktree)
                ->get(),
            'status' => 'success'
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
