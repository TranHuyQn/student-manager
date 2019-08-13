<?php


class Student
{
    public $id;
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId($data)
    {
        {
            foreach ($data as $key => $value) {
                if ($this->name == $value['name']) {
                    $this->id = $value['id'];
                }
            }
            return $this->id;
        }
    }
}
