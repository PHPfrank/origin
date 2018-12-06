<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 15:23
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminGroup;
use App\Models\AdminRule;


class GroupController extends Controller
{
    /**
     * 群组管理
     */
    public function groupPage(Request $request)
    {
        $this->getMemuData();
        $adminGroup = new AdminGroup();
        $this->data['adminGroupList'] = $adminGroup->get();
        $this->data['sider'] ='groupManage';
        return view('admin.group.group',$this->data);
    }

    /**
     * 群组用户列表
     */
    public function userList(Request $request)
    {
        $group_id = $request->input("group_id");
        $adminGroup = AdminGroup::groupInfo($group_id);
        $this->data['userList'] = $adminGroup->hasUser()->get();
        return view('admin.group.groupuser',$this->data);
    }

    /**
     * 群组分配权限
     */
    public function assignRulePage(Request $request)
    {
        $adminRule = new AdminRule();
        $this->data['adminRuleList'] = $adminRule->orderBy('sort','asc')->get();
        if($group_id = $request->input("group_id","")) {
            $this->data['adminGroup'] = AdminGroup::groupInfo($group_id);
            $this->data['adminGroup']->arrayRule = explode(",", $this->data['adminGroup']->rules);
        }
        return view('admin.group.grouprule',$this->data);
    }

    /**
     * 分配权限操作
     */
    public function do_assignRule(Request $request)
    {
        if($group_id = $request->input("group_id")) {
            $adminGroup = AdminGroup::groupInfo($group_id);
        } else {
            $adminGroup = new AdminGroup();
        }
        $data['title'] = $request->input("name");
        $data['rules'] = $request->input("rule","");
        $data['status'] = $request->input("status");
        if($adminGroup->addOrUpdateGroupInfo($data)) {
            return $this->ajaxJson($adminGroup);
        }
        return $this->errorJson(-1050);
    }

    /**
     * 删除群组
     */
    public function do_groupDel(Request $request)
    {
        if($group_id = $request->input("group_id")) {
            $adminGroup = new AdminGroup();
            if($adminGroup->deleteGroup($group_id)) {
                return $this->ajaxJson("删除成功");
            }
        }
        return $this->errorJson(-1003);
    }
}