<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholar;
use App\Models\ScholarType;
use App\Models\Institution;
use App\Models\Disbursement;

class ScholarController extends Controller
{

   
    public function storeDisbursement(Request $request)
    {
        // Fetch scholar code based on Scholar_id
        $scholar = Scholar::findOrFail($request->input('Scholar_id'));
        $scholarCode = $scholar->scholar_code;
        $institution = $scholar->institution;
        $unit = $scholar->unit;
        $area = $scholar->area;
        $scholar_name = $scholar->fullname;
        $batch = $scholar->batch;
        $scholarship_type = $scholar->scholarship_type;
        $year_level = $scholar->year_level;
        $status = $scholar->status;
        $account = $scholar->account;


    
        // Validate request data
        $data = $request->validate([
           
            'Date' => 'required', 
            'Date_memo' => 'required',
            'MemoNumber' => 'required|string',
            'amount' => 'required|numeric',
            'return_cmdi' => 'required|numeric',
            'disbursement_remarks' => 'nullable|string',
        ]);
    
        // Add the fetched scholar_code to the data array
        $data['Scholar_code'] = $scholarCode;
        $data['institution'] = $institution;
        $data['unit'] = $unit;
        $data['area'] = $area;
        $data['scholar_name'] = $scholar_name;
        $data['batch'] = $batch;
        $data['scholarship_type'] = $scholarship_type;
        $data['year_level'] = $year_level;
        $data['status'] = $status;
        $data['account'] = $account; // Make sure to use correct case here
    
        // Create new Disbursement record
        $newDisbursement = Disbursement::create($data);
    
        return redirect()->back()->with('success', 'Disbursement saved successfully!');
    }
    
    




    // Returns scholar dashboard
    public function index()
    {   $user = Auth::user();
        return view('scholar.index');
    }

    // Returns list of scholars
    public function list()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
    
        return view('scholar.list', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
       
    }

