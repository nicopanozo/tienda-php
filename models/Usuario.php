<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property string|null $usuario
 * @property string|null $nombre
 * @property string|null $password
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property string|null $eliminado
 *
 * @property Venta[] $ventas
 */
class Usuario extends \yii\db\ActiveRecord implements IdentityInterface
{
    const SCENARIO_UPDATE_DELETED = 'updateDeleted';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        // Definir el nuevo escenario `updateDeleted` con solo el campo `deleted`
        $scenarios[self::SCENARIO_UPDATE_DELETED] = ['eliminado'];
        
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Implement your logic to find identity by access token
        return static::findOne(['access_token' => $token]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // Implement your logic to get auth key
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // Implement your logic to validate auth key
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        Yii::warning($password, 'app\models\Usuario');
        return (md5($password) === ($this->password));
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario', 'nombre', 'password'], 'string', 'max' => 100],
            [['usuario'], 'unique', 'message' => 'Este usuario ya está en uso.'],
            [
                'password',
                'match',
                'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                'message' => 'La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número y un carácter especial (por ejemplo, @$!%*?&).'
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Cifrar la contraseña usando MD5 (NO RECOMENDADO)
            $this->password = md5($this->password);
            return true;
        }
        return false;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario' => 'Usuario',
            'nombre' => 'Nombre',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::class, ['usuario_id' => 'id']);
    }
}
