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
use function Couchbase\defaultDecoder;

class TenancyController extends Controller
{
  public function create()
  {
    return view('tenancies.create');
  }

  public function store(TenantRequest $request)
  {
    $databaseName = str_replace(' ', '-', $request->database);
    $domainName = str_replace(' ', '-', $request->domain);
    $domain = $domainName . '.' . $request->getHost();

    try {
      DB::beginTransaction();
      Tenant::create([
        'name'    => $request->name,
        'domain'  => $domain,
        'database'=> $databaseName
      ]);
      $this->createDB($databaseName);
      Artisan::call('tenants:artisan "migrate --database=tenant"');
      Config::set('database.connections.tenant.database', $databaseName);
      DB::table('users')->insert([
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => Hash::make($request->password)
      ]);
      DB::commit();
      return redirect()->back()->with('success', $domain);
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
