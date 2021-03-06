<?php
/**
 * Created by PhpStorm.
 * User: Urmat
 * Date: 08.02.2017
 * Time: 13:09
 */

namespace sonkei\gmap;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

/**
 * Class GoogleAsset
 * @package sonkei\gmap
 *
 * To update the key or other options like language, version, or library
 * use the Asset Bundle customization.
 * http://www.yiiframework.com/doc-2.0/guide-structure-assets.html#customizing-asset-bundles
 * To get key, please visit https://code.google.com/apis/console/
 *
 * 'components' => [
 *     'assetManager' => [
 *         'bundles' => [
 *             'sonkei\gmap\GoogleAsset' => [
 *                 'options' => [
 *                       'key' => 'this_is_my_key',
 *                       'language' => 'id',
 *                       'version' => '3.1.18'
 *                  ],
 *              ],
 *          ],
 *      ],
 *  ],
 */
class GoogleAsset extends AssetBundle
{
    /**
     * Sets options for the google map
     * @var array $options
     */
    public $options = [];

    /** @inheritdoc */
    public function init()
    {
        $this->options = ArrayHelper::merge($this->options, array_filter(ArrayHelper::getValue(Yii::$app->params, 'gmap', [])));
        // BACKWARD COMPATIBILITY
        $this->js[] = 'https://maps.googleapis.com/maps/api/js?' . http_build_query($this->options);
    }

    /** @inheritdoc */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
    /** @inheritdoc */
    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
}