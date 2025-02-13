<?php

namespace App\Http\Controllers;

use App\Models\Delegation;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        // Fetch all students with their associated delegation, ordered by delegation and serial number
        $students = Student::with('delegation')
            ->orderBy('delegation_id')   // Order by delegation_id to sort by delegation
            ->orderBy('serialNo')        // Then order by serialNo
            ->get();

        // Pass students to the view
        return view('students.index', compact('students'));
    }

    public function create()
    {
        // Fetch all delegations
        $delegations = Delegation::all();

        // Pass delegations to the view
        return view('students.create', compact('delegations'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'delegation_id' => 'required|exists:delegations,id', // Ensure delegation_id exists in the delegations table
            'name' => 'required|string|max:255',
        ]);

        // Fetch the delegation
        $delegation = Delegation::findOrFail($validatedData['delegation_id']);

        // Generate the serial number prefix from the delegation tag
        $serialNoPrefix = $delegation->tag;

        // Find the highest existing serial number for this delegation
        $lastSerialNo = Student::where('delegation_id', $delegation->id)
            ->orderBy('serialNo', 'desc')
            ->value('serialNo');

        if ($lastSerialNo) {
            // Extract the numeric part from the last serial number
            $lastNumber = intval(substr($lastSerialNo, strlen($serialNoPrefix)));
            $nextNumber = $lastNumber + 1;
        } else {
            // Start from 1 if no existing serial numbers
            $nextNumber = 1;
        }

        // Format the next serial number with leading zeros
        $serialNo = sprintf('%s%03d', $serialNoPrefix, $nextNumber);

        // Create the new student
        Student::create([
            'name' => $validatedData['name'],
            'serialNo' => $serialNo,
            'delegation_id' => $validatedData['delegation_id'],
        ]);

        // Redirect with success message
        return redirect()->route('students.index')
            ->with('success', 'Student created successfully!');
    }

    public function destroy(Student $student)
    {
        // Delete the student
        $student->delete();

        // Redirect with success message
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

}
