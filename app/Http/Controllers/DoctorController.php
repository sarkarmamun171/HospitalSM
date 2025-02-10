<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUploadHelper;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function addDoctor()
    {
        return view('admin.doctor.addDoctor');
    }
    public function addDoctorStore(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'speciality'  => 'nullable|string|max:255',
            'room'        => 'nullable|string|max:50',
            'time'        => 'required|string|max:100',
            'day'         => 'required|string|max:50',
            'fee'         => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Only image files, max 2MB
        ]);

        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;
        $doctor->time = $request->time;
        $doctor->day = $request->day;
        $doctor->fee = $request->fee;
        $doctor->description = $request->description;
        $doctor->image = ImageUploadHelper::uploadImage($request, 'image'); //use App\Helpers\ImageUploadHelper;

        // Image Upload
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time().'.'.$image->getClientOriginalExtension();
        //     $image->move(public_path('uploads/doctors'), $imageName);
        //     $doctor->image = 'uploads/doctors/' . $imageName;
        // }

        $doctor->save();

        return redirect()->back()->with('success', 'Doctor added successfully!');
    }
    public function addDoctorIndex()
    {
        $doctors = Doctor::all();
        return view('admin.doctor.index', compact('doctors'));
    }
    public function addDoctorEdit($id)
    {
        $doctors = Doctor::findOrFail($id);
        return view('admin.doctor.edit', compact('doctors'));
    }
    public function addDoctorUpdate(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'speciality'  => 'nullable|string|max:255',
            'room'        => 'nullable|string|max:50',
            'time'        => 'required|string|max:100',
            'day'         => 'required|string|max:50',
            'fee'         => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Only image files, max 2MB
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;
        $doctor->time = $request->time;
        $doctor->day = $request->day;
        $doctor->fee = $request->fee;
        $doctor->description = $request->description;

        if ($request->hasFile('image')) {
            $doctor->image = ImageUploadHelper::uploadImage($request, 'image');
        }
        $doctor->save();

        return redirect()->route('add-doctor.index')->with('success', 'Doctor updated successfully!');
    }
    public function addDoctorDelete($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('add-doctor.index')->with('success', 'Doctor deleted successfully!');
    }
}
