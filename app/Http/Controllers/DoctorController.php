<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function addDoctor(){
        return view('admin.doctor.addDoctor');
    }
    public function addDoctorStore(Request $request){
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:doctors,email',
            'password'    => 'required|string|min:6|confirmed',
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
        $doctor->email = $request->email;
        $doctor->password = bcrypt($request->password);
        $doctor->phone = $request->phone;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;
        $doctor->time = $request->time;
        $doctor->day = $request->day;
        $doctor->fee = $request->fee;
        $doctor->description = $request->description;

        // Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/doctors'), $imageName);
            $doctor->image = 'uploads/doctors/' . $imageName;
        }

        $doctor->save();

        return redirect()->back()->with('success', 'Doctor added successfully!');
    }

}
