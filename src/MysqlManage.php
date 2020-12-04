<?php
/**
 * Info:
 * Created by 盐城网诚信息科技有限公司(vancens.com)
 * User: 阿强(550096055@qq.com)
 * Date: 2020/12/4
 * Time: 9:31
 */

namespace vancens\mysql;
use think\Db;

class MysqlManage
{
    /**
     * @title 创建数据表
     * @author vancens's a.qiang
     * @time 2020/12/4 10:49
     * @param $name 数据表名称
     * @param $info 信息 (aid int(11) NOT NULL,PRIMARY KEY (aid)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=''
     * @return mixed
     */
    public function createTable($name,$info)
    {
        $query = "CREATE TABLE `{$name}` {$info};";
        try {
            Db::execute($query);
        }catch (\Exception $e){
            return $this->retResult(false,$e->getMessage());
        }
        return $this->retResult(true,'数据表创建成功');
    }

    /**
     * @title 删除数据表
     * @author vancens's a.qiang
     * @time 2020/12/4 10:57
     * @param $name 数据表名称
     * @return array
     */
    public function deleteTable($name)
    {
        $query = "DROP TABLE IF EXISTS `{$name}`";
        try {
            Db::execute($query);
        }catch (\Exception $e){
            return $this->retResult(false,$e->getMessage());
        }
        return $this->retResult(true,'数据表删除成功');
    }

    /**
     * @title 创建字段
     * @author vancens's a.qiang
     * @time 2020/12/4 18:09
     * @param $name 数据表名称
     * @param $fieldName 字段名称
     * @param $info 字段信息 (varchar(255) comment '备注')
     * @return mixed
     */
    public function createField($name,$fieldName,$info)
    {
        $query  = "ALTER TABLE `{$name}` ADD `{$fieldName}` {$info};";
        try {
            Db::execute($query);
        }catch (\Exception $e){
            return $this->retResult(false,$e->getMessage());
        }
        return $this->retResult(true,'创建数据表字段成功');
    }

    /**
     * @title 修改字段
     * @author vancens's a.qiang
     * @time 2020/12/4 18:16
     * @param $name 数据表名称
     * @param $oldFieldName 原始字段名称
     * @param $newFieldName 新字段名称
     * @param $info 字段信息 (varchar(255) comment '备注')
     * @return array
     */
    public function editField($name,$oldFieldName,$newFieldName,$info)
    {
        $query  = "ALTER TABLE `{$name}` CHANGE `{$oldFieldName}` `{$newFieldName}` {$info};";
        try {
            Db::execute($query);
        }catch (\Exception $e){
            return $this->retResult(false,$e->getMessage());
        }
        return $this->retResult(true,'修改数据表字段成功');
    }

    /**
     * @title 删除字段
     * @author vancens's a.qiang
     * @time 2020/12/4 18:18
     * @param $name 数据表名称
     * @param $fieldName 字段名称
     * @return array
     */
    public function deleteField($name,$fieldName)
    {
        $query = "ALTER TABLE `{$name}` DROP {$fieldName}";
        try {
            Db::execute($query);
        }catch (\Exception $e){
            return $this->retResult(false,$e->getMessage());
        }
        return $this->retResult(true,'删除数据表字段成功');
    }

    /**
     * @title 统一返回信息
     * @author vancens's a.qiang
     * @time 2020/12/4 10:54
     * @param $boole
     * @param $content
     * @return array
     */
    private function retResult($boole,$content)
    {
        return ['s'=>$boole,'c'=>$content];
    }
}