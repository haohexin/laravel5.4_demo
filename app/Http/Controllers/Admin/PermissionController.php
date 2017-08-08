<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/25
 * Time: 8:53
 */
namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmptyRequest;
use App\Http\Requests\IdRequest;
use App\Http\Requests\PermissionAddRequest;
use App\Http\Requests\PermissionEditRequest;
use App\Http\Requests\Request;
use App\Http\Requests\RoleAddRequest;
use App\Model\Permission;
use App\Model\PermissionRole;
use App\Model\Role;
use Illuminate\Routing\Controller;
use DB;

/*
 * 权限模块
 */
class PermissionController extends Controller {
	// 所有权限
	public function permissionList() {
		$data = Permission::orderBy ( 'id', 'desc' )->paginate ();
		return view ( 'admin.permission.permissionList', [ 
				'data' => $data 
		] );
	}
	
	// 添加权限
	public function permissionAdd() {
		return view ( 'admin.permission.permissionAdd' );
	}
	
	// 添加权限提交
	public function permissionAddPost(PermissionAddRequest $request) {
		$data = new Permission ();
		$data ['name'] = $request ['name'];
		$data ['display_name'] = $request ['display_name'];
		$data ['description'] = $request ['description'];
		if (!$data->save ()) {
            return redirect ()->back ()->with('error', '添加失败!');
        }
        return redirect ()->back ()->with('success', '添加成功!');
	}
	
	// 修改权限
	public function permissionEdit(IdRequest $request) {
		$data = Permission::where ( 'id', $request ['id'] )->first ();
		return view ( 'admin.permission.permissionEdit', [ 
				'data' => $data 
		] );
	}
	
	// 修改权限提交
	public function permissionEditPost(PermissionEditRequest $request) {
		$yan = Permission::where ( 'name', $request ['name'] )->first ();
		if ($yan && $yan ['id'] != $request ['id']) {
			return redirect ()->back ()->withInput ()->withErrors ( '权限已存在 不可重复添加！' );
		}
		$data ['name'] = $request ['name'];
		$data ['display_name'] = $request ['display_name'];
		$data ['description'] = $request ['description'];
		$res = Permission::where ( 'id', $request ['id'] )->update ( $data );
        if (!$res) {
            return redirect ()->back ()->with('error', '修改失败!');
        }
        return redirect ()->back ()->with('success', '修改成功!');
	}
	
	// 删除权限
	public function permissionDelete(IdRequest $request) {
		$yan = Permission::where ( 'id', $request ['id'] )->first ();
		if (! $yan) {
			return redirect ()->back ()->withInput ()->withErrors ( '信息不存在！' );
		}
		$data = Permission::where ( 'id', $request ['id'] )->delete ();
        if (!$data) {
            return redirect ()->back ()->with('error', '删除失败!');
        }
        return redirect ()->back ()->with('success', '删除成功!');
	}
	
	// 所有角色
	public function roleList() {
		$data = Role::orderBy ( 'id', 'desc' )->paginate ();
		return view ( 'admin.permission.roleList', [ 
				'data' => $data 
		] );
	}
	
	// 添加角色
	public function roleAdd() {
		return view ( 'admin.permission.roleAdd' );
	}
	
	// 添加角色提交
	public function roleAddPost(RoleAddRequest $request) {
		$data = new Role ();
		$data['name'] = $request ['name'];
		$data['display_name'] = $request ['display_name'];
		$data['description'] = $request ['description'];
        if (!$data->save()) {
            return redirect ()->back()->with('error', '添加失败!');
        }
        return redirect ()->back()->with('success', '添加成功!');
	}
	
	// 修改角色
	public function roleEdit(IdRequest $request) {
		$data = Role::where ( 'id', $request ['id'] )->first ();
		return view ( 'admin.permission.roleEdit', [ 
				'data' => $data 
		] );
	}
	
	// 修改角色提交
	public function roleEditPost(EmptyRequest $request) {
		$yan = Role::where ( 'name', $request ['name'] )->first ();
		if ($yan && $yan ['id'] != $request ['id']) {
			return redirect ()->back ()->withInput ()->withErrors ( '角色已存在 不可重复添加！' );
		}
		$data ['name'] = $request ['name'];
		$data ['display_name'] = $request ['display_name'];
		$data ['description'] = $request ['description'];
		$res = Role::where ( 'id', $request ['id'] )->update ( $data );
        if (!$res) {
            return redirect ()->back ()->with('error', '修改失败!');
        }
        return redirect ()->back ()->with('success', '修改成功!');
	}
	
	// 删除角色
	public function roleDelete(IdRequest $request) {
		$yan = Role::where ( 'id', $request ['id'] )->first ();
		if (! $yan) {
			return redirect ()->back ()->withInput ()->withErrors ( '信息不存在！' );
		}
		$data = Role::where ( 'id', $request ['id'] )->delete ();
        if (!$data) {
            return redirect ()->back ()->with('error', '修改失败!');
        }
        return redirect ()->back ()->with('success', '修改成功!');
	}
	
	// 修改角色权限
	public function rolePermissionEdit(IdRequest $request) {
		// 所有权限
		$data = Permission::get ();
		// 角色信息
		$role = Role::where ( 'id', $request ['id'] )->first ();
		if (! $role) {
			return redirect ()->back ()->withInput ()->withErrors ( '角色不存在！' );
		}
		// 角色已有用权限
		$yan = PermissionRole::with ( [ 
				'permission' 
		] )->where ( 'role_id', $request ['id'] )->get ( [ 
				'permission_id' 
		] );
//		dd($data);
		$yan2 = [ ];
		foreach ( $yan as $v ) {
			$yan2 [] = $v ['permission_id'];
		}
		return view ( 'admin.permission.rolePermissionEdit', [ 
				'data' => $data,
				'role' => $role,
				'yan' => $yan2 
		] );
	}
	
	// 修改角色权限提交
	public function rolePermissionEditPost(EmptyRequest $request) {
		// 角色信息
		$role = Role::where ( 'id', $request ['id'] )->first ();
		if (! $role) {
			return redirect ()->back ()->withInput ()->withErrors ( '角色不存在！' );
		}
		\DB::beginTransaction ();
		try {
			// 删除旧权限
			PermissionRole::where ( 'role_id', $request ['id'] )->delete ();
			// 添加新权限
			if ($request ['ids']) {
				foreach ( $request ['ids'] as $v ) {
					$permissionRole = new PermissionRole ();
					$permissionRole ['permission_id'] = $v;
					$permissionRole ['role_id'] = $request ['id'];
					$permissionRole->save ();
				}
			}
			\DB::commit ();
		} catch ( \Exception $e ) {
			logger ( $e );
			\DB::rollBack ();
            return redirect ()->back ()->with('error', '修改失败!');
		}
        return redirect ()->back ()->with('success', '修改成功!');
	}
}