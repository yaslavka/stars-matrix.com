<?php
class config {

    /**/
    public function __construct() {
        if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
            $this->Host = 'localhost';
            $this->User = 'robob937_m55dshk';
            $this->Pass = 'fyggr56652hjyrdFGFUUUJ52655HGREgf';
            $this->Base = 'robob937_fhhghg532hdfgfgoldmatrica';
        } else {
            $this->Host = 'localhost';
            $this->User = 'robob937_m55dshk';
            $this->Pass = 'fyggr56652hjyrdFGFUUUJ52655HGREgf';
            $this->Base = 'robob937_fhhghg532hdfgfgoldmatrica';
        }

        $this->Pr = 'den';
        $this->PrPerson = 'person';
    }




    # Настройки Payeer
        #НАСТРОЙКИ МЕРЧАНТА
        public $PayeerMerchantId = "850679370";
        public $PayeerMerchantSecret = "JVFDR48gvfdHVVY";
        public $PayeerMerchantKeyShifr = "JJGHGFT8539fredFJJBTD";
        public $PayeerMerchantName = "incagold";
        #Массовые Выплаты
        public $PayeerWithdrawAcc = "P22034489";
        public $PayeerWithdrawId = "858785848";
        public $PayeerWithdrawSecret = "PqqG1XvPin77ug5q";
        public $PayeerWithdrawName = "ICA GOLD";




	public $AdminsAcc = array(1, 2, 3);         // админские аккаунты
	public $AdmPercWithdraw = 0.05;             // админский процент прибыли при выводе

	public $MatrixPercent = array(100, 200, 450);                   // Процент повышения входа в матрицах

	public $MatrixPriceRUR = array(100, 300, 500);            // Цены на рублевые матрицы

    public $PaySysArr = array("RUB");    // Перечень платежных систем

}





Class Core {
    


    
}





?>