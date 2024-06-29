<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.akunPetugas');
    }
    public function destroy($id)
    {
        // $petugas = \App\Models\Petugas::find($id);
        // $petugas->delete();
        toast('Success', 'Data Deleted Successfully');
        return redirect('admin/akun-petugas')->with('success', 'Data Deleted Successfully');
    }
}
