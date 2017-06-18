<?php
/**
 * Created by Navatech
 * @project sgl-com-vn
 * @author  Le Phuong
 * @email phuong17889@gmail.com
 * @time    4/14/2017 11:48 AM
 */

namespace app\modules\api\controllers;
use app\models\Dshocky;
use app\models\Student;
use app\modules\api\components\ApiController;
class SemesterController extends ApiController
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
     * @api              {get} /semester/list 1. Danh sách Học kỳ
     * @apiGroup         Semester
     * @apiVersion       1.0.0
     *
     * @apiSampleRequest /api/semester/list
     *
     * @apiSuccess {number} code Mã kết quả trả về
     * @apiSuccess {string} message Nội dung kết quả trả về
     * @apiSuccess {Object[]} data Mảng chứa đối
     * @apiSuccess {Object[]} data.items Mảng chứa đối tượng học kỳ
     * @apiSuccess {number} data.items.id Khóa chính
     * @apiSuccess {string} data.items.name Tên học kỳ
     *  @apiSuccess {number} data.items.current Kỳ hiện tại
     */
    public function actionList()
    {
        $response['code'] = 0;
        /***@var Dshocky[] $semester * */
        $semester = Dshocky::find()->all();
        if ($semester != null) {
            foreach ($semester as $item) {
                $response['data'][] = [
                    'id' => $item->MaHocKy,
                    'name' =>$item->TenHocKy,
                    'current'=>$item->KiHienTai
                ];
            }
        } else {
            $response['code'] = 1;
        }
        $this->response(200, $response);
    }

}