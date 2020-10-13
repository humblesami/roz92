<?php
namespace app\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
class Header extends Widget{
	public $station_id		=	array();
	public $xdate  =array();
    public function init(){
            // add your logic here
    }
    public function run(){
			$station_id	=	$this->station_id;
			
			$xdate = $this->xdate;
			//echo $this->station_id;
			
			$urdu_date = $this->urdu_date();
            return $this->render('header',['station_id' => $station_id,'urdu_date' => $urdu_date,'xdate' => $xdate]);
    }

	private function urdu_date(){

		$week = array(
			'Monday' => 'پیر',
			'Tuesday' => 'منگل',
			'Wednesday' => 'بدھ',
			'Thursday' => 'جمعرات',
			'Friday' => 'جمعه',
			'Saturday' => 'هفته',
			'Sunday' => 'اتوار'
		);

		$months = array(
			'January' => 'جنوری',
			'February' => 'فروری',
			'March' => 'مارچ',
			'April' => 'اپریل',
			'May' => 'مئی',
			'June' => 'جون',
			'July' => 'جولائی',
			'August' => ' اگست',
			'September' => ' ستمبر',
			'October' => 'اکتوبر',
			'November' => 'نومبر',
			'December' => 'دسمبر'
		);
		
		$date = $week[date('l')] ."&nbsp;". date('d') ."&nbsp;". $months[ date('F')] ."&nbsp;".date('Y')."ء" ;

		return $date;
	}

}
?>