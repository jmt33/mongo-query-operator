<?php
require('../src/logic.php');
class LogicTest extends phpunit
{
    public $info = [
        'name' => 'mtao',
        'email' => 'jmtao33@gmail.com'
    ];

    public $andInfo = [
        'name' => 'kit'
    ];

    public $orInfo = [
        '$or' => [
            'name' => 'jay'
        ]
    ];

    public function testAnd()
    {
        $logic = new Logic();
        
    }

    public function testOr()
    {

    }


}
