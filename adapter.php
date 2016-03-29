<?php
require_once 'user_controller.inc.php';

//class Facebook {
//    public function postToWall($msg) {
//        echo "Posting message";
//        
//    }
//}

interface BillUpdate {
    public function edit_bill($amount, $desc, $name, $groupname, $expenseid);
}

class EditBillAdapter implements BillUpdate {
    private $bill;
    
    public function __construct(UserController $bill) {
        $this->bill = $bill;
    }
    
    public function edit_bill($amount, $desc, $name, $groupname, $expenseid) {
        $this->bill->edit_bill_update($amount, $desc, $name, $groupname, $expenseid);
        return true;
    }

}