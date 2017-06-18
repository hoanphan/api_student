<?php
/**
 * Created by Navatech
 * @project sgl-com-vn
 * @author  Le Phuong
 * @email phuong17889@gmail.com
 * @time    4/14/2017 11:48 AM
 */

namespace app\modules\api\controllers;
use app\models\Dsloaidiem;
use app\models\Student;
use app\modules\api\components\ApiController;
use yii\helpers\Json;

class TypeScoresController extends ApiController
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
     * @api              {get} /type-scores/list 1. Danh sách loại điểm
     * @apiGroup         TypeScores
     * @apiVersion       1.0.0
     *
     * @apiSampleRequest /api/type-scores/list
     *
     * @apiSuccess {number} code Mã kết quả trả về
     * @apiSuccess {string} message Nội dung kết quả trả về
     * @apiSuccess {Object[]} data Mảng chứa đối tượng
     * @apiSuccess {Object[]} data.items Mảng chứa đối tượng loại điểm
     * @apiSuccess {number} data.items.id Khóa chính
     * @apiSuccess {string} data.items.name Tên Loại điểm
     * @apiSuccess {string} data.items.display Hiển thị
     * @apiSuccess {string} data.items.count Số lượng
     */
    public function actionList()
    {
        $response['code'] = 0;
        /***@var Dsloaidiem[] $typeScores * */
        $typeScores = Dsloaidiem::find()->all();
        if ($typeScores != null) {
            foreach ($typeScores as $item) {
                $response['data'][] = [
                    'id' => $item->MaLoaiDiem,
                    'name' =>$item->TenLoaiDiem,
                    'display'=>$item->HienThi,
                    'count'=>$item->SoDiemToiDa,
                ];
            }
        } else {
            $response['code'] = 1;
        }
        $this->response(200, $response);
    }

}