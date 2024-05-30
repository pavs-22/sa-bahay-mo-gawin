<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholar;
use App\Models\ScholarType;
use App\Models\Institution;
use App\Models\Disbursement;

class ScholarController extends Controller
{

   
        public function generateScholarTableImage($scholarId)
        {
            // Fetch the scholar data from the database
            $scholar = Scholar::find($scholarId);
    
            // Render the view with the scholar data
            $html = view('scholar.info', compact('scholar'))->render();
    
            // Define the file path for the screenshot
            $filePath = public_path('images/scholar_table.png');
    
            // Use Browsershot to capture the specific table element
            Browsershot::html($html)
                ->setOption('args', ['--no-sandbox'])  // Required for some environments
                ->selectElement('#report') // Use the class or ID of the specific table
                ->save($filePath);
    
            // Return the file path
            return response()->json(['file' => asset('images/scholar_table.png')]);
        }
    
    
    public function addDisbursement($id)
{
    return view('scholar.Disbursement.addDisbursement', ['id' => $id]);
}

public function DisbursementAdd(Request $request)
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

    
    // Redirect with success message
    return redirect()->route('scholar.info', ['id' => $request->input('Scholar_id')])->with('success', 'Scholar created successfully');
}
   
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
                        ->orWhere('scholarship_type', 'like', "%{$searchValue}%")
                        ->orWhere('year_level', 'like', "%{$searchValue}%")
                        ->orWhere('status', 'like', "%{$searchValue}%")
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
            ->whereIn('scholarship_type', ['FORBES', 'BROKENSHIRE', 'CAMIA', 'SPECIAL SCHOLARSHIP - COLLEGE', 'SPECIAL SCHOLARSHIP - HS','SPECIAL SCHOLARSHIP- ELEM','SPECIAL SCHOLARSHIP-DOCTORATE','MBA','SPECIAL SCHOLARSHIP','SPECIAL SCHOLARSHIP-SCHOLASTIC','CMDI BAY/TAGUM'])
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
            
            // Fetch disbursements data for the scholar, sorted by creation date in descending order (LIFO)
            $disbursements = Disbursement::where('Scholar_code', $scholar->scholar_code)
                                          ->wherein('account',[true])
                                          ->orderBy('created_at', 'desc')
                                          ->get();
        
            // Pass both scholar and disbursements data to the view
            return view('scholar.info', compact('scholar', 'disbursements'));
        }
        
        public function status()
        {
          //$Active = Status::where('status', 'ACTIVE')->count();
        //$Inactive = Status::where('status', 'INACTIVE')->count();
        //$GRADUATED = Status::where('status', 'GRADUATED')->count();
        //$Cancelled = Status::where('status', 'TOTALLY CANCELLED')->count();
        //$EndContract = Status::where('status', 'END OF CONTRACT')->count();
        
        $seniorHigh_cmdibay_active = Scholar::where('status', 'ACTIVE')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-BAY'])
        ->count();
        $seniorHigh_cmdibay_inactive = Scholar::where('status', 'INACTIVE')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-BAY'])
        ->count();
        $seniorHigh_cmdibay_tc = Scholar::where('status', 'TOTALLY CANCELLED')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-BAY'])
        ->count();
        $seniorHigh_cmdibay_graduated = Scholar::where('status', 'GRADUATED')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-BAY'])
        ->count();
        $seniorHigh_cmdibay_eoc = Scholar::where('status', 'END OF CONTRACT')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-BAY'])
        ->count();




        $seniorHigh_cmditagum_active = Scholar::where('status', 'ACTIVE')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-TAGUM'])
        ->count();
        $seniorHigh_cmditagum_inactive = Scholar::where('status', 'INACTIVE')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-TAGUM'])
        ->count();
        $seniorHigh_cmditagum_tc = Scholar::where('status', 'TOTALLY CANCELLED')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-TAGUM'])
        ->count();
        $seniorHigh_cmditagum_graduated = Scholar::where('status', 'GRADUATED')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-TAGUM'])
        ->count();
        $seniorHigh_cmditagum_eoc = Scholar::where('status', 'END OF CONTRACT')
        ->whereIn('scholarship_type', ['SENIOR HIGH CMDI-TAGUM'])
        ->count();

        $seniorHigh_regular_active = Scholar::where('status', 'ACTIVE')
        ->whereIn('scholarship_type', ['REGULAR SENIOR HIGH SCHOOL'])
        ->count();
        $seniorHigh_regular_inactive = Scholar::where('status', 'INACTIVE')
        ->whereIn('scholarship_type', ['REGULAR SENIOR HIGH SCHOOL'])
        ->count();
        $seniorHigh_regular_tc = Scholar::where('status', 'TOTALLY CANCELLED')
        ->whereIn('scholarship_type', ['REGULAR SENIOR HIGH SCHOOL'])
        ->count();
        $seniorHigh_regular_graduated = Scholar::where('status', 'GRADUATED')
        ->whereIn('scholarship_type', ['REGULAR SENIOR HIGH SCHOOL'])
        ->count();
        $seniorHigh_regular_eoc = Scholar::where('status', 'END OF CONTRACT')
        ->whereIn('scholarship_type', ['REGULAR SENIOR HIGH SCHOOL'])
        ->count();

        $seniorHigh_dshp_active = Scholar::where('status', 'ACTIVE')
        ->whereIn('scholarship_type', ['DSHP SENIOR HIGH- CMDI BAY'])
        ->count();
        $seniorHigh_dshp_inactive = Scholar::where('status', 'INACTIVE')
        ->whereIn('scholarship_type', ['DSHP SENIOR HIGH- CMDI BAY'])
        ->count();
        $seniorHigh_dshp_tc = Scholar::where('status', 'TOTALLY CANCELLED')
        ->whereIn('scholarship_type', ['DSHP SENIOR HIGH- CMDI BAY'])
        ->count();
        $seniorHigh_dshp_graduated = Scholar::where('status', 'GRADUATED')
        ->whereIn('scholarship_type', ['DSHP SENIOR HIGH- CMDI BAY'])
        ->count();
        $seniorHigh_dshp_eoc = Scholar::where('status', 'END OF CONTRACT')
        ->whereIn('scholarship_type', ['DSHP SENIOR HIGH- CMDI BAY'])
        ->count();

    


    $highSchool_active= Scholar::where('status', 'ACTIVE')
        ->whereIn('scholarship_type', ['REGULAR HIGH SCHOOL','IP HS-LUZON','IP HS-VIZMIN'])
        ->count();
    $highSchool_inactive = Scholar::where('status', 'INACTIVE')
        ->whereIn('scholarship_type', ['REGULAR HIGH SCHOOL','IP HS-LUZON','IP HS-VIZMIN'])
        ->count();
    $highSchool_tc = Scholar::where('status', 'TOTALLY CANCELLED')
        ->whereIn('scholarship_type', ['REGULAR HIGH SCHOOL','IP HS-LUZON','IP HS-VIZMIN'])
        ->count();
    $highSchool_graduated = Scholar::where('status', 'GRADUATED')
        ->whereIn('scholarship_type', ['REGULAR HIGH SCHOOL','IP HS-LUZON','IP HS-VIZMIN'])
        ->count();
    $highSchool_eoc = Scholar::where('status', 'END OF CONTRACT')
        ->whereIn('scholarship_type', ['REGULAR HIGH SCHOOL','IP HS-LUZON','IP HS-VIZMIN'])
        ->count();
        


    $college_active = Scholar::where('status', 'ACTIVE')
        ->whereIn('scholarship_type', ['REGULAR COLLEGE', 'REGULAR COLLEGE - FULL', 'REGULAR COLLEGE - HALF', 'IP-COLLEGE'])
        ->count();
    $college_inactive = Scholar::where('status', 'INACTIVE')
        ->whereIn('scholarship_type', ['REGULAR COLLEGE', 'REGULAR COLLEGE - FULL', 'REGULAR COLLEGE - HALF', 'IP-COLLEGE'])
        ->count();
    $college_tc = Scholar::where('status', 'TOTALLY CANCELLED')
        ->whereIn('scholarship_type', ['REGULAR COLLEGE', 'REGULAR COLLEGE - FULL', 'REGULAR COLLEGE - HALF', 'IP-COLLEGE'])
        ->count();
    $college_graduated = Scholar::where('status', 'GRADUATED')
        ->whereIn('scholarship_type', ['REGULAR COLLEGE', 'REGULAR COLLEGE - FULL', 'REGULAR COLLEGE - HALF', 'IP-COLLEGE'])
        ->count();
    $college_eoc = Scholar::where('status', 'END OF CONTRACT')
        ->whereIn('scholarship_type', ['REGULAR COLLEGE', 'REGULAR COLLEGE - FULL', 'REGULAR COLLEGE - HALF', 'IP-COLLEGE'])
        ->count();
        



    $special_forbes_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['FORBES'])
    ->count();
    $special_forbes_inactive = Scholar::where('status', 'INACTIVE')
     ->whereIn('scholarship_type', ['FORBES'])
    ->count();
    $special_forbes_tc = Scholar::where('status', 'TOTALLY CANCELLED')
    ->whereIn('scholarship_type', ['FORBES'])
    ->count();
    $special_forbes_graduated = Scholar::where('status', 'GRADUATED')
    ->whereIn('scholarship_type', ['FORBES'])
    ->count();
    $special_forbes_eoc = Scholar::where('status', 'END OF CONTRACT')
    ->whereIn('scholarship_type', ['FORBES'])
    ->count();        


    $special_brokenshire_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['BROKENSHIRE'])
    ->count();
    $special_brokenshire_inactive = Scholar::where('status', 'INACTIVE')
     ->whereIn('scholarship_type', ['BROKENSHIRE'])
    ->count();
    $special_brokenshire_tc = Scholar::where('status', 'TOTALLY CANCELLED')
     ->whereIn('scholarship_type', ['BROKENSHIRE'])
    ->count();
    $special_brokenshire_graduated = Scholar::where('status', 'GRADUATED')
     ->whereIn('scholarship_type', ['BROKENSHIRE'])
    ->count();
    $special_brokenshire_eoc = Scholar::where('status', 'END OF CONTRACT')
     ->whereIn('scholarship_type', ['BROKENSHIRE'])
    ->count();

    
    $special_camia_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['CAMIA'])
    ->count();
    $special_camia_inactive = Scholar::where('status', 'INACTIVE')
     ->whereIn('scholarship_type', ['CAMIA'])
    ->count();
    $special_camia_tc = Scholar::where('status', 'TOTALLY CANCELLED')
     ->whereIn('scholarship_type', ['CAMIA'])
    ->count();
    $special_camia_graduated = Scholar::where('status', 'GRADUATED')
     ->whereIn('scholarship_type', ['CAMIA'])
    ->count();
    $special_camia_eoc = Scholar::where('status', 'END OF CONTRACT')
     ->whereIn('scholarship_type', ['CAMIA'])
    ->count();


    $special_specialscholarcollege_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP - COLLEGE','SPECIAL SCHOLARSHIP - HS','SPECIAL SCHOLARSHIP- ELEM','SPECIAL SCHOLARSHIP-DOCTORATE','SPECIAL SCHOLARSHIP'])
    ->count();
    $special_specialscholarcollege_inactive = Scholar::where('status', 'INACTIVE')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP - COLLEGE','SPECIAL SCHOLARSHIP - HS','SPECIAL SCHOLARSHIP- ELEM','SPECIAL SCHOLARSHIP-DOCTORATE','SPECIAL SCHOLARSHIP'])
    ->count();
    $special_specialscholarcollege_tc = Scholar::where('status', 'TOTALLY CANCELLED')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP - COLLEGE','SPECIAL SCHOLARSHIP - HS','SPECIAL SCHOLARSHIP- ELEM','SPECIAL SCHOLARSHIP-DOCTORATE','SPECIAL SCHOLARSHIP'])
    ->count();
    $special_specialscholarcollege_graduated = Scholar::where('status', 'GRADUATED')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP - COLLEGE','SPECIAL SCHOLARSHIP - HS','SPECIAL SCHOLARSHIP- ELEM','SPECIAL SCHOLARSHIP-DOCTORATE','SPECIAL SCHOLARSHIP'])
    ->count();
    $special_specialscholarcollege_eoc = Scholar::where('status', 'END OF CONTRACT')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP - COLLEGE','SPECIAL SCHOLARSHIP - HS','SPECIAL SCHOLARSHIP- ELEM','SPECIAL SCHOLARSHIP-DOCTORATE','SPECIAL SCHOLARSHIP'])
    ->count();


   



    $special_mba_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['MBA'])
    ->count();
    $special_mba_inactive = Scholar::where('status', 'INACTIVE')
     ->whereIn('scholarship_type', ['MBA'])
    ->count();
    $special_mba_tc = Scholar::where('status', 'TOTALLY CANCELLED')
     ->whereIn('scholarship_type', ['MBA'])
    ->count();
    $special_mba_graduated = Scholar::where('status', 'GRADUATED')
     ->whereIn('scholarship_type', ['MBA'])
    ->count();
    $special_mba_eoc = Scholar::where('status', 'END OF CONTRACT')
     ->whereIn('scholarship_type', ['MBA'])
    ->count();



    $special_specialscholarschola_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP-SCHOLASTIC'])
    ->count();
    $special_specialscholarschola_inactive = Scholar::where('status', 'INACTIVE')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP-SCHOLASTIC'])
    ->count();
    $special_specialscholarschola_tc = Scholar::where('status', 'TOTALLY CANCELLED')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP-SCHOLASTIC'])
    ->count();
    $special_specialscholarschola_graduated = Scholar::where('status', 'GRADUATED')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP-SCHOLASTIC'])
    ->count();
    $special_specialscholarschola_eoc = Scholar::where('status', 'END OF CONTRACT')
     ->whereIn('scholarship_type', ['SPECIAL SCHOLARSHIP-SCHOLASTIC'])
    ->count();


    $special_specialscholarbaytagum_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['CMDI BAY/TAGUM'])
    ->count();
    $special_specialscholarbaytagum_inactive = Scholar::where('status', 'INACTIVE')
     ->whereIn('scholarship_type', ['CMDI BAY/TAGUM'])
    ->count();
    $special_specialscholarbaytagum_tc = Scholar::where('status', 'TOTALLY CANCELLED')
     ->whereIn('scholarship_type', ['CMDI BAY/TAGUM'])
    ->count();
    $special_specialscholarbaytagum_graduated = Scholar::where('status', 'GRADUATED')
     ->whereIn('scholarship_type', ['CMDI BAY/TAGUM'])
    ->count();
    $special_specialscholarbaytagum_eoc = Scholar::where('status', 'END OF CONTRACT')
     ->whereIn('scholarship_type', ['CMDI BAY/TAGUM'])
    ->count();





    $BECollege_becollege_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['BALIK ESKWELA - COLLEGE','BALIK ESKWELA - COLLEGE IP'])
    ->count();
    $BECollege_becollege_inactive = Scholar::where('status', 'INACTIVE')
    ->whereIn('scholarship_type', ['BALIK ESKWELA - COLLEGE','BALIK ESKWELA - COLLEGE IP'])
    ->count();
    $BECollege_becollege_tc = Scholar::where('status', 'TOTALLY CANCELLED')
    ->whereIn('scholarship_type', ['BALIK ESKWELA - COLLEGE','BALIK ESKWELA - COLLEGE IP'])
    ->count();
    $BECollege_becollege_graduated = Scholar::where('status', 'GRADUATED')
    ->whereIn('scholarship_type', ['BALIK ESKWELA - COLLEGE','BALIK ESKWELA - COLLEGE IP'])
    ->count();
    $BECollege_becollege_eoc = Scholar::where('status', 'END OF CONTRACT')
    ->whereIn('scholarship_type', ['BALIK ESKWELA - COLLEGE','BALIK ESKWELA - COLLEGE IP'])
    ->count(); 



    


    $BEHighschool_hs_active  = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['BALIK ESKWELA - HIGH SCHOOL','BALIK ESKWELA HIGH SCHOOL IP'])
    ->count();
    $BEHighschool_hs_inactive = Scholar::where('status', 'INACTIVE')
    ->whereIn('scholarship_type', ['BALIK ESKWELA - HIGH SCHOOL','BALIK ESKWELA HIGH SCHOOL IP'])
    ->count();
    $BEHighschool_hs_tc = Scholar::where('status', 'TOTALLY CANCELLED')
    ->whereIn('scholarship_type', ['BALIK ESKWELA - HIGH SCHOOL','BALIK ESKWELA HIGH SCHOOL IP'])
    ->count();
    $BEHighschool_hs_graduated = Scholar::where('status', 'GRADUATED')
    ->whereIn('scholarship_type', ['BALIK ESKWELA - HIGH SCHOOL','BALIK ESKWELA HIGH SCHOOL IP'])
    ->count();
    $BEHighschool_hs_eoc = Scholar::where('status', 'END OF CONTRACT')
    ->whereIn('scholarship_type', ['BALIK ESKWELA - HIGH SCHOOL','BALIK ESKWELA HIGH SCHOOL IP'])
    ->count();  

    

    $DSHP_dshpclcmdibay_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['DSHP COLLEGE- CMDI BAY','COLLEGE CMDI-BAY'])
    ->count(); 
    $DSHP_dshpclcmdibay_inactive = Scholar::where('status', 'INACTIVE')
    ->whereIn('scholarship_type', ['DSHP COLLEGE- CMDI BAY','COLLEGE CMDI-BAY'])
    ->count();
    $DSHP_dshpclcmdibay_tc = Scholar::where('status', 'TOTALLY CANCELLED')
    ->whereIn('scholarship_type', ['DSHP COLLEGE- CMDI BAY','COLLEGE CMDI-BAY'])
    ->count();
    $DSHP_dshpclcmdibay_graduated = Scholar::where('status', 'GRADUATED')
    ->whereIn('scholarship_type', ['DSHP COLLEGE- CMDI BAY','COLLEGE CMDI-BAY'])
    ->count();
    $DSHP_dshpclcmdibay_eoc = Scholar::where('status', 'END OF CONTRACT')
    ->whereIn('scholarship_type', ['DSHP COLLEGE- CMDI BAY','COLLEGE CMDI-BAY'])
    ->count();  


    $DSHP_dshpclluzvin_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['DSHP COLLEGE- LUZVIMIN','DSHP COLLEGE'])
    ->count(); 
    $DSHP_dshpclluzvin_inactive = Scholar::where('status', 'INACTIVE')
    ->whereIn('scholarship_type', ['DSHP COLLEGE- LUZVIMIN','DSHP COLLEGE'])
    ->count();
    $DSHP_dshpclluzvin_tc = Scholar::where('status', 'TOTALLY CANCELLED')
    ->whereIn('scholarship_type', ['DSHP COLLEGE- LUZVIMIN','DSHP COLLEGE'])
    ->count();
    $DSHP_dshpclluzvin_graduated = Scholar::where('status', 'GRADUATED')
    ->whereIn('scholarship_type', ['DSHP COLLEGE- LUZVIMIN','DSHP COLLEGE'])
    ->count();
    $DSHP_dshpclluzvin_eoc = Scholar::where('status', 'END OF CONTRACT')
    ->whereIn('scholarship_type', ['DSHP COLLEGE- LUZVIMIN','DSHP COLLEGE'])
    ->count();  


    $DSHP_dshpclani_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['DSHP- ANIHAN'])
    ->count(); 
    $DSHP_dshpclani_inactive = Scholar::where('status', 'INACTIVE')
    ->whereIn('scholarship_type', ['DSHP- ANIHAN'])
    ->count();
    $DSHP_dshpclani_tc = Scholar::where('status', 'TOTALLY CANCELLED')
    ->whereIn('scholarship_type', ['DSHP- ANIHAN'])
    ->count();
    $DSHP_dshpclani_graduated = Scholar::where('status', 'GRADUATED')
    ->whereIn('scholarship_type', ['DSHP- ANIHAN'])
    ->count();
    $DSHP_dshpclani_eoc = Scholar::where('status', 'END OF CONTRACT')
    ->whereIn('scholarship_type', ['DSHP- ANIHAN'])
    ->count();  


    $DSHP_dshpcldt_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['DSHP- DUAL TECH'])
    ->count(); 
    $DSHP_dshpcldt_inactive = Scholar::where('status', 'INACTIVE')
    ->whereIn('scholarship_type', ['DSHP- DUAL TECH'])
    ->count();
    $DSHP_dshpcldt_tc = Scholar::where('status', 'TOTALLY CANCELLED')
    ->whereIn('scholarship_type', ['DSHP- DUAL TECH'])
    ->count();
    $DSHP_dshpcldt_graduated = Scholar::where('status', 'GRADUATED')
    ->whereIn('scholarship_type', ['DSHP- DUAL TECH'])
    ->count();
    $DSHP_dshpcldt_eoc = Scholar::where('status', 'END OF CONTRACT')
    ->whereIn('scholarship_type', ['DSHP- DUAL TECH'])
    ->count();  




    $CSP2_active = Scholar::where('status', 'ACTIVE')
     ->whereIn('scholarship_type', ['CSP 2'])
    ->count(); 
    $CSP2_inactive = Scholar::where('status', 'INACTIVE')
     ->whereIn('scholarship_type', ['CSP 2'])
    ->count();
    $CSP2_tc = Scholar::where('status', 'TOTALLY CANCELLED')
     ->whereIn('scholarship_type', ['CSP 2'])
    ->count();
    $CSP2_graduated = Scholar::where('status', 'GRADUATED')
     ->whereIn('scholarship_type', ['CSP 2'])
    ->count();
    $CSP2_eoc = Scholar::where('status', 'END OF CONTRACT')
     ->whereIn('scholarship_type', ['CSP 2'])
    ->count();    







        return view('scholar.status', compact('seniorHigh_cmdibay_active', 'seniorHigh_cmdibay_inactive', 'seniorHigh_cmdibay_tc', 'seniorHigh_cmdibay_graduated', 'seniorHigh_cmdibay_eoc','seniorHigh_cmditagum_active', 'seniorHigh_cmditagum_inactive', 'seniorHigh_cmditagum_tc', 'seniorHigh_cmditagum_graduated', 'seniorHigh_cmditagum_eoc','seniorHigh_regular_active', 'seniorHigh_regular_inactive', 'seniorHigh_regular_tc', 'seniorHigh_regular_graduated', 'seniorHigh_regular_eoc',
        'highSchool_active', 'highSchool_inactive', 'highSchool_tc', 'highSchool_graduated', 'highSchool_eoc',
        'college_active', 'college_inactive', 'college_tc', 'college_graduated', 'college_eoc',
        'special_forbes_active', 'special_forbes_inactive', 'special_forbes_tc', 'special_forbes_graduated', 'special_forbes_eoc',
        'special_brokenshire_active', 'special_brokenshire_inactive', 'special_brokenshire_tc', 'special_brokenshire_graduated', 'special_brokenshire_eoc',
        'special_camia_active', 'special_camia_inactive', 'special_camia_tc', 'special_camia_graduated', 'special_camia_eoc','special_specialscholarcollege_active', 'special_specialscholarcollege_inactive', 'special_specialscholarcollege_tc', 'special_specialscholarcollege_graduated', 'special_specialscholarcollege_eoc',
        'special_specialscholarcollege_active', 'special_specialscholarcollege_inactive', 'special_specialscholarcollege_tc', 'special_specialscholarcollege_graduated', 'special_specialscholarcollege_eoc',
        'special_mba_active', 'special_mba_inactive', 'special_mba_tc', 'special_mba_graduated', 'special_mba_eoc',
        'special_specialscholarschola_active', 'special_specialscholarschola_inactive', 'special_specialscholarschola_tc', 'special_specialscholarschola_graduated', 'special_specialscholarschola_eoc',
        'special_specialscholarbaytagum_active', 'special_specialscholarbaytagum_inactive', 'special_specialscholarbaytagum_tc', 'special_specialscholarbaytagum_graduated', 'special_specialscholarbaytagum_eoc',
        'BECollege_becollege_active', 'BECollege_becollege_inactive', 'BECollege_becollege_tc', 'BECollege_becollege_graduated', 'BECollege_becollege_eoc',
        'BEHighschool_hs_active', 'BEHighschool_hs_inactive', 'BEHighschool_hs_tc', 'BEHighschool_hs_graduated', 'BEHighschool_hs_eoc',
        'DSHP_dshpclcmdibay_active', 'DSHP_dshpclcmdibay_inactive', 'DSHP_dshpclcmdibay_tc', 'DSHP_dshpclcmdibay_graduated', 'DSHP_dshpclcmdibay_eoc',
        'DSHP_dshpclluzvin_active', 'DSHP_dshpclluzvin_inactive', 'DSHP_dshpclluzvin_tc', 'DSHP_dshpclluzvin_graduated', 'DSHP_dshpclluzvin_eoc',
        'DSHP_dshpclani_active', 'DSHP_dshpclani_inactive', 'DSHP_dshpclani_tc', 'DSHP_dshpclani_graduated', 'DSHP_dshpclani_eoc',
        'DSHP_dshpcldt_active', 'DSHP_dshpcldt_inactive', 'DSHP_dshpcldt_tc', 'DSHP_dshpcldt_graduated', 'DSHP_dshpcldt_eoc',
        'seniorHigh_dshp_active', 'seniorHigh_dshp_inactive', 'seniorHigh_dshp_tc', 'seniorHigh_dshp_graduated', 'seniorHigh_dshp_eoc',
        'CSP2_active', 'CSP2_inactive', 'CSP2_tc', 'CSP2_graduated', 'CSP2_eoc'));
        }


    public function softDelete($id)
    {
        $scholar = Scholar::findOrFail($id);
        $scholar->update(['account' => false]);

        return response()->json(['message' => 'Record soft deleted successfully']);
    }
    public function disbursementsoftDelete($id)
    {
        $disbursement = Disbursement::findOrFail($id);
        $disbursement->update(['account' => false]);

        return response()->json(['message' => 'Record soft deleted successfully']);
    }

    public function disbursementdelete($id)
    {
        // Find the disbursement record by its ID
        $disbursement = Disbursement::findOrFail($id);
    
        // Soft delete the record by updating the 'account' field to false
        $disbursement->update(['account' => false]);
    
        // Return a JSON response with a success message
       return redirect()->back()->with('success', 'Disbursement saved successfully!');
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
public function disbursementEdit($id)
{
    $disbursement = Disbursement::findOrFail($id);
    
    // Consolidate your data into a single array
    return view('scholar/Disbursement.Disbursementedit', [
        'disbursement' => $disbursement,
    ]);
}
public function disbursementEdit_info($id)
{
    $disbursement = Disbursement::findOrFail($id);
    
    // Consolidate your data into a single array
    return view('scholar/Disbursement.editDisbursement_info', [
        'disbursement' => $disbursement,
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

public function Updatedisbursement(Request $request, $id)
{
    $disbursement = Disbursement::findOrFail($id);

    // Prepare the data, converting empty strings to null
    $data = array_map(function($item) {
        return $item === '' ? null : $item;
    }, $request->all());

    // Columns to check and handle
    $columnsToCheck = [
        'scholar_name', 'institution', 'unti', 'area', 'batch', 
        'scholarship_type', 'year_level', 'status', 'Date', 
        'Date_memo', 'Memoumber', 'amount', 'return_cmdi', 'disbursement_remarks'
    ];

    foreach ($columnsToCheck as $column) {
        if (array_key_exists($column, $data) && $data[$column] === null) {
            $data[$column] = ''; // Or set it to a default value if appropriate
        }
    }

    // Update the disbursement with the prepared data
    $disbursement->update($data);
 
   
    return redirect()->route('scholar.disbursement')->with('success', 'Scholar updated successfully.');
}

public function disbursementUpdate_info(Request $request, $id)
{   

    $disbursement = Disbursement::findOrFail($id);
    $scholarCode = $disbursement->Scholar_code;
    $scholarId = Scholar::where('scholar_code', $scholarCode)->value('id');



    // Prepare the data, converting empty strings to null
    $data = array_map(function($item) {
        return $item === '' ? null : $item;
    }, $request->all());
    
    // Specifically handle each column to ensure it's not null
    $columnsToCheck = [ 'scholar_name',
    'institution',
    'unti',
    'area',
    'batch',
    'scholarship_type',
    'year_level',
    'status',
    'Date' ,
    'Date_memo',
    'Memoumber',
    'amount',
    'return_cmdi',
    'disbursement_remarks'

]; // Add other columns here
    foreach ($columnsToCheck as $column) {
        if (array_key_exists($column, $data) && $data[$column] === null) {
            $data[$column] = ''; // Or set it to a default value if appropriate
        }
    }

    // Update the scholar with the prepared data
    $disbursement->update($data);
 
    return redirect()->route('scholar.info', [$scholarId])->with('success', 'Disbursement updated successfully');
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
        //$Active = Status::where('status', 'ACTIVE')->count();
        //$Inactive = Status::where('status', 'INACTIVE')->count();
        //$GRADUATED = Status::where('status', 'GRADUATED')->count();
        //$Cancelled = Status::where('status', 'TOTALLY CANCELLED')->count();
        //$EndContract = Status::where('status', 'END OF CONTRACT')->count();
    
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
         ->whereIn('scholarship_type', ['FORBES','BROKENSHIRE','CAMIA','SPECIAL SCHOLARSHIP - COLLEGE','SPECIAL SCHOLARSHIP - HS','SPECIAL SCHOLARSHIP- ELEM','SPECIAL SCHOLARSHIP-DOCTORATE','SPECIAL SCHOLARSHIP','MBA','SPECIAL SCHOLARSHIP-SCHOLASTIC','CMDI BAY/TAGUM'])
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