    public function fetchDisbursements(Request $request)
    {
      
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');

        $query = Disbursement::query()
            ->where('account', true)
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('scholar_name', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('institution', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
                        ->orWhere('course', 'like', "%{$searchValue}%")
                        ->orWhere('Date', 'like', "%{$searchValue}%")
                        ->orWhere('Date_memo', 'like', "%{$searchValue}%")
                        ->orWhere('MemoNumber', 'like', "%{$searchValue}%")
                        ->orWhere('created_at', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy('created_at', 'asc');

        if ($searchValue) {
            $page = 1;
        }

        $data = $query->paginate($length, ['*'], 'page', $page);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    
       
    }
    

    public function disbursement()
    {
       
        return view('scholar.disbursement');
   
    }


    
    public function college()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
        return view('scholar/scholartype.college', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
    }
    public function highSchool()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
        return view('scholar/scholartype.highschool', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
    }
    public function seniorHigh()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
        return view('scholar/scholartype.seniorhigh', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
    }

    public function special()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
        return view('scholar/scholartype.special', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
    }

    public function behighschool()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
        return view('scholar/scholartype.behighschool', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
    }

    public function becollege()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
        return view('scholar/scholartype.becollege', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
    }

    public function dshpcollege()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
        return view('scholar/scholartype.dshpcollege', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
    }

    public function csp2()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
        return view('scholar/scholartype.csp2', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
    }

    public function fetchPaginate(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');

        $query = Scholar::query()
            ->where('account', true)
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
                        ->orWhere('course', 'like', "%{$searchValue}%")
                        ->orWhere('created_at', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy('created_at', 'desc');

        if ($searchValue) {
            $page = 1;
        }

        $data = $query->paginate($length, ['*'], 'page', $page);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    }

   



    public function fetchSeniorHigh(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');

        $query = Scholar::query()
            ->where('account', true)
            ->whereIn('scholarship_type', ['REGULAR SENIOR HIGH SCHOOL', 'SENIOR HIGH CMDI-TAGUM','SENIOR HIGH CMDI-BAY','DSHP SENIOR HIGH- CMDI BAY'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                    ->orWhere('unit', 'like', "%{$searchValue}%")
                    ->orWhere('area', 'like', "%{$searchValue}%")
                    ->orWhere('fullname', 'like', "%{$searchValue}%")
                    ->orWhere('batch', 'like', "%{$searchValue}%")
                    ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                    ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                    ->orWhere('year_level', 'like', "%{$searchValue}%")
                    ->orWhere('status', 'like', "%{$searchValue}%")
                    ->orWhere('created_at', 'like', "%{$searchValue}%")
                    ->orWhere('course', 'like', "%{$searchValue}%");
                });
                
            })
            ->orderBy('created_at', 'desc');

        if ($searchValue) {
            $page = 1;
        }

        $data = $query->paginate($length, ['*'], 'page', $page);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    }


   
    public function fetchCollege(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');
    
        $query = Scholar::query()
            ->where('account', true)
            ->whereIn('scholarship_type', ['REGULAR COLLEGE', 'REGULAR COLLEGE - FULL', 'REGULAR COLLEGE - HALF', 'IP-COLLEGE'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
                        ->orWhere('course', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy('created_at', 'desc'); // Sort by 'created_at' column in descending order
    
        if ($searchValue) {
            $page = 1;
        }
    
        $data = $query->paginate($length, ['*'], 'page', $page);
    
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    }
    

    public function fetchBEHighSchool(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');
    
        $query = Scholar::query()
            ->where('account', true)
            ->whereIn('scholarship_type', ['BALIK ESKWELA - HIGH SCHOOL', 'BALIK ESKWELA HIGH SCHOOL IP'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
                        ->orWhere('course', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy('created_at', 'desc'); // Sort by 'created_at' column in descending order
    
        if ($searchValue) {
            $page = 1;
        }
    
        $data = $query->paginate($length, ['*'], 'page', $page);
    
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    }



    public function fetchBECollege(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');
    
        $query = Scholar::query()
            ->where('account', true)
            ->whereIn('scholarship_type', ['BALIK ESKWELA - COLLEGE', 'BALIK ESKWELA - COLLEGE IP'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
                        ->orWhere('course', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy('created_at', 'desc'); // Sort by 'created_at' column in descending order
    
        if ($searchValue) {
            $page = 1;
        }
    
        $data = $query->paginate($length, ['*'], 'page', $page);
    
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    }
    public function fetchDSHPCollege(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');
    
        $query = Scholar::query()
            ->where('account', true)
            ->whereIn('scholarship_type', ['DSHP COLLEGE', 'DSHP COLLEGE- CMDI BAY', 'DSHP COLLEGE- LUZVIMIN', 'DSHP- ANIHAN', 'DSHP- DUAL TECH','COLLEGE CMDI-BAY'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
                        ->orWhere('course', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy('created_at', 'desc'); // Sort by 'created_at' column in descending order
    
        if ($searchValue) {
            $page = 1;
        }
    
        $data = $query->paginate($length, ['*'], 'page', $page);
    
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    }

    public function fetchHighSchool(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');
    
        $query = Scholar::query()
            ->where('account', true)
            ->whereIn('scholarship_type', ['REGULAR HIGH SCHOOL','IP HS-LUZON','IP HS-VIZMIN'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
                        ->orWhere('course', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy('created_at', 'desc'); // Sort by 'created_at' column in descending order
    
        if ($searchValue) {
            $page = 1;
        }
    
        $data = $query->paginate($length, ['*'], 'page', $page);
    
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    }
   
    public function fetchSpecial(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');
    
        $query = Scholar::query()
            ->where('account', true)
            ->whereIn('scholarship_type', ['FORBES', 'BROKENSHIRE', 'CAMIA', 'SPECIAL SCHOLARSHIP - COLLEGE', 'SPECIAL SCHOLARSHIP - HS','SPECIAL SCHOLARSHIP- ELEM','SPECIAL SCHOLARSHIP-DOCTORATE','MBA','SPECIAL SCHOLARSHIP','SPECIAL SCHOLARSHIP-SCHOLASTIC'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
                        ->orWhere('course', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy('created_at', 'desc'); // Sort by 'created_at' column in descending order
    
        if ($searchValue) {
            $page = 1;
        }
    
        $data = $query->paginate($length, ['*'], 'page', $page);
    
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    }
    public function fetchCSP2(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');
    
        $query = Scholar::query()
            ->where('account', true)
            ->whereIn('scholarship_type', ['CSP 2','CSP2'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
                        ->orWhere('course', 'like', "%{$searchValue}%");
                });
            })
            ->orderBy('created_at', 'desc'); // Sort by 'created_at' column in descending order
    
        if ($searchValue) {
            $page = 1;
        }
    
        $data = $query->paginate($length, ['*'], 'page', $page);
    
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $data->items(),
        ]);
    }

    public function create()
    {
        return view('scholar.create');
    }
   
    protected function generateScholarCode() {
        // Fetch the last scholar code from the database
        $lastScholar = Scholar::where('scholar_code', 'like', 'CSP-%')->orderBy('id', 'desc')->first();
    
        if ($lastScholar) {
            // Ensure that the last scholar code is not null
            if ($lastScholar->scholar_code !== null) {
                // Extract the numeric part after 'CSP-' and increment it
                $lastNumber = (int)substr($lastScholar->scholar_code, 4);
                $newNumber = $lastNumber + 1;
    
                // Construct the new scholar code with the incremented number
                return 'CSP-' . $newNumber;
            } else {
                // Log or handle the case where the scholar code is null
                // This might indicate a data inconsistency or unexpected condition
            }
        }
    
        // If no scholars exist yet or the scholar code is null, start with 'CSP-1'
        return 'CSP-1';
    }
    
    
        
        
    
        // Store method
        public function store(Request $request){
            $newScholarCode = $this->generateScholarCode();
            
            $data = $request->validate([
                'institution' => 'nullable',
                'unit' => 'nullable',
                'area' => 'nullable',
                'fullname' => 'nullable',
                'name_of_member' => 'nullable',
                'batch' => 'nullable',
                'scholarship_type' => 'nullable',
                'year_level' => 'nullable',
                'course' => 'nullable',
                'contact' => 'nullable',
                'address' => 'nullable',
                'status' => 'nullable',
                'remarks' => 'nullable',
            ]);
    
            // Set default values for each field if they are not provided
            $defaults = [
                'institution' => ' ',
                'unit' => ' ',
                'area' => ' ',
                'fullname' => ' ',
                'name_of_member' => ' ',
                'batch' => ' ',
                'scholarship_type' => ' ',
                'year_level' => ' ',
                'course' => ' ',
                'contact' => '0',
                'address' => ' ',
                'status' => ' ',
                'remarks' => ' ',
            ];
    
            foreach ($defaults as $key => $default) {
                if (empty($data[$key])) {
                    $data[$key] = $default;
                }
            }
        
            $data['scholar_code'] = $newScholarCode; // Assign the generated Scholar_Code
            $data['account'] = true; // Assuming this is intended to mark the Scholar as having an account
    
            $newScholar = Scholar::create($data);
    
            // Redirect with success message
            return redirect(route('scholar.list'))->with('success', 'Scholar created successfully');
        }
    
        public function show($id)
        {
            // Fetch the scholar by ID
            $scholar = Scholar::findOrFail($id);
            
            // Fetch disbursements data for the scholar
            $disbursements = Disbursement::where('Scholar_code', $scholar->scholar_code)->get();
        
            // Pass both scholar and disbursements data to the view
            return view('scholar.info', compact('scholar', 'disbursements'));
        }
        

    public function softDelete($id)
    {
        $scholar = Scholar::findOrFail($id);
        $scholar->update(['account' => false]);

        return response()->json(['message' => 'Record soft deleted successfully']);
    }
    

    public function Delete($id)
{
    $scholar = Scholar::find($id);
    if (!$scholar) {
        return redirect()->route('scholar.list')->with('error', 'Scholar not found.');
    }

    // Update the account value to false
    $scholar->update(['account' => false]);

    return redirect()->route('scholar.list')->with('success', 'Scholar deleted successfully.');
}

public function edit($id)
{
    $scholar = Scholar::findOrFail($id);
    $institutions = Institution::all();
    $ScholarType = ScholarType::all();
    
    // Consolidate your data into a single array
    return view('scholar.edit', [
        'scholar' => $scholar,
        'institutions' => $institutions,
        'ScholarType' => $ScholarType,
    ]);
}

public function update(Request $request, $id)
{
    $scholar = Scholar::findOrFail($id);
    
    // Prepare the data, converting empty strings to null
    $data = array_map(function($item) {
        return $item === '' ? null : $item;
    }, $request->all());
    
    // Specifically handle each column to ensure it's not null
    $columnsToCheck = [ 'institution',
    'unit',
    'area',
    'fullname',
    'name_of_member',
    'batch',
    'scholarship_type',
    'year_level',
    'course',
    'contact' ,
    'address',
    'status',
    'remarks']; // Add other columns here
    foreach ($columnsToCheck as $column) {
        if (array_key_exists($column, $data) && $data[$column] === null) {
            $data[$column] = ''; // Or set it to a default value if appropriate
        }
    }

    // Update the scholar with the prepared data
    $scholar->update($data);
 
    return redirect()->route('scholar.list')->with('success', 'Scholar updated successfully.');
}



    public function profileUpdate(Request $request, $id)
    {
        $scholar = Scholar::findOrFail($id);
        $scholar->update($request->all());

        return redirect()->route('scholar.list')->with('success', 'Scholar updated successfully.');
    }

    public function dashboard()
    {
        $totalScholars = Scholar::where('account', true)->count();
    
        // Add more queries here as needed for other data
        $seniorHigh = Scholar::where('account', true)
            ->whereIn('scholarship_type', ['REGULAR SENIOR HIGH SCHOOL', 'SENIOR HIGH CMDI-TAGUM','SENIOR HIGH CMDI-BAY','DSHP SENIOR HIGH- CMDI BAY'])
            ->count();
    
        $highSchool = Scholar::where('account', true)
            ->whereIn('scholarship_type', ['REGULAR HIGH SCHOOL','IP HS-LUZON','IP HS-VIZMIN'])
            ->count();
    
        $college = Scholar::where('account', true)
            ->whereIn('scholarship_type', ['REGULAR COLLEGE', 'REGULAR COLLEGE - FULL', 'REGULAR COLLEGE - HALF', 'IP-COLLEGE'])
            ->count();

        $special = Scholar::where('account', true)
         ->whereIn('scholarship_type', ['FORBES', 'BROKENSHIRE', 'CAMIA', 'SPECIAL SCHOLARSHIP - COLLEGE', 'SPECIAL SCHOLARSHIP - HS','SPECIAL SCHOLARSHIP- ELEM','SPECIAL SCHOLARSHIP-DOCTORATE','MBA','SPECIAL SCHOLARSHIP','SPECIAL SCHOLARSHIP-SCHOLASTIC'])
        ->count();        

        $BECollege = Scholar::where('account', true)
         ->whereIn('scholarship_type', ['BALIK ESKWELA - COLLEGE', 'BALIK ESKWELA - COLLEGE IP'])
        ->count();      
        $BEHighschool = Scholar::where('account', true)
         ->whereIn('scholarship_type', ['BALIK ESKWELA - HIGH SCHOOL', 'BALIK ESKWELA HIGH SCHOOL IP'])
        ->count();   
        $DSHP = Scholar::where('account', true)
         ->whereIn('scholarship_type', ['DSHP COLLEGE', 'DSHP COLLEGE- CMDI BAY', 'DSHP COLLEGE- LUZVIMIN', 'DSHP- ANIHAN', 'DSHP- DUAL TECH','COLLEGE CMDI-BAY'])
        ->count();   
        $CSP2 = Scholar::where('account', true)
         ->whereIn('scholarship_type', ['CSP 2'])
        ->count();   
    
        // Pass all counts to the view
        return view('scholar.index', compact('totalScholars', 'seniorHigh', 'highSchool', 'college','special', 'BECollege', 'BEHighschool','DSHP','CSP2'));
    }
    
  

}
