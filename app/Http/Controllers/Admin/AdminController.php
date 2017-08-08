<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminAddRequest;
use App\Http\Requests\AdminEditRequest;
use App\Http\Requests\IdRequest;
use App\Model\Admin;
use App\Model\Role;
use Illuminate\Routing\Controller;
use Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    //列表
    public function lists()
    {
        $data = Admin::with (['roles'])->orderBy ( 'id', 'desc' )->paginate ();
        return view ( 'admin.admin.lists', ['data' => $data] );
    }


    //添加
    public function add()
    {
        $role = Role::get ();
        return view ( 'admin.admin.add', [
            'type' => $role
        ] );
    }

    public function addPost(AdminAddRequest $request)
    {
        $admin_id = Auth::guard ( 'admin' )->user ()->id;
        if ($admin_id != 1) {
            return redirect ()->back ()->withInput ()->withErrors ( '权限不足！' );
        }
        $data = new Admin ();
        $data ['account'] = $request ['username'];
        $data ['remember_token'] = $request ['_token'];
        $data ['password'] = bcrypt ( $request->input ( 'password' ) );
        $data->save ();
        $yan = Admin::where ( 'id', $data ['id'] )->first ();
        if (! $yan) {
            return redirect ()->back ()->with('error', '添加失败!');
        }
        // 分配权限
        $yan->attachRole($request ['category']);
        return redirect ()->back ()->with('success', '添加成功!');
    }


    //修改
    public function edit(IdRequest $request)
    {
        $admin_id = Auth::guard('admin')->user()->id;
        if ($admin_id != 1){
            return redirect()->back()->withInput()->withErrors('权限不足！');
        }
        $res = Admin::with(['roles'])->where('id',$request['id'])->first();
        if (!$res){
            return redirect()->back()->withInput()->withErrors('管理员不存在！');
        }
        $res->roleId = $res->roles?$res->roles[0]->id:0;
        return view('admin.admin.edit',['data'=>$res,'type'=>Role::get()]);
    }

    public function editPost(AdminEditRequest $request)
    {
        $admin_id = Auth::guard('admin')->user()->id;
        if ($admin_id != 1){
            return redirect()->back()->withInput()->withErrors('权限不足！');
        }
        //管理员信息
        $res = Admin::where('id',$request['id'])->first();
        if (!$res){
            return redirect()->back()->withInput()->withErrors('管理员不存在！');
        }
        //判断用户名是否重复
        $nameCheck = Admin::where('account',$request['username'])->first();
        if ($nameCheck){
            if ($nameCheck->id != $res->id){
                return redirect()->back()->withInput()->withErrors('用户名不可重复！');
            }
        }
        $data = [];
        $data['account'] = $request['username'];
        if ($request->has('password')){
            $data['password'] = bcrypt( $request->input('password'));
        }
        $yan = Admin::where('id',$request['id'])->update($data);
        if (!$yan){
            return redirect()->back()->withInput()->withErrors('修改失败！');
        }
        //分配权限
        DB::table('role_user')->where('user_id',$request['id'])->update(['role_id'=>$request['category']]);
        return redirect ()->back ()->with('success', '修改成功!');
    }


    //删除
    public function destroy(IdRequest $request)
    {
        $admin_id = Auth::guard('admin')->user()->id;
        if ($admin_id != 1){
            return redirect()->back()->withInput()->withErrors('权限不足！');
        }
        $yan = Admin::with(['roles'])->where('id',$request['id'])->first();
        if (!$yan){
            return redirect()->back()->withInput()->withErrors('管理员不存在！');
        }
        $res = Admin::where('id',$request['id'])->delete();
        if (!$res){
            return redirect()->back()->withInput()->withErrors('删除失败！');
        }
        DB::table('role_user')->where('user_id',$request['id'])->delete();
        return redirect ()->back ()->with('success', '删除成功!');
    }
}
