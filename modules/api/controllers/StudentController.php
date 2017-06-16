<?php
/**
 * Created by Navatech
 * @project sgl-com-vn
 * @author  Le Phuong
 * @email phuong17889@gmail.com
 * @time    4/14/2017 11:48 AM
 */

namespace app\modules\api\controllers;
use app\models\Student;
use app\modules\api\components\ApiController;
class StudentController extends ApiController
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
     * @api              {get} /student/list 1. Danh sách học sinh
     * @apiGroup         Student
     * @apiVersion       1.0.0
     *
     * @apiSampleRequest /api/student/list
     *
     * @apiSuccess {number} code Mã kết quả trả về
     * @apiSuccess {string} message Nội dung kết quả trả về
     * @apiSuccess {Object[]} data Mảng chứa đối tượng học sinh
     * @apiSuccess {number} data.id Khóa chính
     * @apiSuccess {string} data.name Tên học sinh
     */
    public function actionList()
    {
        $response['code'] = 0;
        /***@var Student[] $students * */
        $students = Student::find()->all();
        if ($students != null) {
            foreach ($students as $student) {
                $response['data'][] = [
                    'id' => $student->id,
                    'name' =>$student->name,
                ];
            }
        } else {
            $response['code'] = 1;
        }
        $this->response(200, $response);
    }


}