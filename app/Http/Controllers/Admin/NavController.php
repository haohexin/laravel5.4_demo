<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryAddRequest;
use App\Http\Requests\EmptyRequest;
use App\Http\Requests\IdRequest;
use App\Model\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavController extends Controller
{

    private function getCategory($id){
        if ($id == 0) {
            $result = Navigation::where ( 'fid', 0 )->get ();
        } else {
            $data = Navigation::where('id', $id)->first (['code']);
            $result = Navigation::where ( 'fid', $data->code )->get ();
        }
        return $result;
    }


    //列表
    public function lists()
    {
        $data = Navigation::with('secondLevel')
            ->where ( 'level', '1' )
            ->orderBy('rank')
            ->get ();
        return view ( 'admin.nav.lists', ['data' => $data] );
    }


    // 下级地址
    public function findLists(IdRequest $request)
    {
        return $this->getCategory($request ['id']);
    }


    //添加
    public function add()
    {
        return view ( 'admin.nav.add' );
    }

    public function addPost(CategoryAddRequest $request) {
        $type = $request ['type'];
        $title = explode ( ',', $request ['title'] );
        $url = explode ( ',', $request ['url'] );
        $permission = explode ( ',', $request ['permission'] );
        $rank = explode ( ',', $request ['rank'] );
        $icon = explode ( ',', $request ['icon'] );
        \DB::beginTransaction ();
        try {
            foreach ($title as $k=>$v) {
                if ($v) {
                    $data = new Navigation();
                    $data ['name'] = $v;
                    $data ['url'] = $url[$k];
                    $data ['permission'] = $permission[$k];
                    $data ['rank'] = $rank[$k];
                    $data ['icon'] = $icon[$k];
                    if ($type == '1') {
                        $data ['level'] = 1;
                        $data ['fid'] = 0;
                        $res = Navigation::where ( 'fid', 0 )->orderBy ( 'code', 'desc' )->first ( [
                            'code'
                        ] );

                        $data ['code'] = $res ? $res->code + 10000 : 10000;
                    } elseif ($type == '2') {
                        $data ['level'] = 2;
                        $province_id = $request ['province'];
                        if ($province_id != 0) {
                            $province = Navigation::where ( 'id', $province_id )->first ( [
                                'code'
                            ] );
                            $data ['fid'] = $province->code;
                            $res = Navigation::where ( 'fid', $province->code )->orderBy ( 'code', 'desc' )->first ( [
                                'code'
                            ] );
                            if (! empty ( $res )) {
                                $data ['code'] = $res->code + 100;
                            } else {
                                $data ['code'] = $data ['fid'] + 100;
                            }
                        } else {
                            return redirect ( 'admin/nav/add')->with('error', '添加失败!');
                        }
                    } elseif ($type == '3') {
                        $data ['level'] = 3;
                        $city_id = $request ['city'];
                        if ($city_id != 0) {
                            $city = Navigation::where ( 'id', $city_id )->first ( [
                                'code'
                            ] );
                            $data ['fid'] = $city->code;
                            $res = Navigation::where ( 'fid', $city->code )->orderBy ( 'code', 'desc' )->first ( [
                                'code'
                            ] );
                            if (! empty ( $res )) {
                                $data ['code'] = $res->code + 1;
                            } else {
                                $data ['code'] = $data ['fid'] + 1;
                            }
                        } else {
                            return redirect ( 'admin/nav/add')->with('error', '添加失败!');
                        }
                    }
                }
                $data->save ();
            }
            \DB::commit ();
        } catch ( \Exception $e ) {
            \DB::rollBack ();
            return redirect ( 'admin/nav/add')->with('error', '添加失败!');
        }
        return redirect ( 'admin/nav/add')->with('success', '添加成功!');
    }


    //修改
    public function edit(IdRequest $request)
    {
        $id = $request ['id'];
        $data = Navigation::where ( 'id', $id )->first();
        if ($data) {
            return view ( 'admin.nav.edit', [
                'data' => $data
            ] );
        }
    }

    public function editPost(EmptyRequest $request)
    {
        $id = $request ['id'];
        $data ['name'] = $request ['title'];
        $data ['url'] = $request ['url'];
        $data ['permission'] = $request ['permission'];
        $data ['rank'] = $request ['rank'];
        $data ['icon'] = $request ['icon'];
        $result = Navigation::where ( 'id', $id )->update ( $data );
        if (!$result) {
            return redirect ()->back ()->with('error', '修改失败!');
        }
        return redirect ()->back ()->with('success', '修改成功!');

    }


    //删除
    public function destroy(IdRequest $request)
    {
        $id = $request ['id'];
        $res = Navigation::where ( 'id', $id )->first ( [
            'code'
        ] );
        if (!$res){
            return redirect ()->back ()->with('error', '不存在该信息!');

        }
        $res2 = Navigation::where ( 'fid', $res->code )->first ();
        if ($res2) {
            return redirect ()->back ()->with('error', '此信息还是其他信息的父类,删除失败!');
        }
        $data = Navigation::where('id',$id)->delete();
        if (!$data) {
            return redirect ()->back ()->with('error', '删除失败!');
        }
        return redirect ()->back ()->with('success', '删除成功!');
    }
}
