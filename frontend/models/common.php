<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Common
{
    public static function urdu_date($date_value){

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
        $year = date('Y',strtotime($date_value));
        $month = date('F',strtotime($date_value));
        $day = date('d',strtotime($date_value));
         $day_full = date('l',strtotime($date_value));
        
        
        $date = $week[$day_full] ."&nbsp;". $day ."&nbsp;". $months[ $month] ."&nbsp;".$year."ء" ;

        return $date;
    }
}
