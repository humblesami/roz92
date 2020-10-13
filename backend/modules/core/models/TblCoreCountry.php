<?php

namespace backend\modules\core\models;

use Yii;

/**
 * This is the model class for table "tbl_core_country".
 *
 * @property integer $country_id
 * @property string $country_name
 * @property string $nationality
 * @property string $country_continent
 * @property string $country_time_zone
 * @property string $country_capital
 * @property string $country_two_code
 * @property string $country_three_code
 * @property string $country_dailing_code
 * @property string $country_language
 * @property string $country_currency_code
 * @property string $country_currency_name
 * @property string $country_symbol
 * @property string $country_data
 * @property string $gazetted_holidays
 * @property string $status_id
 * @property integer $created_by
 */
class TblCoreCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_core_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_name', 'nationality', 'country_continent', 'country_time_zone', 'country_capital', 'country_two_code', 'country_three_code', 'country_dailing_code', 'country_language', 'country_currency_code', 'country_currency_name', 'country_symbol', 'country_data', 'gazetted_holidays', 'created_by'], 'required'],
            [['country_data', 'gazetted_holidays'], 'string'],
            [['created_by'], 'integer'],
            [['country_name', 'nationality'], 'string', 'max' => 100],
            [['country_continent', 'country_capital', 'country_currency_name', 'country_symbol'], 'string', 'max' => 50],
            [['country_time_zone', 'country_language'], 'string', 'max' => 20],
            [['country_two_code'], 'string', 'max' => 2],
            [['country_three_code'], 'string', 'max' => 3],
            [['country_dailing_code'], 'string', 'max' => 6],
            [['country_currency_code'], 'string', 'max' => 5],
            [['status_id'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'country_name' => 'Country Name',
            'nationality' => 'Nationality',
            'country_continent' => 'Country Continent',
            'country_time_zone' => 'Country Time Zone',
            'country_capital' => 'Country Capital',
            'country_two_code' => 'Country Two Code',
            'country_three_code' => 'Country Three Code',
            'country_dailing_code' => 'Country Dailing Code',
            'country_language' => 'Country Language',
            'country_currency_code' => 'Country Currency Code',
            'country_currency_name' => 'Country Currency Name',
            'country_symbol' => 'Country Symbol',
            'country_data' => 'Country Data',
            'gazetted_holidays' => 'Gazetted Holidays',
            'status_id' => 'Status ID',
            'created_by' => 'Created By',
        ];
    }
}
