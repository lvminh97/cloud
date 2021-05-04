<?php
if(!defined('__CONTROLLER__')) define('__CONTROLLER__', 'true');
require_once "Model/Account.php";
require_once "Model/Item.php";
require_once "Model/Owner.php";

class Controller{
    protected $accountObj;
    protected $itemObj;
    protected $ownerObj;

    public function __construct(){
        $this->accountObj = new Account;
        $this->itemObj = new Item;
        $this->ownerObj = new Owner;

        sessionInit();
        setTimeZone();
    }
}
?>