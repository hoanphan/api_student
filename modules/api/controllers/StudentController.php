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
     *  @apiSuccess {string} data.email Email
     * @apiSuccess {string} data.phone Số điện thoại
     *  @apiSuccess {number} data.birthday Ngày sinh
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
                    'email'=>$student->email,
                    'phone'=>$student->phone,
                    'birthday'=>$student->birthday
                ];
            }
        } else {
            $response['code'] = 1;
        }
        $this->response(200, $response);
    }
    /**
     * @api              {post} /student/create 2. Thêm mới học sinh
     * @apiGroup         Student
     * @apiVersion       1.0.0
     *
     * @apiSampleRequest /api/student/create
     * @apiParam {string} name Họ và tên của học sinh
     * @apiParam {string} email Email của học sinh
     * @apiParam {number} sex {1: nam, 0: nữ}giới tính của học sinh
     * @apiParam {string} phone Số điện thoại của  học sinh
     * @apiParam {string} birthday Ngày sinh của học sinh
     *
     * @apiSuccess {number} code Mã kết quả trả về
     * @apiSuccess {string} message Nội dung kết quả trả về
     * @apiSuccess {Object[]} data Mảng chứa đối tượng học sinh
     * @apiSuccess {number} data.id Khóa chính
     * @apiSuccess {string} data.name Tên học sinh
     *  @apiSuccess {string} data.email Email
     * @apiSuccess {string} data.phone Số điện thoại
     *  @apiSuccess {number} data.birthday Ngày sinh
     */
    public function actionCreate()
    {
        $student                   = new Student();
        $student->name          = $this->getBodyValue('name', true);
        $student->phone    = $this->getBodyValue('phone', true);
        $student->sex= $this->getBodyValue('sex', true);
        $student->email   = $this->getBodyValue('email', false);
        $student->birthday   = $this->getBodyValue('birthday', true);
        $response['code'] = 0;
        if ($student->save()) {
            $data = $student->attributes;
            $response['data']   = $data;
        } else {
            $response['code']    = 2;
            $response['message'] = array_values($student->firstErrors)[0];
            $response['data']    = $student->firstErrors;
        }
        $this->response(200, $response);
    }
    /**
     * @api              {post} /student/update 4. Cập nhật mới học sinh
     * @apiGroup         Student
     * @apiVersion       1.0.0
     *
     * @apiSampleRequest /api/student/update
     * @apiParam {number} id mã học sinh
     * @apiParam {string} name Họ và tên của học sinh
     * @apiParam {string} email Email của học sinh
     * @apiParam {number} sex {1: nam, 0: nữ}giới tính của học sinh
     * @apiParam {string} phone Số điện thoại của  học sinh
     * @apiParam {string} birthday Ngày sinh của học sinh
     *
     * @apiSuccess {number} code Mã kết quả trả về
     * @apiSuccess {string} message Nội dung kết quả trả về
     * @apiSuccess {Object[]} data Mảng chứa đối tượng học sinh
     * @apiSuccess {number} data.id Khóa chính
     * @apiSuccess {string} data.name Tên học sinh
     *  @apiSuccess {string} data.email Email
     * @apiSuccess {string} data.phone Số điện thoại
     *  @apiSuccess {number} data.birthday Ngày sinh
     */
    public function actionUpdate()
    {
        $id          = $this->getBodyValue('id', true);
        $student                   = Student::findOne($id);
        $student->name          = $this->getBodyValue('name', true);
        $student->phone    = $this->getBodyValue('phone', true);
        $student->sex= $this->getBodyValue('sex', true);
        $student->email   = $this->getBodyValue('email', false);
        $student->birthday   = $this->getBodyValue('birthday', true);
        $response['code'] = 0;
        if ($student->update()) {
            $data = $student->attributes;
            $response['data']   = $data;
        } else {
            $response['code']    = 2;
            $response['message'] = array_values($student->firstErrors)[0];
            $response['data']    = $student->firstErrors;
        }
        $this->response(200, $response);
    }
    /**
     * @api              {post} /student/get 3. Lấy thông tin học sinh
     * @apiGroup         Student
     * @apiVersion       1.0.0
     *
     * @apiSampleRequest /api/student/get
     * @apiParam {number} id Mã học sinh
     *
     * @apiSuccess {number} code Mã kết quả trả về
     * @apiSuccess {string} message Nội dung kết quả trả về
     * @apiSuccess {Object[]} data Mảng chứa đối tượng học sinh
     * @apiSuccess {number} data.id Khóa chính
     * @apiSuccess {string} data.name Tên học sinh
     *  @apiSuccess {string} data.email Email
     * @apiSuccess {string} data.phone Số điện thoại
     *  @apiSuccess {number} data.birthday Ngày sinh
     */
    public function actionGet()
    {
        $id          = $this->getBodyValue('id', true);
        $response['code'] = 0;
        $student=Student::findOne($id);
        if ($student!=null) {
            $data = $student->attributes;
            $response['data']   = $data;
        } else {
            $response['code']    = 2;
            $response['message'] = array_values($student->firstErrors)[0];
            $response['data']    = $student->firstErrors;
        }
        $this->response(200, $response);
    }

    /**
     * @api              {post} /student/delete 5. Xóa học sinh
     * @apiGroup         Student
     * @apiVersion       1.0.0
     *
     * @apiSampleRequest /api/student/delete
     * @apiParam {number} id Mã học sinh
     *
     * @apiSuccess {number} code Mã kết quả trả về
     * @apiSuccess {string} message Nội dung kết quả trả về
     */
    public function actionDelete()
    {
        $id          = $this->getBodyValue('id', true);
        $response['code'] = 0;
        $student=Student::findOne($id);
        if ($student->delete()) {
            $response['code'] = 0;
        } else {
            $response['code']    = 2;
            $response['message'] = array_values($student->firstErrors)[0];
            $response['data']    = $student->firstErrors;
        }
        $this->response(200, $response);
    }
}