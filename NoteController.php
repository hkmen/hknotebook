<?php
require_once('ControllerBase.php');
class NoteController extends ControllerBase
{
    private $table = "note";
    private $content_table = "note_content";
    public function GetData($params)
    {

    }

    public function SetData($params)
    {

    }

    public function GetNoteList($params)
    {
        $cols = Array ("note_id","name", "createtime");
        self::$db->orderBy("note_id", "Desc");
        if($params['note_name'])
        {
            self::$db->where('name', $params["note_name"]);
        }

        $notes = self::$db->get ($this->table, 20, $cols);
        $data = array();
        foreach($notes as $key=>$value)
        {
            $data[$key]["note_id"] = $value["note_id"];
            $data[$key]["note_name"] = $value["name"];
            $data[$key]["note_items1"] = Array();
            $data[$key]["note_items2"] = Array();
            $data[$key]["note_items3"] = Array();
            $data[$key]["note_items4"] = Array();
            if($key==0){
                self::$db->where('note_id', $value["note_id"]);
                $cols = Array ("id", "content", "type", "finished");
                $contents = self::$db->get ($this->content_table, null, $cols);
                foreach($contents as $k=>$val)
                {
                    if($val["type"]==0)
                    {
                        array_push($data[$key]["note_items1"], $val);
                    }
                    else if($val["type"]==1)
                    {
                        array_push($data[$key]["note_items2"], $val);
                    }
                    else if($val["type"]==2)
                    {
                        array_push($data[$key]["note_items3"], $val);
                    }
                    else if($val["type"]==3)
                    {
                        array_push($data[$key]["note_items4"], $val);
                    }
                }
            }
 
        }

        return json_encode($data);
    }

    public function GetNoteItems($params)
    {
        $data = array();
        self::$db->where('note_id', $params["note_id"]);
        $cols = Array ("id", "content", "type", "finished");
        $contents = self::$db->get ($this->content_table, null, $cols);
        $data["note_id"] = $params["note_id"];
        $data["note_items1"] = Array();
        $data["note_items2"] = Array();
        $data["note_items3"] = Array();
        $data["note_items4"] = Array();
        foreach($contents as $k=>$val)
        {
            if($val["type"]==0)
            {
                array_push($data["note_items1"], $val);
            }
            else if($val["type"]==1)
            {
                array_push($data["note_items2"], $val);
            }
            else if($val["type"]==2)
            {
                array_push($data["note_items3"], $val);
            }
            else if($val["type"]==3)
            {
                array_push($data["note_items4"], $val);
            }
        }
        return json_encode($data);
    }

    public function UpdateNoteItem($params)
    {
        self::$db->where('id', $params['id']);
        $data = array ("finished"=>$params['finished']);
        self::$db->update ($this->content_table, $data);
        return json_encode(array());
    }

    public function DeleteNoteBook($params)
    {
        $note_id = $params['note_id'];
        self::$db->startTransaction();

        self::$db->where('note_id', $note_id);
        if(!self::$db->delete($this->table))
        {
            self::$db->rollback();
        }
        else
        {
            self::$db->where('note_id', $note_id);
            if(!self::$db->delete($this->content_table))
            {
                self::$db->rollback();
            }
            else
            {
                self::$db->commit();
            }
        }

        return json_encode(array());
    }

    public function AddNoteBook($params)
    {
        $datas = $params['note_items'];
        $note = array('name'=>date("Y-m-d", time()),'createtime'=> time());
        self::$db->startTransaction();
        if(!($note_id =self::$db->insert($this->table, $note)))
        {
            self::$db->rollback();
        }
        else
        {
            $items = array();
            $i = 0;
            foreach($datas as $key=>$val)
            {
                $items[$i] = array($note_id, $val['type'], $val['content']);
                $i++;
            }
            $keys = array("note_id","type","content");
            $ids = self::$db->insertMulti($this->content_table, $items, $keys);
            if(!$ids)
            {
                self::$db->rollback();
            }
            else
            {
                self::$db->commit();
            }
        }

        return $this->GetNoteList(array("note_name"=>''));

    }

    public function GetNoteBook($params)
    {
        $cols = Array ("note_id", "createtime");
        $notes = self::$db->get ($this->table, null, $cols);
        $data = Array();
        foreach($notes as $key=>$value)
        {
            self::$db->where('note_id', $value["note_id"]);
            $cols = Array ("id", "content", "type", "finished");
            $contents = self::$db->get ($this->content_table, null, $cols);
            $data[$key]["note_id"] = $value["note_id"];
            $data[$key]["note_name"] = date("Y-m-d", $value["createtime"]);
            $data[$key]["note_items1"] = Array();
            $data[$key]["note_items2"] = Array();
            $data[$key]["note_items3"] = Array();
            $data[$key]["note_items4"] = Array();
            foreach($contents as $k=>$val)
            {
                if($val["type"]==0)
                {
                    array_push($data[$key]["note_items1"], $val);
                }
                else if($val["type"]==1)
                {
                    array_push($data[$key]["note_items2"], $val);
                }
                else if($val["type"]==2)
                {
                    array_push($data[$key]["note_items3"], $val);
                }
                else if($val["type"]==3)
                {
                    array_push($data[$key]["note_items4"], $val);
                }
            }
            //$data[$key]["note_items"] = $contents;
        }
        return json_encode($data);
    }
}
