<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auto\{StoreRequest, UpdateRequest};
use App\Models\Auto;
use App\Models\Marka;
use App\Models\Motors;
use App\Models\Piedzina;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AutoExport;
use Illuminate\Support\Facades\Crypt;


class AutoController extends Controller
{
    /**
     * Export the resource.
     */
    public function export()
    {
        return Excel::download(new AutoExport, 'autos.xlsx');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auto::query();

        // Adjust relationships as necessary
        $query->with(['marka', 'motors', 'piedzina']);

        // Apply filters if they are set
        if ($request->input('filters.autonr')) {
            $query->where('autonr', 'like', '%' . $request->input('filters.autonr') . '%');
        }
        if ($request->input('filters.autogads')) {
            $query->where('autogads', '=', $request->input('filters.autogads'));
        }
        if ($request->input('filters.marka')) {
            // Assuming 'marka' is a relationship method on your Auto model
            $query->whereHas('marka', function ($q) use ($request) {
                $q->where('nosaukums', $request->input('filters.marka'));
            });
        }

        // Apply sorting if it is set
        $sortKey = $request->input('sortKey', 'created_at'); // Default sort key
        $sortOrder = $request->input('sortOrder', 'desc'); // Default sort order

        // Ensure the sort key is a valid column name to prevent SQL injection
        if ($sortKey == 'marka_id') {
            $query->join('marka', 'auto.marka_id', '=', 'marka.marka_id')
                ->orderBy('marka.nosaukums', $sortOrder);
        } elseif ($sortKey == 'motors_id') {
            $query->join('motors', 'auto.motors_id', '=', 'motors.motors_id')
                ->orderBy('motors.nosaukums', $sortOrder);
        } elseif ($sortKey == 'piedzina_id') {
            $query->join('piedzina', 'auto.piedzina_id', '=', 'piedzina.piedzina_id')
                ->orderBy('piedzina.nosaukums', $sortOrder);
        } else {
            // Ensure the sort key is a valid column name to prevent SQL injection
            $validSortKeys = ['autonr', 'autogads', 'motoratilpums', 'pilnamasa', 'pasmasa', 'created_at'];
            if (in_array($sortKey, $validSortKeys)) {
                $query->orderBy($sortKey, $sortOrder);
            }
        }

        // Paginate the results
        $auto = $query->paginate(30);

        $markas = Marka::all();

        // Return the Inertia response
        return Inertia::render('Auto/Index', [
            'auto' => $auto,
            'markas' => $markas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $markas = Marka::all();
        $motors = Motors::all();
        $piedzinas = Piedzina::all();

        return Inertia::render('Auto/Create', [
            'markas' => $markas,
            'motors' => $motors,
            'piedzinas' => $piedzinas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if (isset($data['motoratilpums'])) {
            $data['motoratilpums'] = $data['motoratilpums'] * 1000;
        }

        if (isset($data['autonr'])) {
            $data['autonr'] = strtoupper($data['autonr']);
        }

        $auto = Auto::create($data);

        return redirect()->route('auto.index')->with('success', 'Auto created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auto $auto)
    {
        // Convert the engine displacement back to its original state
        if (isset($auto->motoratilpums)) {
            $auto->motoratilpums = $auto->motoratilpums / 1000;
        }

        $markas = Marka::all();
        $motors = Motors::all();
        $piedzinas = Piedzina::all();

        return Inertia::render('Auto/Edit', [
            'auto' => $auto,
            'markas' => $markas,
            'motors' => $motors,
            'piedzinas' => $piedzinas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Auto $auto)
    {
        $data = $request->validated();

        if (isset($data['motoratilpums'])) {
            $data['motoratilpums'] = $data['motoratilpums'] * 1000;
        }

        if (isset($data['autonr'])) {
            $data['autonr'] = strtoupper($data['autonr']);
        }

        $auto->update($data);
        return redirect()->route('auto.index')->with('success', 'Auto updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auto $auto)
    {
        $auto->delete();
        return redirect()->route('auto.index')->with('success', 'Auto deleted successfully.');
    }
}
