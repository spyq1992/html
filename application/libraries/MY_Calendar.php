class MY_Calendar extends CI_Calendar{
	 public function __construct()
    {
        parent::__construct();
    }
     public function getFirstday(){
     	$today=data('N,d,j,m,L,Y');
     	$tmp=str_split($today,',');
     	return $tmp;
     }
}
