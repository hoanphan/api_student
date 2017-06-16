define({ "api": [
  {
    "type": "get",
    "url": "/student/list",
    "title": "1. Danh sách học sinh",
    "group": "Student",
    "version": "1.0.0",
    "sampleRequest": [
      {
        "url": "/api/student/list"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>Mã kết quả trả về</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>Nội dung kết quả trả về</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "data",
            "description": "<p>Mảng chứa đối tượng học sinh</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "data.id",
            "description": "<p>Khóa chính</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.name",
            "description": "<p>Tên học sinh</p>"
          }
        ]
      }
    },
    "filename": "modules/api/controllers/StudentController.php",
    "groupTitle": "Student",
    "name": "GetStudentList"
  }
] });
