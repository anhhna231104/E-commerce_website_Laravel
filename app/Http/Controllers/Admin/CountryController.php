<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCountryRequest;
use App\Models\Admin\Country;
use Auth;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     */

    public function index()
    {
        $data = Country::all();
        $id_country = Auth::user()->id_country;
        return view('admin.country.country', compact('data', 'id_country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('admin.country.add.add-country');
    }

    public function create(AddCountryRequest $request)
    {
        $data = $request->all();
        var_dump($data);
        if (Country::create($data)) {
            return redirect()->back()->with('success', _('Add country successfully'));
        } else {
            return redirect()->back()->withErrors('Add country failed.');
        }
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Country::where('id_country', $id)->get()->first();
        return view('admin.country.edit.edit-country', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddCountryRequest $request, string $id)
    {
        $country = Country::findOrFail($id, ['id_country']);

        $data = $request->all();

        if ($country->update($data)) {
            return redirect()->back()->with('success', _('Edit country successfully.'));
        } else {
            return redirect()->back()->withErrors('Edit country failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Country::destroy($id)) {
            return redirect()->back()->with('success', _('Delete country successfully.'));
        } else {
            return redirect()->back()->withErrors('Delete country failed.');
        }
    }
}
