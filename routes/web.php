<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 后台页面
Route::group ( ["prefix" => "admin", "namespace" => "Admin"], function () {
    // 登陆模块
    Route::get('/login', 'AuthController@showLogin');
    Route::post('/login', 'AuthController@login');

    Route::group ( ['middleware' => 'auth:admin'], function () {
        //首页
        Route::get ('/index','AuthController@index' );
        // 登出
        Route::get ( '/logout', 'AuthController@logout' );


        /*
         * 导航管理
         */
        // 列表
        Route::get ( 'nav/lists', 'NavController@lists' );
        Route::get ( 'nav/findLists', 'NavController@findLists' );
        // 添加
        Route::get ( 'nav/add', 'NavController@add' );
        Route::post ( 'nav/addPost', 'NavController@addPost' );
        // 修改
        Route::get ( 'nav/edit', 'NavController@edit' );
        Route::post ( 'nav/editPost', 'NavController@editPost' );
        // 删除
        Route::get ( 'nav/destroy', 'NavController@destroy' );


        /*
         * 类型管理
         */
        // 列表
        Route::get ( 'category/lists', 'CategoryController@lists' );
        Route::get ( 'category/findLists', 'CategoryController@findLists' );
        // 添加
        Route::get ( 'category/add', 'CategoryController@add' );
        Route::post ( 'category/addPost', 'CategoryController@addPost' );
        // 修改
        Route::get ( 'category/edit', 'CategoryController@edit' );
        Route::post ( 'category/editPost', 'CategoryController@editPost' );
        // 删除
        Route::get ( 'category/destroy', 'CategoryController@destroy' );


        /*
          * 管理员管理
          */
        // 列表
        Route::get ( 'admin/lists', 'AdminController@lists' );
        // 添加
        Route::get ( 'admin/add', 'AdminController@add' );
        Route::post ( 'admin/addPost', 'AdminController@addPost' );
        // 修改
        Route::get ( 'admin/edit', 'AdminController@edit' );
        Route::post ( 'admin/editPost', 'AdminController@editPost' );
        // 删除
        Route::get ( 'admin/destroy', 'AdminController@destroy' );


        /*
         * 权限管理
         */
        // 所有权限
        Route::get ( 'permission/permissionList', 'PermissionController@permissionList' );
        // 添加权限
        Route::get ( 'permission/permissionAdd', 'PermissionController@permissionAdd' );
        // 添加权限提交
        Route::post ( 'permission/permissionAddPost', 'PermissionController@permissionAddPost' );
        // 修改权限
        Route::get ( 'permission/permissionEdit', 'PermissionController@permissionEdit' );
        // 修改权限提交
        Route::post ( 'permission/permissionEditPost', 'PermissionController@permissionEditPost' );
        // 删除权限
        Route::get ( 'permission/permissionDelete', 'PermissionController@permissionDelete' );
        // 所有角色
        Route::get ( 'permission/roleList', 'PermissionController@roleList' );
        // 添加角色
        Route::get ( 'permission/roleAdd', 'PermissionController@roleAdd' );
        // 添加角色提交
        Route::post ( 'permission/roleAddPost', 'PermissionController@roleAddPost' );
        // 修改角色
        Route::get ( 'permission/roleEdit', 'PermissionController@roleEdit' );
        // 修改角色提交
        Route::post ( 'permission/roleEditPost', 'PermissionController@roleEditPost' );
        // 删除角色
        Route::get ( 'permission/roleDelete', 'PermissionController@roleDelete' );
        // 修改角色权限
        Route::get ( 'permission/rolePermissionEdit', 'PermissionController@rolePermissionEdit' );
        // 修改角色权限提交
        Route::post ( 'permission/rolePermissionEditPost', 'PermissionController@rolePermissionEditPost' );

    });

});