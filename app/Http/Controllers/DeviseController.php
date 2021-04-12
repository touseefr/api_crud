<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devise;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator as ValidationValidator;
use Validator;

class DeviseController extends Controller
{
    // all user data fetch
    // public function list()
    // {
    //     return Devise::all();
    // }
    public function list()
    {
        return Devise::all();
    }
    public function listparams($id)
    {
        return Devise::find($id);
    }

    public function add(Request $req)
    {
        $devise = new Devise;
        $devise->name = $req->name;
        $devise->email = $req->email;
        $devise->password = $req->password;
        $result = $devise->save();
        if ($result) {
            return ["Result" => "Added Done..."];
        } else {
            return ["Result" => "FAiled!!!!!!"];
        }
    }

    public function update(Request $req)
    {
        $devise = Devise::find($req->id);
        $devise->name = $req->name;
        $devise->email = $req->email;
        $devise->password = $req->password;
        $result = $devise->save();
        if ($result) {
            return ["Result" => "Update Done..."];
        } else {
            return ["Result" => "FAiled Update!!!!!!"];
        }
    }
    public function delete($id)
    {
        $devise = Devise::find($id);
        $result = $devise->delete();
        if ($result) {
            return ["Result" => "Delete Done..." . $id];
        } else {
            return ["Result" => "FAiled delete!!!!!!"];
        }
    }

    public function search($name)
    {
        $result = Devise::where("name", "like", "%" . $name . "%")->get();
        if (count($result)) {
            return $result;
        } else {
            return array('Result', 'No records found');
        }
    }
    public function testdata(Request $req)
    {
        $rules=array(
            "name"=>"required | min:3",
            "email"=>" required | unique:devises"
        );
        $validator=FacadesValidator::make($req->all(),$rules);
        if($validator->fails())
        {
           // return $validator->errors();
           return response()->json($validator->errors(),401);
        }
        else{
            $devise = new Devise;
        $devise->name = $req->name;
        $devise->email = $req->email;
        $devise->password = $req->password;
        $result = $devise->save();
        if ($result) {
            return ["Result" => "Added Done..."];
        } else {
            return ["Result" => "FAiled!!!!!!"];
        }
        }

      //  return "test data here....";
    }
}
