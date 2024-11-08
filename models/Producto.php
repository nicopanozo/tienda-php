<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property float|null $precio
 * @property string|null $talla XS,S,M,L,XL,XXL
 * @property string|null $color
 * @property string|null $categoria SHORTS,JEANS,POLERAS,BLUSAS, ETC
 *
 * @property Stock $stock
 * @property Venta[] $ventas
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['precio'], 'number', 'message' => 'El precio debe ser un número'],
            [['nombre', 'descripcion', 'color', 'categoria'], 'string', 'max' => 100],
            [['talla'], 'string', 'max' => 5, 'message' => 'La talla debe ser XS, S, M, L, XL o XXL'],
            [['nombre', 'precio', 'talla', 'color', 'categoria'], 'required', 'message' => 'Campo requerido' ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'precio' => 'Precio',
            'talla' => 'Talla',
            'color' => 'Color',
            'categoria' => 'Categoria',
        ];
    }

    /**
     * Gets query for [[Stock]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStock()
    {
        return $this->hasOne(Stock::class, ['producto_id' => 'id']);
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::class, ['producto_id' => 'id']);
    }
}
