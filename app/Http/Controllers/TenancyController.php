<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Tenant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TenantRequest;

class TenancyController extends Controller
{
  public function create()
  {
    return view('tenancies.create');
  }

  public function store(TenantRequest $request)
  {
    try {
      DB::beginTransaction();
      $subDomain = explode(':', $_SERVER['HTTP_HOST'], 2);
      $domain = $request->domain.'.'.$subDomain[0];
      Tenant::create([
        'name'    => $request->name,
        'domain'  => $domain,
        'database'=> $request->database
      ]);
      $this->createDB($request->database);
      Artisan::call('tenants:artisan "migrate --database=tenant"');
      Config::set('database.connections.tenant.database', $request->database);
      DB::table('users')->insert([
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => Hash::make($request->password)
      ]);
      DB::commit();
      session()->flash('success', 'Created Successfully, You Can Login now with ' . $domain);
      return redirect()->back();
    } catch (\Exception $ex) {
      DB::rollBack();
      return back()->with('error', 'Try Again');
    }
  }

  private function createDB($dbname)
  {
    $servername = env('DB_HOST', '127.0.0.1');
    $username = env('DB_USERNAME', 'root');
    $password = env('DB_PASSWORD', '');

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;
    if (mysqli_query($conn, $sql)) {
      echo "Database created successfully";
    } else {
      echo "Error creating database: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  }
}
