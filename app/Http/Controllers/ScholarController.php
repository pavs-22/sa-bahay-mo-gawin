<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholar;
use App\Models\ScholarType;
use App\Models\Institution;

class ScholarController extends Controller
{
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
    public function addDisbursementDate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1900|max:2100',
            'scholar_id' => 'required|exists:scholars,id',
        ]);

        // Create a new disbursement date entry
        DisbursementDate::create([
            'month' => $request->input('month'),
            'year' => $request->input('year'),
            'scholar_id' => $request->input('scholar_id'),
        ]);

        // Return a response
        return response()->json(['message' => 'Disbursement date added successfully'], 200);
    }

    public function disbursement()
    {
        $institutions = Institution::all();
        $ScholarType = ScholarType::all();
        return view('scholar.disbursement', ['institutions' => $institutions], ['ScholarType' => $ScholarType]);
   
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

    public function fetchHighSchool(Request $request)
{
    $searchValue = $request->input('search.value');
    $start = $request->input('start');
    $length = $request->input('length');
    $page = $request->input('draw');

    $query = Scholar::query()
        ->where('account', true)
        ->whereIn('year_level', ['GRADE 7','GRADE 8','GRADE 9','GRADE 10']) // Use whereIn instead of where
        ->when($searchValue, function ($query, $searchValue) {
            return $query->where(function ($query) use ($searchValue) {
                $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
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



    public function fetchSeniorHigh(Request $request)
    {
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $page = $request->input('draw');

        $query = Scholar::query()
            ->where('account', true)
            ->whereIn('year_level', ['GRADE 11','GRADE 12'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                    ->orWhere('unit', 'like', "%{$searchValue}%")
                    ->orWhere('area', 'like', "%{$searchValue}%")
                    ->orWhere('fullname', 'like', "%{$searchValue}%")
                    ->orWhere('batch', 'like', "%{$searchValue}%")
                    ->orWhere('name_of_member', 'like', "%{$searchValue}%")
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
            ->whereIn('year_level', ['FIRST YEAR', 'SECOND YEAR', 'THIRD YEAR', 'FOURTH YEAR', 'FIFTH YEAR'])
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where(function ($query) use ($searchValue) {
                    $query->Where('institution', 'like', "%{$searchValue}%")
                        ->orWhere('unit', 'like', "%{$searchValue}%")
                        ->orWhere('area', 'like', "%{$searchValue}%")
                        ->orWhere('fullname', 'like', "%{$searchValue}%")
                        ->orWhere('batch', 'like', "%{$searchValue}%")
                        ->orWhere('name_of_member', 'like', "%{$searchValue}%")
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
        $scholar = Scholar::findOrFail($id);
        return view('scholar.info', ['scholar' => $scholar]);
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
            ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-BAY', 'SENIOR HIGH CMDI-TAGUM','SENIOR HIGH SCHOOL REGULAR'])
            ->count();
    
        $highSchool = Scholar::where('account', true)
            ->whereIn('scholarship_type', ['REGULAR HIGH SCHOOL'])
            ->count();
    
        $college = Scholar::where('account', true)
            ->whereIn('year_level', ['FIRST YEAR', 'SECOND YEAR', 'THIRD YEAR', 'FOURTH YEAR', 'FIFTH YEAR'])
            ->count();

            $special = Scholar::where('account', true)
            ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP- COLLEGE', 'SPECIAL SCHOLARSHIP- ELEM', 'SPECIAL SCHOLARSHIP- HS', 'SPECIAL SCHOLARSHIP-DOCTORATE', 'FORBES','CAMIA','BROKENSHIRE'])
            ->count();           
    
        // Pass all counts to the view
        return view('scholar.index', compact('totalScholars', 'seniorHigh', 'highSchool', 'college'));
    }
    
  

}
