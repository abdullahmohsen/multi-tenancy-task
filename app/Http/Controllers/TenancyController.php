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
      $domain = $request->domain . '.' . $request->getHost();
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
    DB::connection(env('DB_CONNECTION', ''))->statement("CREATE DATABASE ".$dbname);
  }
}
