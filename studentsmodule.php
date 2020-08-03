<?php

class StudentsModule extends ObjectModel 
{
    public $id_students;
    public $name;
    public $birthdate;
    public $isstudy;
    public $score;

    public static $definition = array(
        'table'     => 'students',
        'primary'   => 'id_students',
        'multilang' => true,
        'fields'    => array(
            'name'      => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255),
            'score'     => array('type' => self::TYPE_INT),
            'isstudy'   => array('type' => self::TYPE_BOOL),
            'birthdate' => array('type' => self::TYPE_DATE),
        ),
    );

    public function getAll($id_lang) 
    {
        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('students', 's');
        $sql->innerJoin('students_lang', 'l', 's.id_student = l.id_student AND l.id_lang = '.(int)$id_lang);
        $sql->orderBy('name');
        return Db::getInstance()->executeS($sql);
    }

    public function getBestScoreUser($id_lang) 
    {
        $sql = new DbQuery();
        $sql->select('name');
        $sql->from('students');
        $sql->innerJoin('students_lang', 'l', 's.id_student = l.id_student AND l.id_lang = '.(int)$id_lang);
        $sql->orderBy('score DESC');
        return Db::getInstance()->getValue($sql);
    }
    public function getBestSccore()
    {
        $sql = new DbQuery();
        $sql->select('score');
        $sql->from('students');
        $sql->orderBy('score DESC');
        return Db::getInstance()->getValue($sql);
    }
}