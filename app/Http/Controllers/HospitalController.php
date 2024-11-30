<?php
namespace App\Http\Controllers;

use App\Interfaces\HospitalRepositoryInterface;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    private $hospitalRepository;

    public function __construct(HospitalRepositoryInterface $hospitalRepository)
    {
        $this->hospitalRepository = $hospitalRepository;
    }

    public function index()
    {
        $hospitals = $this->hospitalRepository->all();
        return response()->json($hospitals);
    }

    public function show($id)
    {
        $hospital = $this->hospitalRepository->find($id);
        return response()->json($hospital);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);
    
        $hospital = $this->hospitalRepository->create($validated);
    
        return response()->json($hospital, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'address' => 'string|max:255',
            'phone' => 'string|max:15',
        ]);

        $hospital = $this->hospitalRepository->update($id, $validated);
        return response()->json($hospital);
    }

    public function destroy($id)
    {
        $this->hospitalRepository->delete($id);
        return response()->json(['message' => 'Hospital deleted successfully']);
    }
}
