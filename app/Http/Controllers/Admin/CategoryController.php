<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryAddRequest;
use App\Http\Requests\EmptyRequest;
use App\Http\Requests\IdRequest;
use App\Http\Requests\TitleRequest;
use App\Model\Category;
use App\Model\Dictionary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    private function getCategory($id){
        if ($id == 0) {
            $result = Dictionary::where ( 'fid', 0 )->get ();
        } else {
            $data = Dictionary::where('id', $id)->first (['code']);
            $result = Dictionary::where ( 'fid', $data->code )->get ();
        }
        return $result;
    }


    //列表
    public function lists()
    {
        $data = Dictionary::where ( 'level', '1' )->get ();
        return view ( 'admin.category.lists', [
            'data' => $data
        ] );
    }


    // 下级地址
    public function findLists(IdRequest $request)
    {
        return $this->getCategory($request ['id']);
    }


    //添加
    public function add()
    {
        return view ( 'admin.category.add' );
    }

    public function addPost(CategoryAddRequest $request) {
        $type = $request ['type'];
        $title = explode ( ',', $request ['title'] );
        \DB::beginTransaction ();
        try {
            foreach ( $title as $v ) {
                if ($v) {
                    $data = new Dictionary();
                    $data ['name'] = $v;
                    if ($type == '1') {
                        $data ['level'] = 1;
                        $data ['fid'] = 0;
                        $res = Dictionary::where ( 'fid', 0 )->orderBy ( 'code', 'desc' )->first ( [
                            'code'
                        ] );

                        $data ['code'] = $res ? $res->code + 10000 : 10000;
                    } elseif ($type == '2') {
                        $data ['level'] = 2;
                        $province_id = $request ['province'];
                        if ($province_id != 0) {
                            $province = Dictionary::where ( 'id', $province_id )->first ( [
                                'code'
                            ] );
                            $data ['fid'] = $province->code;
                            $res = Dictionary::where ( 'fid', $province->code )->orderBy ( 'code', 'desc' )->first ( [
                                'code'
                            ] );
                            if (! empty ( $res )) {
                                $data ['code'] = $res->code + 100;
                            } else {
                                $data ['code'] = $data ['fid'] + 100;
                            }
                        } else {
                            return redirect ( 'admin/category/add')->with('error', '添加失败!');
                        }
                    } elseif ($type == '3') {
                        $data ['level'] = 3;
                        $city_id = $request ['city'];
                        if ($city_id != 0) {
                            $city = Dictionary::where ( 'id', $city_id )->first ( [
                                'code'
                            ] );
                            $data ['fid'] = $city->code;
                            $res = Dictionary::where ( 'fid', $city->code )->orderBy ( 'code', 'desc' )->first ( [
                                'code'
                            ] );
                            if (! empty ( $res )) {
                                $data ['code'] = $res->code + 1;
                            } else {
                                $data ['code'] = $data ['fid'] + 1;
                            }
                        } else {
                            return redirect ( 'admin/category/add')->with('error', '添加失败!');
                        }
                    }
                }
                $data->save ();
            }
            \DB::commit ();
        } catch ( \Exception $e ) {
            \DB::rollBack ();
            return redirect ( 'admin/category/add')->with('error', '添加失败!');
        }
        return redirect ( 'admin/category/add')->with('success', '添加成功!');
    }


    //修改
    public function edit(IdRequest $request)
    {
        $id = $request ['id'];
        $data = Dictionary::where ( 'id', $id )->first ( [
            'id',
            'name'
        ] );
        if ($data) {
            return view ( 'admin.category.edit', [
                'data' => $data
            ] );
        }
    }

    public function editPost(EmptyRequest $request)
    {
        $id = $request ['id'];
        $data ['name'] = $request ['title'];
        $result = Dictionary::where ( 'id', $id )->update ( $data );
        if (!$result) {
            return redirect ()->back ()->with('error', '修改失败!');
        }
        return redirect ()->back ()->with('success', '修改成功!');

    }


    //删除
    public function destroy(IdRequest $request)
    {
        $id = $request ['id'];
        $res = Dictionary::where ( 'id', $id )->first ( [
            'code'
        ] );
        if (!$res){
            return redirect ()->back ()->with('error', '不存在该信息!');

        }
        $res2 = Dictionary::where ( 'fid', $res->code )->first ();
        if ($res2) {
            return redirect ()->back ()->with('error', '此信息还是其他信息的父类,删除失败!');
        }
        $data = Dictionary::where('id',$id)->delete();
        if (!$data) {
            return redirect ()->back ()->with('error', '删除失败!');
        }
        return redirect ()->back ()->with('success', '删除成功!');
    }
}
