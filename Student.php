<?php


class Student
{
    public $id;
    public $name;
    public $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
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

    public function getEmail()
    {
        return $this->email;
    }
}
