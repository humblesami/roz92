<?php

namespace backend\modules\core\models;

use Yii;

/**
 * This is the model class for table "tbl_core_company".
 *
 * @property integer $company_id
 * @property string $company_name
 * @property integer $country_id
 * @property integer $state
 * @property integer $city
 * @property string $address
 * @property string $postal_code
 * @property string $email_address
 * @property string $phone_number
 * @property string $fax_number
 * @property string $website
 * @property string $tax_number
 * @property string $logo_file
 */
class TblCoreCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_core_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'country_id', 'state', 'city', 'address', 'postal_code', 'email_address', 'phone_number', 'fax_number', 'website', 'tax_number'], 'required'],
            [['country_id', 'state', 'city'], 'integer'],
            [['company_name', 'logo_file'], 'string', 'max' => 100],
            [['address', 'website'], 'string', 'max' => 250],
            [['postal_code', 'phone_number', 'fax_number'], 'string', 'max' => 20],
            [['email_address'], 'string', 'max' => 50],
            [['tax_number'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'country_id' => 'Country ID',
            'state' => 'State',
            'city' => 'City',
            'address' => 'Address',
            'postal_code' => 'Postal Code',
            'email_address' => 'Email Address',
            'phone_number' => 'Phone Number',
            'fax_number' => 'Fax Number',
            'website' => 'Website',
            'tax_number' => 'Tax Number',
            'logo_file' => 'Logo File',
        ];
    }
}
