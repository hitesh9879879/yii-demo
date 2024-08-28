<?php

namespace app\controllers;

use app\models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Vtiful\Kernel\Excel;

class ExcelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $fileName = \Yii::$app->request->get('file_name');
        $modelName = \Yii::$app->request->get('model');
        $excelData = \app\models\ExcelData::find()->all();

        if (!empty($fileName) && !empty($modelName)) {
            $tableName = \Yii::$app->db->quoteTableName($modelName);

            $data = \Yii::$app->db->createCommand('SELECT * FROM ' . $tableName)->queryAll();

            if (empty($data)) {
                throw new \yii\web\BadRequestHttpException('No data found in the specified table.');
            }

            $excel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $excel->getActiveSheet();

            $col = 'A';
            foreach (array_keys($data[0]) as $key) {
                $sheet->setCellValue($col . '1', $key);
                $col++;
            }

            $row = 2;
            foreach ($data as $record) {
                $col = 'A';
                foreach ($record as $value) {
                    $sheet->setCellValue($col . $row, $value);
                    $col++;
                }
                $row++;
            }

            $fileName .= '.xlsx';

            $sql = 'INSERT INTO excels (file_name, created_at, updated_at) VALUES (:fileName, :createdAt, :updatedAt)';

            $params = [
                ':fileName' => $fileName,
                ':createdAt' => date('Y-m-d H:i:s'),
                ':updatedAt' => date('Y-m-d H:i:s'),
            ];

            \Yii::$app->db->createCommand($sql, $params)->execute();

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($excel, 'Xlsx');
            $writer->save('php://output');
            exit;

        }

        return $this->render('index', compact('excelData'));
    }
}
