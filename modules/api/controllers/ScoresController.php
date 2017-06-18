<?php
/**
 * Created by Navatech
 * @project sgl-com-vn
 * @author  Le Phuong
 * @email phuong17889@gmail.com
 * @time    4/14/2017 11:48 AM
 */

namespace app\modules\api\controllers;
use app\models\Dsdiem;
use app\models\Dshocky;
use app\models\Dshocsinhtheolop;
use app\models\Dsloaidiem;
use app\models\Dsmonhoctheolop;
use app\models\Dsnamhoc;
use app\models\Student;
use app\modules\api\components\ApiController;
use yii\helpers\Json;

class ScoresController extends ApiController
{

    /**
     * {@inheritDoc}
     */
    public static function responseCode()
    {
        return [
            -1 => 'MISSING PARAMETER',
            0 => 'OK',
            1 => 'NOT FOUND',
        ];
    }

    /**
     * @api              {get} /scores/list 1. Danh sách  điểm
     * @apiGroup         Scores
     * @apiVersion       1.0.0
     *
     * @apiSampleRequest /api/scores/list
     * @apiParam {number} id Mã học sinh
     * @apiSuccess {number} code Mã kết quả trả về
     * @apiSuccess {string} message Nội dung kết quả trả về
     * @apiSuccess {Object[]} data Mảng chứa đối tượng
     * @apiSuccess {Object[]} data.items Mảng động theo loại điểm
     */
    public function actionList()
    {
        $response['code'] = 0;
        $id          = $this->getBodyValue('id', true);
       $maLop= Dshocsinhtheolop::findOne(['MaHocSinh'=>$id])->MaLop;
       $maHocKy=Dshocky::getCurrent();
       $maNamHoc=Dsnamhoc::getIdYearCurrent();
       /**@var Dsmonhoctheolop[] $subjects**/
       $subjects= Dsmonhoctheolop::find()->where(['MaLop'=>$maLop,'MaHocKy'=>$maHocKy,'MaNamHoc'=>$maNamHoc])->all();
        if ($subjects != null) {
            foreach ($subjects as $item) {
                $response['data'][] =Dsdiem::getArrayScores($id,$item->MaMonHoc);
            }
        } else {
            $response['code'] = 1;
        }
        $this->response(200, $response);
    }

}