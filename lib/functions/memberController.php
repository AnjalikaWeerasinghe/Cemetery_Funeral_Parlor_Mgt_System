<?php
session_start();
include_once('main.php');
include_once('numberGeneration.php');

class MemberController extends MainController {

    public function getNewMemberCode() {
        $number = new Numbering();
        return $number->generateUniqueNumber("member_code", "member_table", "CEM-MEM-");
    }

}

?>